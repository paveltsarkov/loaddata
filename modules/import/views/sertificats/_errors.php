<?php
use yii\widgets\DetailView;
?>
<div class="bs-callout bs-callout-danger">
    <h4>В процессе работы возникли следующие ошибки:</h3>

<?php
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
                'attribute' => 'sert',
                'label' => $model['text'],
            ],
        ],
        
    ]);
}
?>
</div>