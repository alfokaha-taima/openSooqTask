<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>

  
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Descreption</th>
      <th scope="col">price</th>
      <th scope="col">delete</th>
      <th scope="col">Live</th>
    
    </tr>
  </thead>
  
<?php

foreach($posts as $value)
{?>
  <tbody>
    <tr>
      <th scope="row"><?= $value->post_id ?></th>
      <td><?= $value->title ?></td>
      <td><?= $value->descreption ?></td>
      <td><?= $value->price ?></td>
      <td>  <?= Html::a('Block', ['blockall', 'post_id' => $value->post_id], ['class' => 'btn btn-primary']) ?></td>
      <td>  <?= Html::a('Live', ['accept', 'post_id' => $value->post_id], ['class' => 'btn btn-success']) ?></td>
    </tr>
   
  </tbody>
 <?php }

?>
</table>

