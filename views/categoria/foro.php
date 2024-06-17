<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap5\Alert;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $categoria app\models\Categoria */
/* @var $searchModel app\models\PublicacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $categoria->nombre;
$this->params['breadcrumbs'][] = $this->title;
//$this->registerJsFile('@web/js/foro.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="categoria-foro">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Nuevo Tema', ['publicacion/post', 'id_categoria' => $categoria->id], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php
    // Mostrar mensaje flash si está presente
    if (Yii::$app->session->hasFlash('error')) {
        echo Alert::widget([
            'options' => ['class' => 'alert-danger'],
            'body' => Yii::$app->session->getFlash('error'),
        ]);
    }
    ?>

    <!-- Barra de busqueda -->
    <div class="search-bar">
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['categoria/foro', 'id' => $categoria->id]]); ?>
            <?= $form->field($searchModel, 'titulo')->textInput(['placeholder' => 'Buscar publicaciones'])->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="list-group">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => 'publicacion', 
        ]) ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn-like, .btn-dislike').forEach(button => {
        button.addEventListener('click', () => {
            const action = button.getAttribute('data-action');
            const publicacionId = button.dataset.id;
            
            const url = action === 'like' ? 'index.php?r=publicacion/like&id=' + publicacionId : 'index.php?r=publicacion/dislike&id=' + publicacionId;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': '<?= Yii::$app->request->getCsrfToken() ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (action === 'like') {
                        document.querySelector(`#textLike${publicacionId}`).innerHTML = data.likes;
                    } else {
                        document.querySelector(`#textDislike${publicacionId}`).innerHTML = data.dislikes;
                    }
                } else {
                    alert(data.message || 'Error al procesar la solicitud.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        });
    });
});
</script>