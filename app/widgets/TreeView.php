<?php

namespace app\widgets;

use Exception;
use Yii;
use yii\base\Widget;

/**
 * @property yii\data\ActiveDataProvider $dataProvider 
 * @property array $columns
 * @property array $ajax
 */
class TreeView extends Widget
{
    public $dataProvider;
    public $columns;
    public $rootColumnValue = 0;
    public $parentColumnName;
    public $ajax;
    private $data;

    public function init()
    {
        if($this->dataProvider === null) throw new Exception('$dataProvider not provided!');

        $this->data = $this->dataProvider->query->where([$this->parentColumnName => $this->rootColumnValue])->all();
    }

    public function run()
    {
        return $this->render('TreeView', [
            'data' => $this->data,
            'columns' => $this->columns,
            'ajaxUri' => $this->ajax['loadingUri'],
            'ajaxParamName' => $this->ajax['paramName'],
            'getChildsCountUri' => $this->ajax['getCountUri']
        ]);
    }
}