<?php
use yii\helpers\Html; 
use yii\widgets\ActiveForm;

$this->title = 'Переименование файлов инструкций и сертификатов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-default-index">
    <h1><?= $this->title ?></h1>
</div>
<div class="default-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'form-inline']]); ?>

        <?= $form->field($model, 'folderName')->dropDownList($folders, ['prompt' => '', 'class' => 'form-control'])->label('Выбрать папку'); ?>
    
        <div class="form-group">
            <?= Html::submitButton('Начать', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>

<hr>
<?php
if (isset($report)){
?>
<div class="h4">Отчет:</div>
    <table class="table table-striped table-condensed">
    <tr>
        <th>Сообщение</th>
    </tr>
<?php    
    foreach ($report as $m) {
?>
    <tr>
    <td class="<?=$m['status']?>"><?=$m['message']?></td>
    </tr>
<?php
    }
?>
    </table>
<?php
}
?>
