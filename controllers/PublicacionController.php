<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Publicacion;
use app\models\Comentario;
use yii\web\NotFoundHttpException;

class PublicacionController extends Controller
{
    public function actionPost($id_categoria)
    {
        $model = new Publicacion();
        $model->id_categoria = $id_categoria;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['categoria/foro', 'id' => $id_categoria]);
        }

        return $this->render('post', [
            'model' => $model,
        ]);
    }

    public function actionVista($id)
    {
        $publicacion = Publicacion::findOne($id);
        $nuevoComentario = new Comentario();  // Inicializo una nueva instancia de Comentario

        return $this->render('vista', [
            'model' => $publicacion,
            'nuevoComentario' => $nuevoComentario,  // PAso $nuevoComentario a la vista
        ]);
    }

    public function actionEditar($id)
    {
        $model = $this->findModel($id);

        if ($model->id_usuario != Yii::$app->user->id && Yii::$app->user->identity->rol !== 'administrador') {
            throw new \yii\web\ForbiddenHttpException('No tienes permiso para editar esta publicación.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['vista', 'id' => $model->id]);
        }

        return $this->render('editar', [
            'model' => $model,
        ]);
    }

    public function actionBorrar($id)
    {
        $model = $this->findModel($id);

        if ($model->id_usuario != Yii::$app->user->id && Yii::$app->user->identity->rol !== 'administrador') {
            throw new \yii\web\ForbiddenHttpException('No tienes permiso para borrar esta publicación.');
        }

        $model->delete();

        return $this->redirect(['categoria/foro', 'id' => $model->id_categoria]);
    }

    public function actionComentar($id)
    {
        // Creo una nueva instancia de Comentario
        $nuevoComentario = new Comentario();

        // Cargo los datos del formulario al modelo de Comentario
        if ($nuevoComentario->load(Yii::$app->request->post())) {
            
            // Asi asigno el id de la publicación al comentario
            $nuevoComentario->id_publicacion = $id;

            // Y aqui asigno el id del usuario actual como el autor del comentario
            $nuevoComentario->id_usuario = Yii::$app->user->id;

            // Guardo el comentario en la base de datos
            if ($nuevoComentario->save()) {
                // Y finalmente redirijo a la vista de la publicación después de guardar el comentario
                return $this->redirect(['vista', 'id' => $id]);
            } else {
                Yii::error('Error al guardar el comentario: ' . print_r($nuevoComentario->errors, true));
            }
        }
        $publicacion = Publicacion::findOne($id);
        return $this->render('vista', [
            'model' => $publicacion,
            'nuevoComentario' => $nuevoComentario,
        ]);
    }

    public function actionLike($id)
    {
        $model = $this->findModel($id);
        $userId = Yii::$app->user->id;

        $votedUsersLike = !empty($model->usuarios_like) ? explode(',', $model->usuarios_like) : [];
        $votedUsersDislike = !empty($model->usuarios_dislike) ? explode(',', $model->usuarios_dislike) : [];

        if (in_array($userId, $votedUsersLike) || in_array($userId, $votedUsersDislike)) {
            return $this->asJson(['success' => false, 'message' => 'Ya has votado esta publicación.']);
        }

        $model->likes += 1;
        $votedUsersLike[] = $userId;
        $model->usuarios_like = implode(',', $votedUsersLike);

        if ($model->save()) {
            return $this->asJson(['success' => true, 'likes' => $model->likes]);
        } else {
            return $this->asJson(['success' => false]);
        }
    }

    public function actionDislike($id)
    {
        $model = $this->findModel($id);
        $userId = Yii::$app->user->id;

        $votedUsersLike = !empty($model->usuarios_like) ? explode(',', $model->usuarios_like) : [];
        $votedUsersDislike = !empty($model->usuarios_dislike) ? explode(',', $model->usuarios_dislike) : [];

        if (in_array($userId, $votedUsersLike) || in_array($userId, $votedUsersDislike)) {
            return $this->asJson(['success' => false, 'message' => 'Ya has votado esta publicación.']);
        }

        $model->dislikes += 1;
        $votedUsersDislike[] = $userId;
        $model->usuarios_dislike = implode(',', $votedUsersDislike);

        if ($model->save()) {
            return $this->asJson(['success' => true, 'dislikes' => $model->dislikes]);
        } else {
            return $this->asJson(['success' => false]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Publicacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página no existe');
    }
}