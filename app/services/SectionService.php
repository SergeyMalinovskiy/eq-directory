<?php

namespace app\services;

use app\models\Section\SectionCategory;
use app\models\SectionSearch;

class SectionService {
    /**
     * @param array $param
     * @return Section
     * @throws NotFoundHttpException if the model cannot be found
     */  
    private static function getSectionById($id) {
        return (new SectionSearch())->findOne($id);
    }

    private static function getSectionCategoryById($id) {
        return (new SectionCategory())->findOne($id);
    }

    /**
     * @param array $param
     * @return Section
     * @throws NotFoundHttpException if the model cannot be found
     */ 
    public static function getSectionNameById($id) {
        $section = self::getSectionById($id);
        return $section !== null ? $section->name : '-';
    }

    public static function getSectionCategoryNameById($id) {
        $sectionCategory = self::getSectionCategoryById($id);
        return $sectionCategory !== null ? $sectionCategory->name : '-';
    }
}
