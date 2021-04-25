<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "field".
 *
 * @property int $field_id
 * @property string $field_name
 *
 * @property Fieldassign[] $fieldassigns
 * @property Options[] $options
 * @property Value[] $values
 * @property Value[] $values0
 */
class Field extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'field';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['field_name'], 'required'],
            [['field_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'field_id' => 'Field ID',
            'field_name' => 'Field Name',
        ];
    }

    /**
     * Gets query for [[Fieldassigns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFieldassigns()
    {
        return $this->hasMany(Fieldassign::className(), ['field_id' => 'field_id']);
    }

    /**
     * Gets query for [[Options]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Options::className(), ['field_id' => 'field_id']);
    }

    /**
     * Gets query for [[Values]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Value::className(), ['field_id' => 'field_id']);
    }

    /**
     * Gets query for [[Values0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValues0()
    {
        return $this->hasMany(Value::className(), ['field_id' => 'field_id']);
    }
    public function getAtt(){
        return $this->find()->all();
    }
}
