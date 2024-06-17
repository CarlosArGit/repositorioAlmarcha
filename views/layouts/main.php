<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use rmrevin\yii\fontawesome\AssetBundle as FontAwesomeAsset;

AppAsset::register($this);
FontAwesomeAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::cssFile('@web/css/index.css') ?>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header" class="bg-dark text-white py-4">
    <div class="container d-flex justify-content-between align-items-center">
        <?= Html::a(Html::img('@web/img/logo1.png', ['alt' => 'Afterlife Forum', 'style' => 'width: 130px;'])) ?>

        <div>
            <h1 class="m-0 fst-italic" style="color: #fff700;"><?= Html::a('Afterlife Forum', Yii::$app->homeUrl, ['class' => 'navbar-brand']) ?></h1>
            
        </div>
        <div class="d-flex align-items-center">
            <?php
            $menuItems = [
                ['label' => 'Principal', 'url' => ['/site/index']],
                ['label' => 'Sobre Nosotros', 'url' => ['/site/about']],
                ['label' => 'Contacto', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Iniciar Sesión', 'url' => ['/site/login']];
                $menuItems[] = ['label' => 'Registro', 'url' => ['/site/registro']];
            } else {
                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton('Logout', ['class' => 'btn btn-link logout'])
                    . Html::encode(Yii::$app->user->identity->nombre) . '  '
                    . "<img src='".Yii::$app->request->baseUrl."/img/uploads/".Yii::$app->user->identity->foto."' class='profile-image' style='width: 32px; height: 32px;'/>"
                    . Html::endForm()
                    . '</li>';
            }
            echo '<div class="navbar-nav">';
            echo Nav::widget([
                'options' => ['class' => 'd-flex'],
                'items' => $menuItems,
            ]);
            echo '</div>';
            ?>
        </div>
    </div>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <h3>Síguenos en redes sociales:</h3>
        <div class="footer-icons">
            <a href="<?= Yii::$app->urlManager->createUrl(['site/redes']) ?>"><i class="fab fa-facebook-f fa-2x me-3"></i></a>
            <a href="<?= \yii\helpers\Url::to('https://www.twitter.com', true) ?>" target="_blank"><i class="fab fa-twitter fa-2x me-3"></i></a>            <a href="<?= Yii::$app->urlManager->createUrl(['site/redes']) ?>"><i class="fab fa-instagram fa-2x me-3"></i></a>
            <div class="copy float-start">
            &copy; <?= date('Y') ?> Afterlife Forum
            </div>
            <?= Html::a('Volver a Principal', ['site/index'], ['class' => 'float-end']) ?>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>