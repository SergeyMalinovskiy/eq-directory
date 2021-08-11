<?php

/**
 * @var yii\web\View    $this   
 * @var array           $columns
 * @var string          $ajaxUri
 * @var string          $ajaxParamName
 * @var string          $getChildsCountUri
 */

$this->registerJs(
    "
    $('.dir').click(function(e) {
        e.stopPropagation();
        const currentElement = $(this);

        const loadingSpinner = currentElement.children().first();

        if(!currentElement.next('ul').length) {
            loadingSpinner.show();
            $.ajax({
                url: '{$ajaxUri}?{$ajaxParamName}='+currentElement.attr('data-id'),
                method: 'GET',
                success: function(...response) {
                    const result = JSON.parse(response[0])

                    const resultValues = Object.values(result);

                    const data = Object.keys(result).map((el, index) => {
                        return {
                            id: parseInt(el),
                            name: resultValues[index]
                        }
                    });

                    if(data.length !== 0) {
                        const listItems = data.reduce((a, c, idx) => {
                            return a + '<li data-id='+c.id+' class=\'list-group-item\'>'+c.name+'</li>'
                        }, '');
        
                        currentElement.after(`
                            <ul style='display: none'>
                                `+listItems+`
                            </ul>
                        `)

                        currentElement.next().slideToggle();
                    }
                },
                complete: function() {
                    loadingSpinner.hide();
                }
            })
        }

        currentElement.next('ul').length && currentElement.next().slideToggle();
    });
    ",
    $this::POS_READY
);
?>

<style>
    .selected:hover {
        cursor: pointer;
        background-color: #f8f9fa;
    }
</style>

<div>
    <ul class="list-group">
        <?php foreach($data as $item): ?>
            <li 
                class="list-group-item d-flex dir selected"
                data-id=<?= $item->__get('id')?>
            >
                <div class="mr-1" style="width: 16px; display: none">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <?php foreach($columns as $column): ?>
                       <?= $item->__get($column) ?>
                    <?php endforeach ?>

                    <span class="badge badge-primary badge-pill">14</span>
                </div>
            </li>
        <?php endforeach ?>
        
    </ul>
</div>