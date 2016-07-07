<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminLteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/AdminLTE/dist/css/AdminLTE.css',
        'themes/AdminLTE/dist/css/skins/_all-skins.css',
        /*'themes/AdminLTE/bootstrap/css/bootstrap-paper.css',*/
        'themes/AdminLTE/plugins/datatables/dataTables.bootstrap.css',
        'lib/font-awesome/css/font-awesome.css'
    ];
    public $js = [
        'themes/AdminLTE/bootstrap/js/bootstrap.js',
        'themes/AdminLTE/dist/js/app.js',
        'themes/AdminLTE/dist/js/demo.js',
        'themes/AdminLTE/plugins/datatables/jquery.dataTables.js',
        'themes/AdminLTE/plugins/datatables/dataTables.bootstrap.js',
        'themes/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
