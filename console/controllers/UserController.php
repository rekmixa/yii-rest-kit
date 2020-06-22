<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;
use yii\console\widgets\Table;

/**
 * Class UserController
 * @package console\controllers
 */
class UserController extends Controller
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $status;

    public $limit;
    public $offset;
    public $ids;

    /**
     * @param string $actionID
     * @return array
     */
    public function options($actionID)
    {
        switch ($actionID) {
            case 'create':
                return [
                    'username',
                    'password',
                    'status',
                ];
            case 'list':
                return [
                    'limit',
                    'offset',
                    'ids',
                ];
            case 'update':
                return [
                    'id',
                    'username',
                    'password',
                    'status',
                ];
            case 'delete':
                return [
                    'id',
                ];
        }

        return [];
    }

    /**
     * @return array
     */
    public function optionAliases()
    {
        return [
            'u' => 'username',
            'p' => 'password',
            's' => 'status',
            'l' => 'limit',
            'o' => 'offset',
        ];
    }

    public function actionCreate()
    {
        $checkUser = User::find()
            ->andWhere(['username' => $this->username])
            ->exists();

        if ($checkUser) {
            echo "User with username $this->username already exists!\n";

            return;
        }

        $user = new User([
            'username' => $this->username,
            'password' => $this->password,
            'status' => $this->status,
        ]);

        $user->generateAuthKey();

        if ($user->save()) {
            echo "User $this->username successfully created!\n";
        } else {
            print_r($user->errors);

            echo "Cannot create user!\n";
        }
    }

    public function actionList()
    {
        if ($this->ids) {
            $this->ids = explode(',', $this->ids);
        }

        /** @var User[] $users */
        $users = User::find()
            ->andFilterWhere(['id' => $this->ids])
            ->limit($this->limit)
            ->offset($this->offset)
            ->all();

        if (empty($users)) {
            echo "Users not found!\n";

            return;
        }
        
        $tableHeaders = [];
        $tableRows = [];
        foreach ($users as $user) {
            if (empty($tableHeaders)) {
                $tableHeaders = array_keys($user->attributes);
            }

            $tableRows[] = array_values($user->attributes);
        }

        $table = new Table();

        echo $table->setHeaders($tableHeaders)
            ->setRows($tableRows)
            ->run();

        $countUsers = count($users);

        echo "Total count: $countUsers\n";
    }

    public function actionUpdate()
    {
        /** @var User|null */
        $user = User::findOne($this->id);

        if ($user === null) {
            echo "Cannot find user with id $this->id!\n";

            return;
        }

        if ($this->username) {
            $user->username = $this->username;
        }

        if ($this->password) {
            $user->password = $this->password;
        }

        if ($this->status) {
            $user->status = $this->status;
        }

        if ($user->save()) {
            echo "User with id $this->id successfully updated!\n";
        } else {
            print_r($user->errors);

            echo "Cannot update user with id $this->id\n";
        }
    }

    public function actionDelete()
    {
        /** @var User|null */
        $user = User::findOne($this->id);

        if ($user === null) {
            echo "Cannot find user with id $this->id!\n";

            return;
        }

        if ($user->delete()) {
            echo "User with id $this->id successfully deleted!\n";
        } else {
            print_r($user->errors);

            echo "Cannot delete user with id $this->id!\n";
        }
    }
}
