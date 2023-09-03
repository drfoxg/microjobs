FROM composer:latest AS composer
FROM ubuntu:20.04

WORKDIR /usr/src/microjobs

# sets variables that only live during the build
ARG DEBIAN_FRONTEND=noninteractive

# Locale
ENV TZ=Europe/Moscow

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update && apt-get install -y locales && rm -rf /var/lib/apt/lists/*
RUN sed -i -e \
  's/# ru_RU.UTF-8 UTF-8/ru_RU.UTF-8 UTF-8/' /etc/locale.gen \
   && locale-gen

ENV LANG ru_RU.UTF-8
ENV LANGUAGE ru_RU:ru
ENV LC_LANG ru_RU.UTF-8
ENV LC_ALL ru_RU.UTF-8

# apache2 and utils, redis
RUN apt-get update && apt-get install -y apache2 curl wget git software-properties-common mc net-tools iputils-ping apt-utils && rm -rf /var/lib/apt/lists/*

# php 8.1
RUN add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php8.1 php8.1-mysql php8.1-sqlite3 \
                       php8.1-mcrypt php8.1-mbstring php8.1-gd php8.1-memcache \
                       libapache2-mod-php8.1 \
                       php8.1-curl php8.1-xml php8.1-soap php8.1-intl php8.1-dom php8.1-xmlrpc php8.1-zip \
                       php8.1-bcmath php-sodium \
    libfreetype6-dev \
    libjpeg62-dev \
    libpng-dev \
    libzip-dev \
#    redis \
    libxml2-dev && \
    curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - && \
    apt-get install -y nodejs && \
    rm -rf /var/lib/apt/lists/*

RUN npm install npm -g

#RUN sed -i 's/;\s*mbstring.func_overload\s*=/mbstring.func_overload = 2/' /etc/php/8.1/apache2/php.ini
#RUN sed -i 's/;mbstring.internal_encoding\s*=/mbstring.internal_encoding = utf-8/' /etc/php/8.1/apache2/php.ini

#RUN sed -i 's/error_reporting.*=.*E_ALL.*&.*~E_DEPRECATED.*&.*~E_STRICT/error_reporting = E_ALL/' /etc/php/8.1/apache2/php.ini
#RUN sed -i 's/display_errors.*=.*Off/display_errors = On/' /etc/php/8.1/apache2/php.ini
#RUN sed -i 's/display_startup_errors.*=.*Off/display_startup_errors = On/' /etc/php/8.1/apache2/php.ini

COPY /8.1/apache2/php.ini /etc/php/8.1/apache2/php.ini
COPY /8.1/cli/php.ini /etc/php/8.1/cli/php.ini
COPY /8.1/mods-available/opcache.ini /etc/php/8.1/mods-available/opcache.ini

# bitrix session
RUN \
    mkdir -p /tmp/php_upload /tmp/php_sessions \
 && chown -R 33:33 /tmp/php_upload /tmp/php_sessions
COPY /tmpfiles.d/bitrix.conf /etc/tmpfiles.d/bitrix.conf

# xdebug 8.1
RUN add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install php8.1-xdebug
#RUN echo 'zend_extension=xdebug\n' >> /etc/php/7.4/apache2/php.ini
RUN echo '\nzend_extension=/usr/lib/php/20210902/xdebug.so\n' >> /etc/php/8.1/cli/php.ini
RUN echo '\nzend_extension=/usr/lib/php/20210902/xdebug.so\n' >> /etc/php/8.1/apache2/php.ini
RUN echo '\
xdebug.start_with_request=yes\n\
xdebug.mode=debug\n\
xdebug.idekey="netbeans-xdebug"\n\
#xdebug.idekey=PHPSTORM\n\
# устанавливается при запуске через --env
# xdebug.remote_host=192.168.100.33\n\
# возвращает под docker ip вида 172.17.0.1
# xdebug.discover_client_host=1\n\
#xdebug.remote_log_level = 10\n\
#xdebug.remote_log = /var/log/xdebug_log\n\
xdebug.client_host=${XDEBUG_CLIENT_HOST}\n\
xdebug.client_port=9005\
' > /etc/php/8.1/mods-available/xdebug.ini
RUN rm -rf /var/lib/apt/lists/*

# composer 
ENV COMPOSER_ALLOW_SUPERUSER 1
#RUN curl -sS https://getcomposer.org/installer | php -- \
#        --filename=composer \
#        --install-dir=/usr/local/bin && \
#        echo "alias composer='composer'" >> /root/.bashrc \
#	&& composer 
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer global require laravel/installer && \
    echo 'export PATH="~/.config/composer/vendor/bin:$PATH"' >>  ~/.bashrc

# apache vhost
RUN cd /var/www \
 && mkdir -p -m 775 /var/www/microjobs \
 && chown -R ${DOCKER_UID}:33 /var/www/microjobs

ENV APACHE_RUN_USER=www-data
ENV APACHE_RUN_GROUP=www-data
ENV APACHE_LOG_DIR=/var/log/apache2
ENV APACHE_LOCK_DIR=/var/lock/apache2
ENV APACHE_PID_FILE=/var/run/apache2.pid
ENV APACHE_RUN_DIR=/var/run/apache2

RUN mkdir -p -m 775 /var/log/apache2/microjobs \
 && chown -R 33:33 /var/log/apache2/microjobs \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY .htaccess /var/www/html
COPY mpm.conf /etc/apache2/conf-available
COPY microjobs.conf /etc/apache2/sites-available

RUN a2disconf other-vhosts-access-log
RUN a2enconf mpm
RUN a2enmod rewrite
RUN a2ensite microjobs
RUN a2dissite 000-default

RUN sed -i 's/<VirtualHost\ \*:80>/<VirtualHost\ 62.109.24.91:80>/' /etc/apache2/sites-available/000-default.conf
RUN sed -i '/DocumentRoot/ a <Directory\ \/var\/www\/html>\n AllowOverride\ All \n<\/Directory>' /etc/apache2/sites-available/000-default.conf

RUN a2ensite 000-default
RUN service apache2 start
#RUN service apache2 reload

CMD ["apachectl", "-DFOREGROUND"]
#ENTRYPOINT ["/bin/bash"]
