<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for collection "postlifecycle".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $post_id
 * @property mixed $previous_state
 * @property mixed $current_state
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $role
 */
class Postlifecycle extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['openSooqTask', 'postLifeCycle'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'post_id',
            'previous_state',
            'current_state',
            'created_at',
            'updated_at',
            'role',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'previous_state', 'current_state', 'created_at', 'updated_at', 'role'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'post_id' => 'Post ID',
            'previous_state' => 'Previous State',
            'current_state' => 'Current State',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'role' => 'Role',
        ];
    }

    public function savePostLifecycle($post_id){
        $Post = new Postlifecycle();
        $Post->post_id = $post_id;
        $Post->current_state = 'pending';
        $Post->previous_state = null;
        $Post->role = 'user';
        $Post->save();
    } 
    
    public function LivePost($post_id,$previous_state){
        $Post = new Postlifecycle();
        $Post->post_id = $post_id;
        $Post->current_state = 'Live';
        $Post->previous_state = $previous_state;
        $Post->role ='admin';
        $Post->created_at = date('Y/m/d');
        $Post->save();
    } 
    
    
    public function blockPost($post_id,$previous_state,$role){
        $Post = new Postlifecycle();
        $Post->post_id = $post_id;
        $Post->current_state = 'Block';
        $Post->previous_state= $previous_state;
        $Post->role = $role;
        $Post->created_at= date('Y/m/d');
        $Post->save();
    }
    
}
