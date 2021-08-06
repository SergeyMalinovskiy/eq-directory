<?php

namespace app\models\Equipment;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Equipment\Equipment;

/**
 * EquipmentSearch represents the model behind the search form of `app\models\Equipment\Equipment`.
 */
class EquipmentSearch extends Equipment
{
    public $sections;
    public $types;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lan_ports_count', 'uplink_ports_count', 'mgt_ipv4_address', 'monsys_ipv4_address', 'pid', 'creator_id', 'category_id', 'responsible_group_id'], 'integer'],
            [['title', 'comment', 'serial_number', 'created_at', 'updated_at'], 'safe'],
            [ 'sections', 'each', 'rule' => [ 'integer' ]],
            [ 'types', 'each', 'rule' => [ 'integer' ]]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Equipment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'lan_ports_count' => $this->lan_ports_count,
            'uplink_ports_count' => $this->uplink_ports_count,
            'mgt_ipv4_address' => $this->mgt_ipv4_address,
            'monsys_ipv4_address' => $this->monsys_ipv4_address,
            'pid' => $this->pid,
            'creator_id' => $this->creator_id,
            'category_id' => $this->category_id,
            'responsible_group_id' => $this->responsible_group_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number]);

        return $dataProvider;
    }
}
