<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */

$this->title = 'Editar Publicación: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Foro', 'url' => ['categoria/foro', 'id' => $model->id_categoria]];
$this->params['breadcrumbs'][] = ['label' => $model->titulo, 'url' => ['vista', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="publicacion-editar">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="publicacion-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'contenido')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
