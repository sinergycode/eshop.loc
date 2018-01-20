<?php

namespace app\models;
use yii\db\ActiveRecord;
/**
 * Description of Post
 *
 * @author user1
 */
class Post extends ActiveRecord {
    
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
    
    public static function tableName() {
        return 'post';
    }
    
    public function rules()
    {
        return [
            [['post_rate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_rate' => 'post_rate',
        ];
    }
    
    public function getRating(){ 
        return $this->hasMany(Rating::className(), ['post_id' => 'id']);
    }
}
