<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "post".
 *
 * @property int $post_id
 * @property string $title
 * @property string $descreption
 * @property string $price
 * @property int $categories_id
 * @property int $cities_id
 * @property int $user_id
 * @property int $supcategories_id
 * @property int $status
 * @property string $post_created_date
 * @property string $updated_at
 *
 * @property User $user
 * @property Category $categories
 * @property Subcategory $supcategories
 * @property City $cities
 * @property Value[] $values
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'descreption', 'price', 'categories_id', 'cities_id', 'user_id', 'supcategories_id'], 'required'],
           
            [['categories_id', 'cities_id', 'user_id', 'supcategories_id'], 'integer'],
            [['post_created_date', 'updated_at'], 'safe'],
            
            [['title', 'descreption', 'price', 'status'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['categories_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categories_id' => 'category_id']],
            [['supcategories_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['supcategories_id' => 'subcategories_id']],
            [['cities_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cities_id' => 'cities_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'title' => 'Title',
            'descreption' => 'Descreption',
            'price' => 'Price',
            'categories_id' => 'Categories ID',
            'cities_id' => 'Cities ID',
            'user_id' => 'User ID',
            'supcategories_id' => 'Supcategories ID',
            'status' => 'Status',
            'post_created_date' => 'Post Created Date',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'categories_id']);
    }

    /**
     * Gets query for [[Supcategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupcategories()
    {
        return $this->hasOne(Subcategory::className(), ['subcategories_id' => 'supcategories_id']);
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasOne(City::className(), ['cities_id' => 'cities_id']);
    }

    /**
     * Gets query for [[Values]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Value::className(), ['post_id' => 'post_id']);
    }


    
  public function postadd($cat) {
    $post=new Post();
    $post->user_id=Yii::$app->user->id;
    $post->title=$this->title;
    $post->descreption=$this->descreption;
    
    $post->price=$this->price;
    $post->categories_id= $cat;
    $post->cities_id =$this->cities_id;
    $post->supcategories_id=$this->supcategories_id;

    // $post->status=$this->status;
    if($post->save()) {
        return $post->post_id;
    }
    return false;
 }

 public function findpost($user_id){
   $post=$this->find()->where(['user_id'=>$user_id])->all();
   return $post;
 }

 public function getAllPosts(){
    $posts = new Post();
    $allPosts = $this->find()->all();
    return $allPosts;
}

}
