<?php

namespace api\modules\v1\controllers;

use yii\rest\Controller;

/**
 * Class SiteController
 * @package api\modules\v1\controllers
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
    public function actionTest()
    {
        return 'Test';
    }
}
