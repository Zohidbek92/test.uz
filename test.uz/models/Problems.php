<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "problems".
 *
 * @property int $id
 * @property string $author
 * @property string $problem_about
 * @property string $problem_text
 * @property int $category_id
 * @property string $adddate
 */
class Problems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'problems';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'problem_about', 'problem_text', 'category_id', 'adddate'], 'required'],
            [['problem_text'], 'string','max' => 2000, 'min' => '10'],
            [['category_id'], 'integer'],
            [['adddate'], 'safe'],
            [['problem_about'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Muallif',
            'problem_about' => 'Muammo nimada?',
            'problem_text' => 'Masala sharti',
            'category_id' => 'Kategoriya',
            'adddate' => 'Sana',
        ];
    }
    public function getKategoriya()
    {
        return $this->hasOne(Math_category::className(), ['id'=>'category_id']);
    }
}
