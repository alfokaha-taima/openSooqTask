<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        // 'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public function behaviors()
{
return [
    'access' => [
        'class' => \yii\filters\AccessControl::className(),
        'only' => ['create', 'update'],
        'rules' => [
            // deny all POST requests
            [
                'allow' => false,
                'verbs' => ['POST']
            ],
            // allow authenticated users
            [
                'allow' => true,
                'roles' => ['@'],
            ],
            // everything else is denied
        ],
    ],
];
}
}
