<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Subcategory */

$this->title = 'Create Subcategory';
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
