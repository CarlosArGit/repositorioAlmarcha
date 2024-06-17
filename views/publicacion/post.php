<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Crear Publicación';
$this->params['breadcrumbs'][] = ['label' => 'Foro', 'url' => ['categoria/foro', 'id' => $model->id_categoria]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="publicacion-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'contenido')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
        ]) ?>

        <?= $form->field($model, 'fecha_publicacion')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false) ?>

        <?= $form->field($model, 'id_usuario')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>