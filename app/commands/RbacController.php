<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Права CRUD для секций
        $createSection = $auth->createPermission('createSection');
        $createSection->description = 'Добавление секции';
        $auth->add($createSection);

        $updateSection = $auth->createPermission('updateSection');
        $updateSection->description = 'Изменение секции';
        $auth->add($updateSection);

        $deleteSection = $auth->createPermission('deleteSection');
        $deleteSection->description = 'Удаление секции';
        $auth->add($deleteSection);

        // Права CRUD для типа секций
        $createSectionCategory = $auth->createPermission('createSectionCategory');
        $createSectionCategory->description = 'Добавление типа секции';
        $auth->add($createSectionCategory);

        $updateSectionCategory = $auth->createPermission('updateSectionCategory');
        $updateSectionCategory->description = 'Изменение типа секции';
        $auth->add($updateSectionCategory);

        $deleteSectionCategory  = $auth->createPermission('deleteSectionCategory');
        $deleteSectionCategory->description = 'Удаление типа секции';
        $auth->add($deleteSectionCategory);

        // Права CRUD для оборудования
        $createEquipment = $auth->createPermission('createEquipment');
        $createEquipment->description = 'Добавление оборудования';
        $auth->add($createEquipment);

        $updateEquipment = $auth->createPermission('updateEquipment');
        $updateEquipment->description = 'Изменение оборудования';
        $auth->add($updateEquipment);

        $deleteEquipment = $auth->createPermission('deleteEquipment');
        $deleteEquipment->description = 'Удаление оборудования';
        $auth->add($deleteEquipment);

        // Настройка ролей
        $operator = $auth->createRole('operator');
        $auth->add($operator);
        $auth->addChild($operator, [
            $createSection,
            $updateSection,

            $createEquipment,
            $updateEquipment,
        ]);

        $admin= $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, [
            $operator,
            
            $createSectionCategory,
            $deleteSectionCategory,

            $deleteEquipment,
            $deleteSection
        ]);
    }
} 
