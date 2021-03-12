<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "solutions".
 *
 * @property int $id
 * @property int $problem_id
 * @property int $user_id
 * @property string $solution_text
 * @property string $adddate
 */
class Solutions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solutions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['problem_id', 'user_id', 'solution_text'], 'required'],
            [['problem_id', 'user_id'], 'integer'],
            [['solution_text'], 'string'],
            [['adddate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'problem_id' => 'Problem ID',
            'user_id' => 'User ID',
            'solution_text' => 'Izoh qoldirish',
            'adddate' => 'Sana',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
}
