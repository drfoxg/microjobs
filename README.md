# Форма обратной связи на Laravel + Vue
Тестовое задание
## Установка
Приложение тестировалось под Docker.
Хостом для Docker служил Fedora 34 Server Edition или Ubuntu 20.04 через WSL под Windows 10.  

Подготовка к установке Docker for Windows:  
[Windows Subsystem for Linux Installation Guide for Windows 10](https://docs.microsoft.com/en-us/windows/wsl/install-win10).  
[Docker for Windows](https://desktop.docker.com/win/stable/amd64/Docker%20Desktop%20Installer.exe) должен быть установлен и интегрирован с WSL 2 [Ubuntu 20.04 MS Store](https://www.microsoft.com/en-us/p/ubuntu-2004-lts/9n6svws3rx71?activetab=pivot:overviewtab).

.wslconfig следует разместить в домашнем каталоге пользователя Windows и скорректировать доступный объем памяти для WSL, пример конфига на 2 GB, возможно нужна перезагрузка Windows:  
```
[wsl2]  
memory=2GB  
swap=2Gb  
localhostForwarding=true
```

Конфиг виртуального хоста для веб-сервера Apache Docker берет из отдельного файла при сборке(docker build), а именно из laravel8.conf.  
В нем указан хост microjobs.test, который следует прописать в hosts, например: `127.0.0.1 microjobs.test`  

Следует указать правильные пути к каталогу www и mysql-data в файле (см. раздел volumes):  
`/feedbackform/docker-latest/docker-compose.yml`  

Там же следует указать пароль пользователя `root` для `mysql` в переменной `MYSQL_ROOT_PASSWORD`.  
  
Инструкцию по установке docker под Linux я приводить тут не буду. Считаю лишним.

## Запуск
Переходим в /microjobs/docker-latest/  
`sudo docker compose up -d`

## Сборка приложения
Открываем phpMyAdmin по адресу localhost:8080  
Настраиваем подключение в файле:  
`/var/www/microjobs/.env`

Например:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=blog2021
DB_USERNAME=user
DB_PASSWORD=password
```

Здесь DB_HOST=mysql задается на основе docker-compose.yml

Добавляем и даем права пользователю:  
```
CREATE USER 'user'@'%' IDENTIFIED BY 'password';
ALTER USER 'user'@'%' IDENTIFIED WITH mysql_native_password BY 'password';
```

Открываем консоль сервера:  
`sudo docker exec -it docker-latest_laravel8_1 bash`
  
```
cd /var/www/microjobs
composer install
npm install && npm run dev
```
  
Будут скачаны `vendors` и `node_modules`, скомпилирована `app.js`  
  
Возможно нужно поправить права доступа:  
```
sudo chown -R 1000:33 /var/www/microjobs/bootstrap/cache/
sudo chmod -R 775 /var/www/microjobs/bootstrap/cache/
sudo chown -R 1000:33 /var/www/microjobs/storage/
sudo chmod -R 775 /var/www/microjobs/storage/
```
  
USERID 1000 - это как правило единственный и первый пользователь, т.к. в Ubuntu и Fedora нумерация пользователей начинается с 1000.  
GROUPID 33 - это группа www-data пользователя Apache.  
  
Создаем таблицы в базе:  
`php artisan migrate`  

## Работа приложения
В разработке...

## Остановка c очисткой
`sudo docker compose down`

## Остановка без очистки
`sudo docker compose stop`