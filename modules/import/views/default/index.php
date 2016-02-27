<?php use yii\helpers\Html; ?>
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
    <?= Html::beginForm([''], 'post', ['class' => 'form-inline'])?>
    <?= Html::hiddenInput('type', $name)?>
    <div class="form-group">
        <?= Html::fileInput('legend')?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Отправить',['class' => 'btn btn-primary'])?>
    </div>
    <?= Html::endForm()?>
</div>
