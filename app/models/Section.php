<?php

namespace app\models;

use app\models\Section\SectionCategory;
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

    public function afterFind()
    {
        $this->category_id = $this->getCategoryName();
        $this->pid = $this->getParentSectionName();
    }

    private function getCategoryName() {
        $category = SectionCategory::findOne($this->category_id);

        return is_null($category)
            ? $category
            :  $category->name;
    }

    private function getParentSectionName() {
        $parentSection = Section::findOne($this->pid);

        return is_null($parentSection ) 
            ? $this->pid 
            : $parentSection->name;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Родительский раздел',
            'name' => 'Наименование',
            'creator_id' => 'Создатель',
            'category_id'=> 'Категория',
            'responsible_group_id' => 'Ответственная группа',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения'
        ];
    }
}
