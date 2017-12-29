<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string $title
 * @property string $excerpt
 * @property string $text
 * @property string $keywords
 * @property string $description
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $image;
    
    public function behaviors(){
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'title', 'excerpt', 'text'], 'required'],
            [['created_at'], 'safe'],
            [['text'], 'string'],
            [['title', 'excerpt', 'keywords', 'description'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата создания',
            'title' => 'Заголовок',
            'excerpt' => 'Краткое содержание',
            'text' => 'Полное содержание',
            'author' => 'Автор',
            'keywords' => 'Мета ключевики',
            'description' => 'Мета описание',
            'image' => 'Фото заголовка статьи',
        ];
    }
    
    public function upload(){
        if($this->validate()){
            $path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        }else{
            return false;
        }
    }
}
