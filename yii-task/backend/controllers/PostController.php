<?php

namespace backend\controllers;

use Yii;
use backend\models\Post;
use backend\models\Options;
use backend\models\Value;;
use backend\models\Fieldassign;
use backend\models\Postlifecycle;
use backend\models\PostSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\data\Pagination;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPost()
    {
        // $query = User::find();
        $post= new Post();
        $postGet=$post->findpost(Yii::$app->user->id);
        // $model=Post::find()->where(['user_id'=>Yii::$app->user->id])->all();
        return $this->render('index2',[
            'post'=>$postGet,
        ]);
       
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $fileld= new Fieldassign();
        $filelds=$fileld->getAtt();
        $option = new Options();
        $options=$option->getOptions();
        $value_model = new Value();
        $PostLifecycle = new  Postlifecycle();
        

        if ($model->load(Yii::$app->request->post())) {

            $cat = $_POST["category_id"];
            $post_id =  $model->postadd($cat);
            $PostLifecycle->savePostLifecycle($post_id);
            // return $this->redirect(['view', 'id' => $model->post_id]);
            if((bool)$post_id){
                foreach (Yii::$app->request->post() as $key => $value) {
                    if (strpos($key, 'field') !==  false) {
                        $field_id = (int)(substr($key, 6));
                        $option_id =(int)$value;
                        $value_model->saveValues($post_id,$field_id,$option_id);
                    }     
                }  
                return $this->redirect(['post/post']);  
        }else{
            die("An error occured");
        }
    }
     
        return $this->render('create', [
            'model' => $model,
            'filelds' => $filelds,
            'options' => $options,
        ]);
    
    }
    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->post_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

    }
    public function acceptPost($post_id){
     $post= $this->findOne($post_id);
     $post->status='live';
     $post->save();
    

     $postlifecycle= new Postlifecycle();
       $postLifeCycle->LivePost($post_id,$previous_state);
       return $this->redirect(['all']);
    
    

    }

   

    public function actionAll(){
        if(Yii::$app->user->can('delete all post'))
        {
            $model = new Post();
            $allPosts=$model->getAllPosts();
            
            return $this->render('getallPosts',[
                'posts'=>$allPosts
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
       
    }

    public function actionDeletepost($post_id)
    {
        
        $this->findModel($post_id)->delete();

        return $this->redirect(['post']);}

        
    

    public function actionBlockall($post_id)

    { 
        if(Yii::$app->user->can('delete all post'))
        {
        $post=Post::findOne($post_id);
        $post->status="Blocked";
        $previous_state=$post->status;
        $postlifecycle= new Postlifecycle();
       $postlifecycle->LivePost($post_id,$previous_state);
        $post->save();
 
         return $this->redirect(['all']);
    } else{
        throw new ForbiddenHttpException;
    }}

    public function actionAccept($post_id)
    {
       $post=Post::findOne($post_id);
       $previous_state = $post->status;
       $post->status="live";

       $postlifecycle= new Postlifecycle();
       $postlifecycle->LivePost($post_id,$previous_state);
       $post->save();

        return $this->redirect(['all']);
    }
}
