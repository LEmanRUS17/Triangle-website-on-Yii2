<?php

return [

    // Атрибуты модели User (Модуль User):
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
    'ATTRIBUTE_USER_NEW_PASSWORD'    => 'Новый пароль',
    'ATTRIBUTE_USER_REPEAT_PASSWORD' => 'Подтверждение пароля',

    // Статусы модели User:
    'STATUS_BLOCKED' => 'Заблокирован',
    'STATUS_ACTIVE'  => 'Активен',
    'STATUS_WAIT'    => 'Ожидает подтверждения',

    // Сообщения об ошибках:
    'ERROR_EMAIL_EXISTS'               => 'Пользователь с таким Email уже существует',      // Редактирование Email, модель формы ProfileUpdateForm
    'ERROR_WRONG_CURRENT_PASSWORD'     => 'Текущий пароль введен не верно',                 // Проверка действующего пароля модели PasswordChangeForm модуля User
    'ERROR_MISSING_CONFIRMATION_CODE'  => 'Отсутствует код подтверждения.',                 // Подтвеждение по электронной почте (EmailConfirm)
    'ERROR_INVALID_TOKEN'              => 'Неверный токен.',                                // Подтвеждение по электронной почте (EmailConfirm)
    'ERROR_EMAIL_CONFIRMATION'         => 'Ошибка подтверждения Email.',                    // Подтвеждение Email, модель EmailConfirm
    'ERROR_PROBLEM_SHIPPING'           => 'Извините. У нас возникли проблемы с отправкой.', // Подтвеждение Email, модель EmailConfirm
    'ERROR_TOKEN_IS_SENT'              => 'Error token',                                    // Ошибка токена модели формы PasswordResetRequestForm
    'ERROR_USER_NOT_FOUND_BY_EMAIL'    => 'Not found by email',
    'ERROR_RASSWORD_RESET_TOKEN_EMPTY' => 'Маркер сброса пароля не может быть пустым.',
    'ERROR_RASSWORD_RESET_TOKEN_WRONG' => 'Неверный токен сброса пароля',

    // Заголовки:
    'TITLE_LOGIN'                  => 'Вход',
    'TITLE_SIGN_UP'                => 'Регестрация',
    'TITLE_PASSWORD_RESET_REQUEST' => 'Востановление пароля',
    'TITLE_PROFILE'                => 'Профиль пользователя',
    'TITLE_PROFILE_UP'             => 'Редактирование пользователя',
    'TITLE_PASSWORD_CHANGE'        => 'Смена пароля',
    'TITLE_USER_PROFILES'          => 'Список пользователей',
    'TITLE_USER_UPDATE'            => 'Редактирование пользователя',
    'TITLE_USER_CREATE'            => 'Создание пользователя',
    'TITLE_USER_PROFILE'           => 'Профиль пользователя',

    // Редактирование пользователя:
    'UP_USER_EMAIL'       => 'Email',
    'UP_USER_BUTTON_SAVE' => 'Сохранить',

    // Редактирование пароля пользователя:
    'UP_USER_PASSWORD_BUTTON_SAVE'      => 'Сохранить',
    'UP_USER_PASSWORD_NEW_PASSWORD'     => 'Новый пароль',
    'UP_USER_PASSWORD_REPEAT_PASSWORD'  => 'Повторите пароль',
    'UP_USER_PASSWORD_CURRENT_PASSWORD' => 'Текущий пароль',

    // Форма логина:
    'LOGIN_USERNAME'          => 'Логин',
    'LOGIN_PASSWORD'          => 'Пароль',
    'LOGIN_REMEMBER_ME'       => 'Запомнить',
    'LOGIN_BUTTON'            => 'Вход',
    'LOGIN_RECOVERY_PASSWORD' => 'Востановить пароль.',

    // Форма регестрации:
    'SIGN_UP_USERNAME'    => 'Логин',
    'SIGN_UP_PASSWORD'    => 'Пароль',
    'SIGN_UP_EMAIL'       => 'E-mail',
    'SIGN_UP_VERIFY_CODE' => 'Введите текст с картинки',

    // Просмотр пользователя:
    'VIEW_USER_UP'          => 'Редактирование пользователя',
    'VIEW_USER_UP_PASSWORD' => 'Сменить пароль',

    // Сообщения об успехе:
    'SUCCESS_EMAIL_ADDRESS_CONFIRM'       => 'Подтвердите ваш электронный адрес.',                                                // Подтвеждение Email, модель EmailConfirm
    'SUCCESS_EMAIL_SUCCESSFULLY_VERIFIED' => 'Спасибо! Ваш Email успешно подтверждён.',                                           // Подтвеждение Email, модель EmailConfirm
    'SUCCESS_EMAIL_RESET_PASSWORD'        => 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.', // Подтвеждение Email, модель EmailConfirm
    'SUCCESS_PASSWORD_SUCCESSFULLY'       => 'Спасибо! Пароль успешно изменён.',                                                  // Подтвеждение Email, модель EmailConfirm

    // Письмо потверждения регестрации:
    'EMAIL_CONFIRM_GREETINGS'    => 'Здравствуйте',
    'EMAIL_CONFIRM_ADDRESS'      => 'Для подтверждения адреса пройдите по ссылке',
    'EMAIL_CONFIRM_FALSE_LETTER' => 'Если Вы не регистрировались у на нашем сайте, то просто удалите это письмо',

    // Письмо востановления пароля:
    'PASSWORD_RESET_GREETINGS'   => 'Здравствуйте',
    'PASSWORD_RESET_CHANGE_LINK' => 'Пройдите по ссылке, чтобы сменить пароль',

    // Сообщения:
    'MESSAGE_LOGIN_PASSWORD'                 => 'Неверное имя пользователя или пароль.',    // Сообщение валидации модели LoginForm модуля User
    'MESSAGE_LOGIN_USERNAME_BLOCKED'         => 'Ваш аккаунт заблокирован.',                // Сообщение валидации модели LoginForm модуля User
    'MESSAGE_LOGIN_USERNAME_WAIT'            => 'Ваш аккаунт не подтвежден.',               // Сообщение валидации модели LoginForm модуля User
    'MESSAGE_USER_USERNAME'                  => 'Это имя пользователя уже занято.',         // Правило валидации модели User модуля User
    'MESSAGE_USER_EMAIL'                     => 'Этот адрес электронной почты уже занят.',  // Правило валидации модели User модуля User
    'MESSAGE_SIGN_UP_USERNAME_ALREADY_TAKEN' => 'Это имя пользователя уже занято.',         // Сообщение валидации модели SignUpForm модуля User
    'MESSAGE_SIGN_UP_EMAIL_ALREADY_TAKEN'    => 'Этот адрес электронной почты уже занят. ', // Сообщение валидации модели SignUpForm модуля User

    // Список пользователей:
    'USERS_PROFILE_CREATE_BUTTON_SAVE' => 'Сохранить',

    // Администрирование:
    'ADMIN_USERS'     => 'Список пользователей',
    'ADMIN_USERS_ADD' => 'Создать пользователя',


];