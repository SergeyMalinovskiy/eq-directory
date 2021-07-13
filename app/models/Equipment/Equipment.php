<?php

namespace app\models\Equipment;

use Yii;

/**
 * This is the model class for table "equipments".
 *
 * @property int $id
 * @property string $title
 * @property string|null $comment
 * @property string $serial_number
 * @property int|null $lan_ports_count
 * @property int|null $uplink_ports_count
 * @property int|null $mgt_ipv4_address
 * @property int|null $monsys_ipv4_address
 * @property int|null $pid
 * @property int $creator_id
 * @property int|null $category_id
 * @property int|null $responsible_group_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'serial_number'], 'required'],
            [['comment'], 'string'],
            [['lan_ports_count', 'uplink_ports_count', 'mgt_ipv4_address', 'monsys_ipv4_address', 'pid', 'creator_id', 'category_id', 'responsible_group_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['serial_number'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'comment' => 'Комментарий',
            'serial_number' => 'Серийный номер',
            'lan_ports_count' => 'Количество LAN портов',
            'uplink_ports_count' => 'Количество UpLink портов',
            'mgt_ipv4_address' => 'MGT IP адрес',
            'monsys_ipv4_address' => 'IP адрес в системе мониторинга',
            'pid' => 'Привязано',
            'creator_id' => 'Создано',
            'category_id' => 'Категория',
            'responsible_group_id' => 'Ответсвенная группа',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }
}
