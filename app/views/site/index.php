<?php

/* @var $this yii\web\View */

use app\widgets\TreeView;

$this->title = 'Справочники';
?>

<?= TreeView::widget([
    'dataProvider' => $dataProvider,
    'parentColumnName' => 'pid',
    'rootColumnValue' => 0,
    'columns' => [
        'name'
    ],
    'ajax' => [
        'loadingUri' => '/section/get-childs',
        'getCountUri' => 'section/get-childs-count',
        'paramName' => 'pid',
    ]
])?>
