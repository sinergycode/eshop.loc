<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property string $id
 * @property string $post_id
 * @property integer $user_username
 * @property string $ip
 * @property integer $vote
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }
    
    public function rules()
    {
        return [
            [['number_votes', 'total_points', 'dec_avg', 'post_id'], 'safe'],
        ];
    }

}
