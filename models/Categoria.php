<?php

namespace app\models;

use yii\db\ActiveRecord;

class Categoria extends ActiveRecord
{
    public static function tableName()
    {
        return 'Categorias';
    }

    public function getPublicaciones()
    {
        return $this->hasMany(Publicacion::class, ['id_categoria' => 'id']);
    }

    public function getNumeroPublicaciones()
    {
        return $this->getPublicaciones()->count();
    }
}