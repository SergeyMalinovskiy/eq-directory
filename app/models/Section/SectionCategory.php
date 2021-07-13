<?php

namespace app\models\Section;

use Yii;

/**
 * This is the model class for table "section_categories".
 *
 * @property int $id
 * @property string $name
 * @property string|null $short_name
 * @property int $creator_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class SectionCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['creator_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['short_name'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'short_name' => 'Short Name',
            'creator_id' => 'Creator ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
