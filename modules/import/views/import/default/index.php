<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\import\models\UploadForm */
/* @var $form ActiveForm */
?>
<div class="import-default-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'file') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- import-default-index -->
