<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sections".
 *
 * @property int $id
 * @property int|null $pid
 * @property string|null $name
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid', 'creator_id', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'PID',
            'name' => 'Наименование',
            'creator_id' => 'Создатель',
            'category_id'=> 'Категория',
            'responsible_group_id' => 'Ответственная группа',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения'
        ];
    }
}
