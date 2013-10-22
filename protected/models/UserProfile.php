<?php

/**
 * This is the model class for table "{{user_profile}}".
 *
 * The followings are the available columns in table '{{user_profile}}':
 * @property string $user_id
 * @property string $display_name
 * @property string $real_name
 * @property string $email
 * @property string $birthday
 * @property string $website
 * @property string $location
 * @property integer $gender
 * @property string $avatar_url
 * @property string $desc
 */
class UserProfile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_profile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gender', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>19),
			array('display_name, real_name', 'length', 'max'=>30),
			array('email, website, location', 'length', 'max'=>100),
			array('birthday', 'length', 'max'=>10),
			array('avatar_url', 'length', 'max'=>250),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, display_name, real_name, email, birthday, website, location, gender, avatar_url, desc', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'display_name' => 'Display Name',
			'real_name' => 'Real Name',
			'email' => 'Email',
			'birthday' => 'Birthday',
			'website' => 'Website',
			'location' => 'Location',
			'gender' => 'Gender',
			'avatar_url' => 'Avatar Url',
			'desc' => 'Desc',
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

		$criteria->compare('user_id',$this->user_id,true);

		$criteria->compare('display_name',$this->display_name,true);

		$criteria->compare('real_name',$this->real_name,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('birthday',$this->birthday,true);

		$criteria->compare('website',$this->website,true);

		$criteria->compare('location',$this->location,true);

		$criteria->compare('gender',$this->gender);

		$criteria->compare('avatar_url',$this->avatar_url,true);

		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider('UserProfile', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return UserProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}