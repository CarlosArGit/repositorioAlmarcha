<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Registro de Usuario';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'nombre')->textInput() ?>

<?= $form->field($model, 'email')->textInput()->label('Email') ?>

<?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>

<?= $form->field($model, 'imageFile')->fileInput()->label('Foto de perfil') ?>

<div class="form-group">
    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
