<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Subcategory */

$this->title = 'Update Subcategory: ' . $model->subcategories_id;
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subcategories_id, 'url' => ['view', 'id' => $model->subcategories_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subcategory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
