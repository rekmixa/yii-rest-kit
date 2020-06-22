<?php

namespace api\modules\v1;

use yii\base\Module as BaseModule;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * Class Module
 * @package api\modules\v1
 */
class Module extends BaseModule
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'rateLimiter' => [
                'class' => RateLimiter::class,
            ],
        ]);
    }
}
