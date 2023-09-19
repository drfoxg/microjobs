<?php

namespace App\Enum;

enum State: int
{
    case Created = 1;  // Создано
    case InWork = 2;   // В работе
    case OnCheck = 3;  // На проверке
    case Denied = 4;   // Отклонено (в ходе проверки)
    case Accepted = 5; // Принято
    case Returned = 6; // Возвращено (исполнителем в ручную или по таймауту)
}
