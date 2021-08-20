<?php


namespace app\modules\admin\components\grid;

use yii\grid\ActionColumn;

class ActionColumns extends ActionColumn
{
    public $contentOptions = [
        'style' => 'white-space: nowrap; 
                    text-align: center; 
                    letter-spacing: 0.1em; 
                    max-width: 7em;',
    ];
}