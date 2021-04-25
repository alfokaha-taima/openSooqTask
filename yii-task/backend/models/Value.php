<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "value".
 *
 * @property int $value_id
 * @property int $field_id
 * @property int $optionValue_id
 * @property int $post_id
 * @property string $value(varchar)
 * @property int $value(int)
 * @property string $value(date)
 *
 * @property Field $field
 * @property Field $field0
 * @property Post $post
 * @property Options $optionValue
 */
class Value extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['field_id', 'optionValue_id', 'post_id', 'value(varchar)', 'value(int)', 'value(date)'], 'required'],
            [['field_id', 'optionValue_id', 'post_id', 'value(int)'], 'integer'],
            [['value(date)'], 'safe'],
            [['value(varchar)'], 'string', 'max' => 255],
            [['field_id'], 'exist', 'skipOnError' => true, 'targetClass' => Field::className(), 'targetAttribute' => ['field_id' => 'field_id']],
            [['field_id'], 'exist', 'skipOnError' => true, 'targetClass' => Field::className(), 'targetAttribute' => ['field_id' => 'field_id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'post_id']],
            [['optionValue_id'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['optionValue_id' => 'option_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'value_id' => 'Value ID',
            'field_id' => 'Field ID',
            'optionValue_id' => 'Option Value ID',
            'post_id' => 'Post ID',
            'value(varchar)' => 'Value(varchar)',
            'value(int)' => 'Value(int)',
            'value(date)' => 'Value(date)',
        ];
    }

    /**
     * Gets query for [[Field]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(Field::className(), ['field_id' => 'field_id']);
    }

    /**
     * Gets query for [[Field0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getField0()
    {
        return $this->hasOne(Field::className(), ['field_id' => 'field_id']);
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['post_id' => 'post_id']);
    }

    /**
     * Gets query for [[OptionValue]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOptionValue()
    {
        return $this->hasOne(Options::className(), ['option_id' => 'optionValue_id']);
    }
    public function saveValues($post_id,$field_id,$option_id){
    
        $values = new Value();
        // echo ($post_id."<br>");

        // $values->post_id = $post_id;
      
        // $values->field_id = $field_id;
        
        // $values->optionValue_id = $option_id;
    
        $sql = "INSERT INTO `value`(`field_id`, `optionValue_id`, `post_id`) VALUES ($field_id, $option_id, $post_id)";
        Yii::$app->db->createCommand($sql)->execute();
        // $connection->createCommand()->insert('value', [
        //     'field_id' => $field_id,
        //     'optionValue_id' => $option_id,
        //     'post_id' => $post_id
        // ])->execute();
        // echo ($values);
        // die();
        
        // $values->save();
        
}
}
