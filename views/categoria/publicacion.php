<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\models\Publicacion */

?>
<div class="publicacion" data-id="<?= $model->id ?>">
    <h4><?= Html::a(Html::encode($model->titulo), ['publicacion/vista', 'id' => $model->id]) ?></h4>
    <p>Por: <?= Html::encode($model->usuario->nombre) ?></p>
    <p>Fecha de publicación: <?= Yii::$app->formatter->asDate($model->fecha_publicacion) ?></p>
    <p>
        <button class="btn btn-primary btn-like" data-action="like" data-id="<?=$model->id?>">
            <i class="fas fa-thumbs-up"></i>
        </button>
        <span class="like-count" id="textLike<?=$model->id?>"><?= $model->likes ?></span>
        <button class="btn btn-danger btn-dislike" data-action="dislike" data-id="<?=$model->id?>">
            <i class="fas fa-thumbs-down"></i>
        </button>
        <span class="dislike-count" id="textDislike<?=$model->id?>"><?= $model->dislikes ?></span>
    </p>
</div>