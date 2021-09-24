<?php

namespace app\modules\user\controllers\console;

use app\modules\user\models\User;
use yii\base\Model;
use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\Console;

/**
 * Действия на вкладке users в консоли
 */
class UsersController extends Controller
{
    public function actionIndex() // Список команд
    {
        echo 'yii users/create' . PHP_EOL;
        echo 'yii users/remove' . PHP_EOL;
        echo 'yii users/activate' . PHP_EOL;
        echo 'yii users/change-password' . PHP_EOL;
    }

    public function actionCreate() // Создание
    {
        $model = new User();                                  // Новая модель пользователя
        $this->readValue($model, 'username');         // Получить 'username' из консоли
        $this->readValue($model, 'email');            // Получить 'email' из консоли
        $model->setPassword($this->prompt('Password:', [ // Получить 'password' из консоли (Генерация хэш пароля)
            'required' => true,               // Обязательный
            'pattern' => '#^.{6,255}$#i',     // Шаблон пароля
            'error' => 'More than 6 symbols', // Сообщение об ошибке
        ]));
        $model->generateAuthKey();  // Генерация дополнительного ключа
        $this->log($model->save()); // Выполнить: сохранение пользователя
    }

    public function actionRemove() // Удаление
    {
        $username = $this->prompt('Username:', ['required' => true]); // Получить 'username' из консоли, Обязательный
        $model = $this->findModel($username);                              // Найти пользователя по username
        $this->log($model->delete());                                      // Выполнить: удалить пользователя
    }

    public function actionActivate() // Активировать пользователя
    {
        $username = $this->prompt('Username:', ['required' => true]); // Получить 'username' из консоли, Обязательный
        $model = $this->findModel($username);                             // Найти пользователя по username
        $model->status = User::STATUS_ACTIVE;                             // Изменить статус на АКТИВНЫЙ
        $model->removeEmailConfirmToken();                                // Удалить токен подтверждения электронной почты
        $this->log($model->save());                                       // Выполнить: сохранение пользователя
    }

    public function actionChangePassword() // Изменить пароль пользователя
    {
        $username = $this->prompt('Username:', ['required' => true]); // Получить 'username' из консоли, Обязательный
        $model = $this->findModel($username);                              // Найти пользователя по username
        $model->setPassword($this->prompt('New password:', [          // Получить 'password' из консоли (Генерация хэш пароля)
            'required' => true,               // Обязательный
            'pattern' => '#^.{6,255}$#i',     // Шаблон пароля
            'error' => 'More than 6 symbols', // Сообщение об ошибке
        ]));
        $this->log($model->save()); // Выполнить: сохранение пользователя
    }

    /**
    * @param string $username
    * @throws \yii\console\Exception
    * @return User the loaded model
    */
    private function findModel($username) // Найти модель
    {
        if (!$model = User::findOne(['username' => $username])) { // Если модель пользователя не найдена
            throw new Exception('User not found'); // Вывести исключение
        }
        return $model;
    }

    /**
    * @param Model $model
    * @param string $attribute
    */
    private function readValue($model, $attribute)
    {
        $model->$attribute = $this->prompt(mb_convert_case($attribute, MB_CASE_TITLE, 'utf-8') . ':', [
            'validator' => function ($input, &$error) use ($model, $attribute) {
                $model->$attribute = $input;
                if ($model->validate([$attribute])) {
                    return true;
                } else {
                    $error = implode(',', $model->getErrors($attribute));
                    return false;
                }
            },
        ]);
    }

    /**
    * @param bool $success
    */
    private function log($success)
    {
        if ($success) {
            $this->stdout('Success!', Console::FG_GREEN, Console::BOLD);
        } else {
            $this->stderr('Error!', Console::FG_RED, Console::BOLD);
        }
        echo PHP_EOL;
    }
}