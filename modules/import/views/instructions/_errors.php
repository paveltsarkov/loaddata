<?php
use yii\widgets\DetailView;
?>
<div class="bs-callout bs-callout-danger">
    <h4>В процессе работы возникли следующие ошибки:</h3>

<?php
foreach ($errors as $key => $error) {
    $data = '';
    foreach ($error['instr'] as $key => $instr) {
        $data .= "$key ($instr) ";
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