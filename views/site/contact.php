<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Contacto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Su mensaje ha sido recibido. Nos pondremos en contacto con usted a la mayor brevedad posible.
        </div>

    <?php else: ?>

        <div class="titulo-contacto">
            <p><strong>Si tienes cualquier duda o sugerencia, ¡no dudes en contactar con nosotros!</p></strong>
        </div>
        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Nombre') ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject')->label('Asunto') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('Mensaje') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        // Limpiar campos del formulario
        document.getElementById('contact-form').reset();
    <?php endif; ?>
});
</script>