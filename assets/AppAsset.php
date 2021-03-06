<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'web/css/font-awesome.min.css',
        'css/animate.min.css',
        'css/lightbox.css',
        'css/main.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/jquery.js',
        'js/jquery.countTo.js',
        'js/bootstrap.min.js',
        'js/lightbox.min.js',
        'js/wow.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
