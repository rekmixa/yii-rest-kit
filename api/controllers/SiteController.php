<?php

namespace api\controllers;

use yii\rest\Controller;

/**
 * Class SiteController
 * @package api\controllers
 */
class SiteController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return 'Hello, World!';
    }

    /**
     * @return string
     */
    public function actionError()
    {
        return 'Error';
    }
}
