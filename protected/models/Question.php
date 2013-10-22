<?php

/**
 * This is the model class for table "{{question}}".
 *
 * The followings are the available columns in table '{{question}}':
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property string $view_count
 * @property string $favorite_count
 * @property string $answer_count
 * @property string $vote_count
 * @property string $bounty
 * @property integer $create_time
 * @property string $create_ip
 * @property integer $locked
 * @property string $tags
 * @property string $content
 */
class Question extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{question}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time, locked', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>19),
			array('title, tags', 'length', 'max'=>250),
			array('view_count, favorite_count, answer_count, vote_count, bounty', 'length', 'max'=>10),
			array('create_ip', 'length', 'max'=>15),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, title, view_count, favorite_count, answer_count, vote_count, bounty, create_time, create_ip, locked, tags, content', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'title' => 'Title',
			'view_count' => 'View Count',
			'favorite_count' => 'Favorite Count',
			'answer_count' => 'Answer Count',
			'vote_count' => 'Vote Count',
			'bounty' => 'Bounty',
			'create_time' => 'Create Time',
			'create_ip' => 'Create Ip',
			'locked' => 'Locked',
			'tags' => 'Tags',
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

		$criteria->compare('user_id',$this->user_id,true);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('view_count',$this->view_count,true);

		$criteria->compare('favorite_count',$this->favorite_count,true);

		$criteria->compare('answer_count',$this->answer_count,true);

		$criteria->compare('vote_count',$this->vote_count,true);

		$criteria->compare('bounty',$this->bounty,true);

		$criteria->compare('create_time',$this->create_time);

		$criteria->compare('create_ip',$this->create_ip,true);

		$criteria->compare('locked',$this->locked);

		$criteria->compare('tags',$this->tags,true);

		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider('Question', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Question the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}