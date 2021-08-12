<?php

namespace app\services;

use app\models\Equipment\EquipmentSearch;
use app\models\SectionSearch;
use yii\web\NotFoundHttpException;

class EquipmentService {
    /**
     * @param array $param
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function getAllWithSections($param)
    {
        $sections = (new SectionSearch())
                        ->find()
                        ->where($param)
                        ->asArray()
                        ->all();

        $equipments = (new EquipmentSearch())
                        ->find()
                        ->where($param)
                        ->asArray()
                        ->all();

        if($sections === null && $equipments === null) throw new NotFoundHttpException();

        foreach($sections as $key => $section) $sections[$key] = array_merge($section, ['type' => 'section']);
        foreach($equipments as $key => $equipment) $equipments[$key] = array_merge($equipment, ['type' => 'equipment']);

        return array_merge($sections, $equipments);
    }   
}
