<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Load '.$name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Load <?=$name?> page. You may modify the following file to customize its content:
    </p>

    <?= Html::beginForm([''], 'post', ['class' => 'form-inline'])?>
    <div class="form-group">
        <?= Html::fileInput('legend')?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Отправить',['class' => 'btn btn-primary'])?>
    </div>
    <?= Html::endForm()?>
    
    <!--<code><?= __FILE__ ?></code>-->
</div>
