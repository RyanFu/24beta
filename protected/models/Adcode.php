<?php

/**
 * This is the model class for table "{{adcode}}".
 *
 * The followings are the available columns in table '{{adcode}}':
 * @property string $id
 * @property string $ad_id
 * @property string $adcode
 * @property string $weight
 * @property string $intro
 * @property integer $state
 */
class Adcode extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{adcode}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('state', 'numerical', 'integerOnly'=>true),
			array('ad_id, weight', 'length', 'max'=>10),
			array('intro', 'length', 'max'=>250),
			array('adcode', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ad_id, adcode, weight, intro, state', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'ad_id' => 'Ad',
			'adcode' => 'Adcode',
			'weight' => 'Weight',
			'intro' => 'Intro',
			'state' => 'State',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);

		$criteria->compare('ad_id',$this->ad_id,true);

		$criteria->compare('adcode',$this->adcode,true);

		$criteria->compare('weight',$this->weight,true);

		$criteria->compare('intro',$this->intro,true);

		$criteria->compare('state',$this->state);

		return new CActiveDataProvider('Adcode', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Adcode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}