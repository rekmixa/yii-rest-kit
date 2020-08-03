<?php
Yii::setAlias('@app', dirname(dirname(__DIR__)));
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

$dotenv = Dotenv\Dotenv::createImmutable(Yii::getAlias('@app'));
$dotenv->load();

require dirname(__DIR__) . '/helpers.php';
