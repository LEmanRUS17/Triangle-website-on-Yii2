<?php

return [

    // Панель навигации:
    'NAV_HOME'       => 'Главная',
    'NAV_PAGES'      => 'Страницы',
    'NAV_BLOG'       => 'Блог',
    'NAV_PORTFOLIO'  => 'Портфолио',
    'NAV_SHORTCODES' => 'Шорткоды',
    'NAV_LOGIN'      => 'Вход',
    'NAV_LOGOUT'     => 'Выход',
    'NAV_PROFILE'    => 'Профиль',

    // Форма логина:
    'LOGIN_USERNAME'          => 'Логин',
    'LOGIN_PASSWORD'          => 'Пароль',
    'LOGIN_REMEMBER_ME'       => 'Запомнить',
    'LOGIN_BUTTON'            => 'Вход',
    'LOGIN_RECOVERY_PASSWORD' => 'Востановить пароль.',

    // Редактирование пользователя:
    'UP_USER_BUTTON_SAVE' => 'Сохранить',
    'UP_USER_EMAIL'       => 'Email',

    // Просмотр пользователя:
    'VIEW_USER_UP'          => 'Редактирование пользователя',
    'VIEW_USER_UP_PASSWORD' => 'Сменить пароль',

    // Редактирование пароля пользователя:
    'UP_USER_PASSWORD_BUTTON_SAVE'      => 'Сохранить',
    'UP_USER_PASSWORD_NEW_PASSWORD'     => 'Новый пароль',
    'UP_USER_PASSWORD_REPEAT_PASSWORD'  => 'Повторите пароль',
    'UP_USER_PASSWORD_CURRENT_PASSWORD' => 'Текущий пароль',

    // Заголовки:
    'TITLE_LOGIN'                  => 'Вход',
    'TITLE_SIGN_UP'                => 'Регестрация',
    'TITLE_PASSWORD_RESET_REQUEST' => 'Востановление пароля',
    'TITLE_PROFILE'                => 'Профиль пользователя',
    'TITLE_PROFILE_UP'             => 'Редактирование пользователя',
    'TITLE_PASSWORD_CHANGE'        => 'Смена пароля',

    // Атрибуты модели User
    'ATTRIBUTE_USER_ID'          => 'ID',
    'ATTRIBUTE_USER_CREATED_AT'  => 'Создан',
    'ATTRIBUTE_USER_UD_DATED_AT' => 'Обновлён',
    'ATTRIBUTE_USER_USERNAME'    => 'Имя пользователя',
    'ATTRIBUTE_USER_EMAIL'       => 'Email',
    'ATTRIBUTE_USER_STATUS'      => 'Статус',

    // Статусы модели User
    'STATUS_BLOCKED' => 'Заблокирован',
    'STATUS_ACTIVE'  => 'Активен',
    'STATUS_WAIT'    => 'Ожидает подтверждения',

    // Сообщения
    'MESSAGE_USER_USERNAME'          => 'Это имя пользователя уже занято.',         // Правило валидации модели User модуля User
    'MESSAGE_USER_EMAIL'             => 'Этот адрес электронной почты уже занят .', // Правило валидации модели User модуля User
    'MESSAGE_LOGIN_PASSWORD'         => 'Неверное имя пользователя или пароль.',    // Сообщение валидации модели LoginForm модуля User
    'MESSAGE_LOGIN_USERNAME_BLOCKED' => 'Ваш аккаунт заблокирован.',                // Сообщение валидации модели LoginForm модуля User
    'MESSAGE_LOGIN_USERNAME_WAIT'    => 'Ваш аккаунт не подтвежден.',               // Сообщение валидации модели LoginForm модуля User

    'ERROR_WRONG_CURRENT_PASSWORD' => 'Текущий пароль введен не верно',           // Проверка действующего пароля модели PasswordChangeForm модуля User
];