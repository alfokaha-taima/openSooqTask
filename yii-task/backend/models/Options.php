<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $option_id
 * @property int $field_id
 * @property int $fieldAssign_id
 * @property string $option_name
 *
 * @property Field $field
 * @property Fieldassign $fieldAssign
 * @property Value[] $values
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['field_id', 'fieldAssign_id', 'option_name'], 'required'],
            [['field_id', 'fieldAssign_id'], 'integer'],
            [['option_name'], 'string', 'max' => 100],
            [['field_id'], 'exist', 'skipOnError' => true, 'targetClass' => Field::className(), 'targetAttribute' => ['field_id' => 'field_id']],
            [['fieldAssign_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fieldassign::className(), 'targetAttribute' => ['fieldAssign_id' => 'fieldassign_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'option_id' => 'Option ID',
            'field_id' => 'Field ID',
            'fieldAssign_id' => 'Field Assign ID',
            'option_name' => 'Option Name',
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
     * Gets query for [[FieldAssign]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFieldAssign()
    {
        return $this->hasOne(Fieldassign::className(), ['fieldassign_id' => 'fieldAssign_id']);
    }

    /**
     * Gets query for [[Values]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValue()
    {
        return $this->hasMany(Value::className(), ['optionValue_id' => 'option_id']);
    }
    public function getOptions(){
        return $this->find()->all();
    }
}
