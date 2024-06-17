<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\Publicacion;
use app\models\PublicacionSearch;
use app\models\Categoria;

class CategoriaController extends Controller
{
    public function actionForo($id)
    {
        $categoria = Categoria::findOne($id);

        if ($categoria === null) {
            throw new \yii\web\NotFoundHttpException('La categoría no existe.');
        }

        // Aqui se compruebo si el usuario está autenticado
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Necesitas iniciar sesión para ver las publicaciones.');
            return $this->redirect(['site/login']); // Si el usuario no ha iniciado sesión, se redirige al formulario de Login
        }

        // Mantengoe l proveedor de datos existente
        $dataProvider = new ActiveDataProvider([
            'query' => Publicacion::find()->where(['id_categoria' => $id])->orderBy(['fecha_publicacion' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // Creo una instancia de PublicacionSearch para la barra de búsqueda
        $searchModel = new PublicacionSearch();

        // MAnejo la búsqueda
        if ($searchModel->load(Yii::$app->request->queryParams)) {
            $dataProvider->query->andFilterWhere(['like', 'titulo', $searchModel->titulo]);
        }

        return $this->render('foro', [
            'categoria' => $categoria,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}