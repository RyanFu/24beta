<?php

/**
 * This is the model class for table "{{question_comment}}".
 *
 * The followings are the available columns in table '{{question_comment}}':
 * @property string $id
 * @property string $question_id
 * @property string $user_id
 * @property integer $create_time
 * @property string $create_ip
 * @property string $content
 */
class QuestionComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{question_comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time', 'numerical', 'integerOnly'=>true),
			array('question_id, user_id', 'length', 'max'=>19),
			array('create_ip', 'length', 'max'=>15),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, question_id, user_id, create_time, create_ip, content', 'safe', 'on'=>'search'),
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
			'question_id' => 'Question',
			'user_id' => 'User',
			'create_time' => 'Create Time',
			'create_ip' => 'Create Ip',
			'content' => 'Content',
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

		$criteria->compare('question_id',$this->question_id,true);

		$criteria->compare('user_id',$this->user_id,true);

		$criteria->compare('create_time',$this->create_time);

		$criteria->compare('create_ip',$this->create_ip,true);

		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider('QuestionComment', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return QuestionComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}