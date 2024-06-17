<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;

$this->registerCssFile(Url::to('@web/css/index.css'), ['depends' => [YiiAsset::class]]);

?>

<div class="container">
    <div class="mb-4">
        <h2>General</h2><br>
        <ul class="list-group">
            <?php foreach ($categorias as $categoria): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center categoria-item">
                    <?= Html::a(Html::encode($categoria->nombre), ['categoria/foro', 'id' => $categoria->id]) ?>
                    <span class="badge bg-primary rounded-pill"><?= $categoria->getNumeroPublicaciones() ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>