<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PublicacionSearch extends Publicacion
{
    public function rules()
    {
        return [
            [['titulo'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Publicacion::find()->where(['id_categoria' => $params['id_categoria']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Filtro la busqueda por título
        $query->andFilterWhere(['like', 'titulo', $this->titulo]);

        return $dataProvider;
    }
}
