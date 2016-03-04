<?php
use yii\widgets\DetailView;
?>
<div class="bs-callout bs-callout-danger">
    <h4>В процессе работы возникли следующие ошибки:</h3>

<?php
foreach ($errors as $key => $error) {
    $data = '';
    foreach ($error['sert'] as $key => $sert) {
        $data .= "$key ($sert) ";
    }
    $model[] = ['data' => $data];
    
    $attr[] = [
        'label' => $error['text'],
        'value' => $data,
    ];
    $data = '';
}

echo DetailView::widget([
    'model' => $model,
    'attributes' => $attr,
]);
?>
</div>