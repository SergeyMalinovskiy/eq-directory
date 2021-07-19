<?php

namespace app\models\Equipment;

use Yii;
use app\models\Section;
use Exception;

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
            [['title', 'serial_number', 'monsys_ipv4_address'], 'required'],
            [['comment', 'mgt_ipv4_address',], 'string'],
            [['lan_ports_count', 'uplink_ports_count', 'pid'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['serial_number'], 'string', 'max' => 64],
            [['mgt_ipv4_address', 'monsys_ipv4_address'], 'ip']
        ];
    }

    public function beforeSave($insert)
    {
        if (!$insert) return true;

        //Converting ip address values to integer
        if (is_int($this->mgt_ipv4_address) && is_int($this->monsys_ipv4_address)) return true;
        else {
            try {
                $this->mgt_ipv4_address     = sprintf("%u", ip2long($this->mgt_ipv4_address));
                $this->monsys_ipv4_address  = sprintf("%u", ip2long($this->monsys_ipv4_address));

                return true;
            } catch (Exception $e) {
                return false;
            }
        }
    }

    public function afterFind()
    {
        //Converting integer ip addresses to string
        $this->mgt_ipv4_address     = long2ip($this->mgt_ipv4_address);
        $this->monsys_ipv4_address  = long2ip($this->monsys_ipv4_address);

        $this->pid = $this->getParentSectionName();
    }

    private function getParentSectionName()
    {
        $parentSection = Section::findOne($this->pid);

        return is_null($parentSection)
            ? $this->pid
            : $parentSection->name;
    }

    public function getHeirarchyList()
    {
        /** 
         * Алгоритм по вычислению иерархии связанных разделов (section)
         * Возможно использование рекурсивного запроса напрямую к базе данных
         */
    }

    /* public function getResposibleGroup() {
        return $this->hasOne();
    } */

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
            'pid' => 'Привязано к',
            'category_id' => 'Категория',
            'responsible_group_id' => 'Ответственная группа',
        ];
    }
}
