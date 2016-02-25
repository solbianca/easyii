<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\easyii\assets\AdminAsset;

$asset = AdminAsset::register($this);
$moduleName = $this->context->module->id;
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::t('easyii', 'Control Panel') ?> - <?= Html::encode($this->title) ?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet'
          type='text/css'>
    <link rel="shortcut icon" href="<?= $asset->baseUrl ?>/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= $asset->baseUrl ?>/favicon.ico" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="admin-body">
    <div class="container">
        <div class="wrapper">
            <div class="header">
                <div class="logo">
                    <img src="<?= $asset->baseUrl ?>/img/b-header__logo.png" style="width: 60px">
                </div>
                <div class="nav">
                    <a href="<?= Url::to(['/']) ?>" class="pull-left">
                        <i class="glyphicon glyphicon-home"></i> <?= Yii::t('easyii', 'Open site') ?>
                    </a>
                    <a href="<?= Url::to(['/user/logout']) ?>" class="pull-right">
                        <i class="glyphicon glyphicon-log-out"></i> <?= Yii::t('easyii', 'Logout') ?>
                    </a>
                </div>
            </div>
            <div class="main">
                <div class="box sidebar">
                    <?php
                    $catalogActive = '';
                    $catalog = Yii::$app->getModule('admin')->activeModules['catalog'];
                    if ($moduleName === $catalog->name AND $this->context->id !== 'genre') {
                        $catalogActive = 'active';
                    }
                    ?>
                    <?php if (Yii::$app->user->can('LinkToCatalog')): ?>
                        <a href="<?= Url::to(['/admin/catalog/a/index']) ?>"
                           class="menu-item <?= $catalogActive ?>">
                            <i class="glyphicon glyphicon-<?= $catalog->icon ?>"></i>
                            <?= Yii::t('app', 'Catalog') ?>
                        </a>
                    <?php endif; ?>
                    <?php
                    $shopcartActive = '';
                    $shopcart = Yii::$app->getModule('admin')->activeModules['shopcart'];
                    if ($moduleName === $shopcart->name AND $this->context->id !== 'genre') {
                        $shopcartActive = 'active';
                    }
                    ?>
                    <?php if (Yii::$app->user->can('LinkToNews')): ?>
                        <a href="<?= Url::to(['/admin/news/default/index']) ?>"
                           class="menu-item <?= ($moduleName === 'news') ? 'active' : '' ?>">
                            <i class="glyphicon glyphicon-bullhorn"></i>
                            <?= Yii::t('app', 'News') ?>
                        </a>
                    <?php endif; ?>
                    <?php if (Yii::$app->user->can('LinkToEquipment')): ?>
                        <a href="<?= Url::to(['/admin/equipment/default/index']) ?>"
                           class="menu-item <?= ($moduleName === 'equipment') ? 'active' : '' ?>">
                            <i class="glyphicon glyphicon-facetime-video"></i>
                            <?= Yii::t('app', 'Equipment') ?>
                        </a>
                    <?php endif; ?>
                    <?php if (Yii::$app->user->can('LinkToLogs')): ?>
                        <a href="<?= Url::to(['/admin/logs/default/index']) ?>"
                           class="menu-item <?= ($moduleName === 'logs') ? 'active' : '' ?>">
                            <i class="glyphicon glyphicon-copy"></i>
                            <?= Yii::t('app', 'Logs') ?>
                        </a>
                    <?php endif; ?>
                    <?php if (Yii::$app->user->can('LinkToSettings')): ?>
                        <a href="<?= Url::to(['/admin/catalog/genre']) ?>"
                           class="menu-item <?= ($this->context->id === 'genre') ? 'active' : '' ?>">
                            <i class="glyphicon glyphicon-facetime-video"></i>
                            <?= Yii::t('app', 'Settings') ?>
                        </a>
                    <?php endif; ?>
                    <?php if (Yii::$app->user->can('LinkToClients')): ?>
                        <a href="<?= Url::to(['/admin/user/client/index']) ?>"
                           class="menu-item <?= ($this->context->id === 'client') ? 'active' : '' ?>">
                            <i class="glyphicon glyphicon-user"></i>
                            <?= Yii::t('app', 'Clients') ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="box content">
                    <div class="page-title">
                        <?= $this->title ?>
                    </div>
                    <div class="container-fluid">
                        <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message) : ?>
                            <div class="alert alert-<?= $key ?>"><?= $message ?></div>
                        <?php endforeach; ?>
                        <?= $content ?>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
