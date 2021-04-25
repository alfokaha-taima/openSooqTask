<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ValueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="value-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'value_id') ?>

    <?= $form->field($model, 'field_id') ?>

    <?= $form->field($model, 'optionValue_id') ?>

    <?= $form->field($model, 'post_id') ?>

    <?= $form->field($model, 'value(varchar)') ?>

    <?php // echo $form->field($model, 'value(int)') ?>

    <?php // echo $form->field($model, 'value(date)') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
