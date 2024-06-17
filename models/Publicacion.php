<?php

namespace app\models;

use yii\db\ActiveRecord;

class Publicacion extends ActiveRecord
{
    public static function tableName()
    {
        return 'Publicaciones';
    }

    public function rules()
    {
        return [
            [['titulo', 'contenido', 'id_categoria', 'id_usuario', 'fecha_publicacion'], 'required'],
            [['titulo'], 'string', 'max' => 255],
            [['contenido'], 'string'],
            [['id_categoria', 'id_usuario', 'likes', 'dislikes'], 'integer'],
            [['fecha_publicacion'], 'safe'],
            [['usuarios_like', 'usuarios_dislike'], 'string'],
        ];
    }

    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'id_categoria']);
    }

    public function getUsuario()
    {
        return $this->hasOne(User::class, ['id' => 'id_usuario']);
    }

    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['id_publicacion' => 'id']);
    }
}