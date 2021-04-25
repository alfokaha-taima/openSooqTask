<?php


namespace console\controllers;

use yii\console\Controller;
use backend\models\Post;

class TestController extends Controller {

public function actionCheck() {
    // echo "cron service runnning";
    $posts = new Post();
    $allPosts = $posts->find()->all();
    foreach ($allPosts as $key) {
        $title = $key->title;
        $descreption = $key->descreption;
        $word1='wrong';
        $word2='bad';
        if(strpos($title,$word1) || strpos($descreption,$word2)){
            $key->status='delete';
            $key->save();
        }
    }
    // $title = $allPosts->title;
    // $descreption = $allPosts->descreption;
    // $word1='wrong';
    // $word2='bad';
    // if(strpos($title,$word1) || strpos($descreption,$word2)){
    //     $allPosts->status='delete';
    //     $allPosts-save();
    // }


}}