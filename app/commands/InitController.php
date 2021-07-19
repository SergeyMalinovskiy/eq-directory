<?php

namespace app\commands;

use app\models\Section;
use yii\console\Controller;
use yii\console\ExitCode;

use Faker\Factory;

class InitController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'Init')
    {
        $faker = Factory::create();

        for($i = 0; $i < 20; $i++) 
        {
            $section = new Section();

            $section->name = $faker->text(30);
            
            $section->save(false);
        }

        return ExitCode::OK;
    }
}