<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Comentarios".
 *
 * @property int $id
 * @property string $contenido
 * @property string $fecha_comentario
 * @property int $id_usuario
 * @property int $id_publicacion
 *
 * @property Publicaciones $publicacion
 * @property Usuarios $usuario
 */
class Comentario extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'Comentarios';
    }

    public function rules()
    {
        return [
            [['contenido', 'id_usuario', 'id_publicacion'], 'required'],
            [['contenido'], 'string'],
            [['fecha_comentario'], 'safe'],
            [['id_usuario', 'id_publicacion'], 'integer'],
            [['id_publicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::className(), 'targetAttribute' => ['id_publicacion' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contenido' => 'Contenido',
            'fecha_comentario' => 'Fecha Comentario',
            'id_usuario' => 'ID Usuario',
            'id_publicacion' => 'ID Publicacion',
        ];
    }

    public function getPublicacion()
    {
        return $this->hasOne(Publicacion::className(), ['id' => 'id_publicacion']);
    }

    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }
}
