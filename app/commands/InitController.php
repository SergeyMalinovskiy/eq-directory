<?php

namespace app\commands;

use app\models\Section;
use app\models\Section\SectionCategory;
use app\models\Section\SectionCategorySearch;
use app\models\SectionSearch;
use yii\console\Controller;
use yii\console\ExitCode;

class InitController extends Controller
{
    private $sections = [
        [
            'name'  => 'Главный корпус',
            'short' => 'гл',
            'category' => 1
        ],
        [
            'name' => 'Лабораторный корпус',
            'short' => 'лк',
            'category' => 1
        ],
        [
            'name' => 'Химический корпус',
            'short' => 'хим',
            'category' => 1
        ],
        [
            'name' => 'Энергетический корпус',
            'short' => 'эн',
            'category' => 1
        ],
        [
            'name' => 'Учебно-библотечный корпус',
            'short' => 'убк',
            'category' => 1
        ],
        [
            'name' => 'Библиотечный корпус',
            'short' => 'бк',
            'category' => 1
        ],
        [
            'name' => 'Робототехнический корпус',
            'short' => 'рт',
            'category' => 1
        ],
        [
            'name' => 'Горный корпус',
            'short' => 'гг',
            'category' => 1
        ]
    ];

    private $sectionCategories = [
        [
            'id' => 1,
            'name' => 'Корпуса',
            'short' => 'корп.'
        ],
        [
            'id' => 2,
            'name' => 'Аудитории',
            'short' => 'ауд.'
        ],
        [
            'id' => 3,
            'name' => 'Шкафы',
            'short' => 'шк.'
        ],
        [
            'id' => 4,
            'name' => 'Патч-панели',
            'short' => 'пп.'
        ],
    ];

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'Init')
    {
        $sections = $this->sections;
        $sectionCategories = $this->sectionCategories;

        foreach($sections as $rawSection) {
            $sectionSearch = new SectionSearch();

            //if($sectionSearch->find(['name' => $rawSection['name']]) != null) continue;

            $section = new Section();

            $section->name = $rawSection['name'];
            $section->category_id = $rawSection['category'];
            $section->save(false);

            echo date("Y-m-d H:i:s").': Inserted into '.$section->tableName().' - '.$section->name . PHP_EOL;
        }
        echo PHP_EOL;

        foreach($sectionCategories as $rawSectionCategory) {
            $sectionCategorySearch = new SectionCategorySearch();

            //if($sectionCategorySearch->find(['name' => $rawSectionCategory['name']])) continue;

            $sectionCategory = new SectionCategory();

            $sectionCategory->id = $rawSectionCategory['id'];
            $sectionCategory->name = $rawSectionCategory['name'];
            $sectionCategory->short_name = $rawSectionCategory['short'];
            $sectionCategory->save(false);

            echo date("Y-m-d H:i:s").': Inserted into '.$sectionCategory->tableName().' - '.$sectionCategory->name . PHP_EOL;
        }
        echo PHP_EOL;

        echo 'Done!';

        return ExitCode::OK;
    }
}