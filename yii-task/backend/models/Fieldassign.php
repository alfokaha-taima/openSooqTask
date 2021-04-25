<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fieldassign".
 *
 * @property int $fieldassign_id
 * @property int $category_id
 * @property int $field_id
 * @property int $city_id
 * @property string $label
 *
 * @property Category $category
 * @property Field $field
 * @property Options[] $options
 */
class Fieldassign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fieldassign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'field_id', 'city_id', 'label'], 'required'],
            [['category_id', 'field_id', 'city_id'], 'integer'],
            [['label'], 'string', 'max' => 100],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['field_id'], 'exist', 'skipOnError' => true, 'targetClass' => Field::className(), 'targetAttribute' => ['field_id' => 'field_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fieldassign_id' => 'Fieldassign ID',
            'category_id' => 'Category ID',
            'field_id' => 'Field ID',
            'city_id' => 'City ID',
            'label' => 'Label',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
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
     * Gets query for [[Options]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Options::className(), ['fieldAssign_id' => 'fieldassign_id']);
    }

    public function getAtt(){
        return $this->find()->where([
            "city_id"=>1,
        ])->all();
    }
}
