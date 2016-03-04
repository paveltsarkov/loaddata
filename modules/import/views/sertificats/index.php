<?php use yii\helpers\Html; 
use yii\widgets\ActiveForm;

$this->title = 'Загрузка сертификатов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="import-default-index">
    <h1><?= $this->title ?></h1>

    <?php 
    /*Форма загрузки файла*/
    $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-inline',], 
    ]);
    ?>

    <?= $form->field($model, 'legendFile')->fileInput()->label('Выберите csv файл') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); 
    /*Конец формы*/
    ?>
    
    <hr>
    <div class="h4">Структура файла</div>
    <table class="table table-striped table-condensed">
        <tr>
            <th>Бренд</th>
            <th>Тип</th>
            <th>Артикул</th>
            <th>Номер сертификата</th>
            <th>Дата  выдачи</th>
            <th>Дата окончания</th>
            <th>Папка/Имя файла</th>
        </tr>
        <tr>
            <td class="bg-primary">Бренд (обязательно)</td>
            <td class="bg-info">Тип (желательно)</td>
            <td class="bg-primary">Артикул (обязательно)</td>
            <td class="bg-info">Номер сертификата (желательно)</td>
            <td class="bg-info">Дата  выдачи (желательно)</td>
            <td class="bg-info">Дата окончания (желательно)</td>
            <td class="bg-primary">Папка/Имя файла (обязательно)</td>
        </tr>
    </table>
    
    <?php if ($message) { ?>
    <div class="bs-callout bs-callout-info">
        <h4><?=$message; ?></h4>
    </div>
    <?php } ?>

    <?= $errors ? $this->render('_errors', ['errors' => $errors]) : '';
    ?>
        
</div><!-- import-default-index -->
