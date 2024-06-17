<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

class User extends ActiveRecord implements IdentityInterface
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Usuarios'; //Devuelve los registros de la tabla Usuarios
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'email', 'password'], 'required'],
            [['nombre', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
            ['email', 'unique'],
            ['password', 'string', 'min' => 6],
            ['rol', 'in', 'range' => ['usuario', 'administrador']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName = $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $filePath = '../uploads/' . $fileName;
            if ($this->imageFile->saveAs($filePath)) {
                // Guardar el nombre del archivo en la base de datos
                $this->foto = $fileName;
                // Guardar el registro en la base de datos
                return $this->save(false);
            }
        }
        return false;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Si es un nuevo registro o si se actualiza la contraseña, encriptar la contraseña
            if ($this->isNewRecord || $this->isAttributeChanged('password')) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by nombre
     *
     * @param string $nombre
     * @return static|null
     */
    public static function findByNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @var string|null The auth key for cookie-based login
     */
    public $auth_key;
}