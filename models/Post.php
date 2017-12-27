<?php

namespace app\models;
use yii\db\ActiveRecord;
/**
 * Description of Post
 *
 * @author user1
 */
class Post extends ActiveRecord {
    
    public static function tableName() {
        return 'post';
    }
}
