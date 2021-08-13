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
    'NAV_ADMIN'      => 'Администрирование',

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
    'TITLE_USER_PROFILES'          => 'Список пользователей',
    'TITLE_USER_PROFILE'           => 'Профиль пользователя',
    'TITLE_USER_CREATE'            => 'Создание пользователя',
    'TITLE_USER_UPDATE'            => 'Редактирование пользователя',
    'TITLE_ADMIN'                  => 'Администрирование',

    // Атрибуты модели User
    'ATTRIBUTE_USER_ID'              => 'ID',
    'ATTRIBUTE_USER_CREATED_AT'      => 'Создан',
    'ATTRIBUTE_USER_UD_DATED_AT'     => 'Обновлён',
    'ATTRIBUTE_USER_USERNAME'        => 'Имя пользователя',
    'ATTRIBUTE_USER_EMAIL'           => 'Email',
    'ATTRIBUTE_USER_STATUS'          => 'Статус',
    'ATTRIBUTE_AUTH_KEY'             => 'Ключ авторизации',
    'ATTRIBUTE_EMAIL_CONFIRM_TOKEN'  => 'Токен подтверждения электронной почты',
    'ATTRIBUTE_PASSWORD_HASH'        => 'Хэшированый пароль',
    'ATTRIBUTE_PASSWORD_RESET_TOKEN' => 'Токен смены пароля',

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
    'MESSAGE_PAGE_DOES_NOT_EXIT'     => 'Запрошенная страница не существует',       // Страницы пользователя не существует

    // Сообщения об ошибках:
    'ERROR_WRONG_CURRENT_PASSWORD'    => 'Текущий пароль введен не верно',                 // Проверка действующего пароля модели PasswordChangeForm модуля User
    'ERROR_MISSING_CONFIRMATION_CODE' => 'Отсутствует код подтверждения.',                 // Подтвеждение по электронной почте (EmailConfirm)
    'ERROR_INVALID_TOKEN'             => 'Неверный токен.',                                // Подтвеждение по электронной почте (EmailConfirm)
    'ERROR_EMAIL_CONFIRMATION'        => 'Ошибка подтверждения Email.',                    // Подтвеждение Email, модель EmailConfirm
    'ERROR_PROBLEM_SHIPPING'          => 'Извините. У нас возникли проблемы с отправкой.', // Подтвеждение Email, модель EmailConfirm

    // Сообщения об успехе:
    'SUCCESS_EMAIL_ADDRESS_CONFIRM'       => 'Подтвердите ваш электронный адрес.',                                                // Подтвеждение Email, модель EmailConfirm
    'SUCCESS_EMAIL_SUCCESSFULLY_VERIFIED' => 'Спасибо! Ваш Email успешно подтверждён.',                                           // Подтвеждение Email, модель EmailConfirm
    'SUCCESS_EMAIL_RESET_PASSWORD'        => 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.', // Подтвеждение Email, модель EmailConfirm
    'SUCCESS_PASSWORD_SUCCESSFULLY'       => 'Спасибо! Пароль успешно изменён.',                                                  // Подтвеждение Email, модель EmailConfirm

    // Список пользователей:
    'USERS_PROFILE_CREATE_BUTTON'      => 'Добавить пользователя',
    'USERS_PROFILE_CREATE_BUTTON_SAVE' => 'Сохранить',
    'USERS_PROFILE_UPDATE' => 'Редактировать',
    'USERS_PROFILE_DELETE' => 'Удалить',

    // Администрирование:
    'ADMIN_USERS' => 'Список пользователей',
];