<?php

/**
 * This is the model class for table "{{user_profile}}".
 *
 * The followings are the available columns in table '{{user_profile}}':
 * @property integer $user_id
 * @property string $display_name
 * @property string $real_name
 * @property string $email
 * @property string $birthday
 * @property string $website
 * @property string $location
 * @property integer $gender
 * @property string $desc
 * @property string $avatar_url
 *
 * @property string $homeUrl
 * @property string $largeAvatarUrl
 * @property string $smallAvatarUrl
 * @property string $miniAvatarUrl
 * @property string $largeAvatar
 * @property string $smallAvatar
 * @property string $miniAvatar
 * @property string $genderLabel
 */
class UserProfile extends CActiveRecord
{
    public static function genders()
    {
        return array(GENDER_UNKOWN, GENDER_FEMALE, GENDER_MALE);
    }

    public static function genderLabel($gender = null)
    {
        $labels = array(
                GENDER_UNKOWN => '保密',
                GENDER_FEMALE => '妹纸',
                GENDER_MALE => '帅锅',
        );
    
        return ($gender === null) ? $labels : $labels[$gender];
    }

	/**
	 * Returns the static model of the specified AR class.
	 * @return UserProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return TABLE_USER_PROFILE;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
    		array('user_id', 'required'),
			array('user_id', 'unique'),
			array('user_id', 'exist', 'caseSensitive'=>false, 'className' => 'User', 'attributeName' => 'id'),
			array('user_id, gender', 'numerical', 'integerOnly'=>true),
			array('display_name, real_name', 'length', 'max'=>30),
			array('website, email, location', 'length', 'max'=>100),
			array('birthday', 'length', 'max'=>10),
			array('avatar_url', 'length', 'max'=>250),
	        array('gender', 'in', 'range'=>self::genders()),
			array('website', 'url'),
			array('email', 'email'),
			array('desc', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		    'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => '用户ID',
	        'display_name' => '显示名字',
	        'real_name' => '真实姓名',
			'gender' => '性别',
	        'email' => '电子邮箱',
	        'birthday' => '生日',
			'location' => '位置',
			'website' => '网址',
	        'avatar_url' => '头像',
			'desc' => '简介',
		);
	}

	public function getGenderLabel()
	{
	    return self::genderLabel($this->gender);
	}

	public function getHomeUrl()
	{
	    return CDBaseUrl::userHomeUrl($this->user_id);
	}

	/**
	 * 获取自定义缩略图对象
	 * @return Ambigous <NULL, string, CDImageThumb>
	 */
	public function getAvatarThumb()
	{
	    static $thumbs = array();
	    if (!array_key_exists($this->user_id, $thumbs)){
	        if ($this->avatar_url)
	            $thumbs[$this->user_id] = new CDImageThumb($this->avatar_url);
	        else
	            $thumbs[$this->user_id] = '';
	    }
	    
	    return $thumbs[$this->user_id];
	}

	public function getMiniAvatarUrl()
	{
	    $thumb = $this->getAvatarThumb();
	    return $thumb ? $thumb->miniAvatarUrl() : USER_DEFAULT_MINI_AVATAR_URL;
	}

	public function getSmallAvatarUrl()
	{
	    $thumb = $this->getAvatarThumb();
	    return $thumb ? $thumb->smallAvatarUrl() : USER_DEFAULT_SMALL_AVATAR_URL;
	}

	public function getLargeAvatarUrl()
	{
	    $thumb = $this->getAvatarThumb();
	    return $thumb ? $thumb->largeAvatarUrl() : USER_DEFAULT_LARGE_AVATAR_URL;
	}

	public function getLargeAvatar($alt = '', $htmlOptions = array())
	{
	    $html = '';
	    $url = $this->getLargeAvatarUrl();
	    if ($url) {
	        $htmlOptions += array('class'=>'large-avatar');
	        $html = image($url, $alt, $htmlOptions);
	    }
	
	    return $html;
	}

	public function getSmallAvatar($alt = '', $htmlOptions = array())
	{
	    $html = '';
	    $url = $this->getSmallAvatarUrl();
	    if ($url) {
	        $htmlOptions += array('class'=>'small-avatar');
	        $html = image($url, $alt, $htmlOptions);
	    }
	
	    return $html;
	}

	public function getMiniAvatar($alt = '', $htmlOptions = array())
	{
	    $html = '';
	    $url = $this->getMiniAvatarUrl();
	    if ($url) {
	        $htmlOptions += array('class'=>'mini-avatar');
	        $html = image($url, $alt, $htmlOptions);
	    }
	
	    return $html;
	}
}


