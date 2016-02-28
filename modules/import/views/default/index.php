<?php use yii\helpers\Html; 
use yii\widgets\ActiveForm;

$this->title = 'Загрузка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="import-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
    
    <div class="import-default-index">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-inline',], 
            'action' => ['more'], 
            ]); ?>

        <?= $form->field($model, 'legendFile')->fileInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div><!-- import-default-index -->
</div>
