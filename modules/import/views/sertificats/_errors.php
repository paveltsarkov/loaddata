<?php
use yii\widgets\DetailView;

$attr = '';
foreach ($errors as $key => $value) {
    foreach ($value['sert'] as $key => $sert) {
        $attr .= "$key ($sert) ";
    }
    $model['text'] = $value['text'];
    $model['sert'] = $attr;
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'text',
                'label' => 'Ошибка',
            ],
            [
                'attribute' => 'sert',
                'label' => 'Данные',
            ],
        ],
        
    ]);
}
//echo DetailView::widget([
//    'model' => $errors,
//    'attributes' => [
//        'text',
//        'sert',
//    ],
//        
//    ]);
?>