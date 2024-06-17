<?php

use yii\helpers\Html;
use app\models\Comentario;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */
/* @var $nuevoComentario app\models\Comentario */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Foro', 'url' => ['categoria/foro', 'id' => $model->id_categoria]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicacion-view">

    <div class="datos-publicacion">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <strong>Autor:</strong> <?= Html::encode($model->usuario->nombre) ?><br>
            <strong>Fecha de Publicación:</strong> <?= Yii::$app->formatter->asDate($model->fecha_publicacion) ?>
        </p>

        <div>
            <?= $model->contenido ?>
        </div>

        <?php if (Yii::$app->user->identity->rol === 'administrador' || $model->id_usuario == Yii::$app->user->id): ?>
            <p>
                <?= Html::a('Editar', ['editar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Borrar', ['borrar', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Estás seguro de que deseas borrar esta publicación?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        <?php endif; ?>
    </div>

    <h2>Comentarios</h2>

    <?php foreach ($model->comentarios as $comentario): ?>
        <div class="comentario">
            <p>
                <strong><?= Html::encode($comentario->usuario->nombre) ?>:</strong>
                <?= nl2br(Html::encode($comentario->contenido)) ?>
                <br>
                <small><?= Yii::$app->formatter->asDatetime($comentario->fecha_comentario) ?></small>
            </p>
        </div>
    <?php endforeach; ?>

    <h3>Añadir Comentario</h3>

    <div class="comentario-form">
        <?php $form = ActiveForm::begin(['action' => ['publicacion/comentar', 'id' => $model->id]]); ?>
        <?= $form->field($nuevoComentario, 'contenido')->textarea(['rows' => 6]) ?>
        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>