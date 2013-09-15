<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $create_time
 * @property string $create_ip
 * @property integer $update_time
 * @property string $update_ip
 * @property integer $state
 *
 * @property string $homeUrl
 * @property UserProfile $profile
 * @property array $posts
 * @property array $favorites
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return TABLE_USER;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('username', 'required', 'message'=>'用户名 必须要填写'),
		    array('password', 'required', 'message'=>'密码 必须要填写'),
		    array('username', 'length', 'min'=>3, 'max'=>50),
			array('password', 'length', 'min'=>3, 'max'=>32),
			array('username', 'unique'),
			array('create_time, update_time, state', 'numerical', 'integerOnly'=>true),
			array('create_ip, update_time', 'length', 'max'=>15),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		    'profile' => array(self::HAS_ONE, 'UserProfile', 'user_id'),
	        'favorites' => array(self::MANY_MANY, 'Post', TABLE_QUESTION_FAVORITE . '(user_id, question_id)', 'order'=>'favorites.create_time desc'),
	        'posts' => array(self::HAS_MANY, 'Post', 'user_id', 'order'=>'posts.create_time desc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '账号',
			'password' => '密码',
			'create_time' => '注册时间',
			'create_ip' => '注册IP',
			'update_time' => '更新时间',
			'update_ip' => '更新IP',
			'state' => '状态',
		);
	}

	public function getNameLink($htmlOptions = array('target'=>'_blank'))
	{
	    return l($this->getDisplayName(), $this->getHomeUrl(), $htmlOptions);
	}
	
	public function getCreateTime($format = null)
	{
	    if (empty($this->create_time))
	        return '';
	
	    $format = $format ? $format : param('formatDateTime');
	    return date($format, $this->create_time);
	}

	public function getVerified()
	{
	    return $this->state == USER_STATE_ENABLED;
	}
	
	public function getUnVerified()
	{
	    return $this->state == USER_STATE_UNVERIFY;
	}
	
	public function getForbidden()
	{
	    return $this->state == USER_STATE_FORBIDDEN;
	}
	
	public function encryptPassword()
	{
	    $this->password = CDBase::encryptPassword($this->password);
	}

	public function getUserNameIsEmail()
	{
	    return CDBase::checkEmail($this->username);
	}
	
	public function getUserNameIsMobile()
	{
	    return CDBase::checkMobilePhone($this->username);
	}
	
	public function sendVerifyEmail()
	{
	    $emailVerify = (bool)param('user_required_email_verfiy');
	    $adminVerify = (bool)param('user_required_admin_verfiy');
	    if (!$adminVerify && $emailVerify && $this->getUserNameIsEmail() && $this->state == USER_STATE_UNVERIFY) {
	        $this->generateToken();
	        if ($this->save(true, array('token', 'token_time'))) {
	            $code = md5($this->id) . $this->token;
    	        $search = array(
	                '{sitename}' => app()->name,
	                '{siteurl}' => CDBaseUrl::siteHomeUrl(),
                    '{useremail}' => $this->username,
                    '{userid}' => $this->id,
                    '{username}' => $this->screen_name ? $this->screen_name : $this->username,
	                '{verify_url}' => CDBaseUrl::activateUrl($code),
                );
                $keys = array_keys($search);
                $values = array_values($search);
                
                $subjectTpl = param('email_user_verify_subject_tpl');
                $bodyTpl = param('email_user_verify_content_tpl');
                
                $subject = str_replace($keys, $values, $subjectTpl);
                $body = str_replace($keys, $values, $bodyTpl);
                
                $mailer = app()->getComponent('mailer');
                return $mailer->sendSimple($this->username, $subject, $body);
	        }
	        else
	            throw new Exception('generate or save token error.');
	    }
	    return null;
	}
	
	public static function emailActivate($code)
	{
	    if (strlen($code) !== 64) return false;
	    
	    $id = substr($code, 0, 32);
	    $token = substr($code, 32);
	    $user = self::model()->findByAttributes(array('token'=>$token));
	    if ($user->getUnVerified() && $id == md5($user->id) && ($user->token_time + 72*3600) > $_SERVER['REQUEST_TIME']) {
	        $user->state = USER_STATE_ENABLED;
	        if ($user->save(true, array('state')))
	            return $user;
	    }
        return false;
	}
	
	public function generateToken()
	{
	    $token = self::generateUserToken($this->id, $this->username);
	    $this->token = $token;
	    $this->token_time = time();
	    return $token;
	}
	
	public static function generateUserToken($userid, $username)
	{
	    return md5($username . $userid . time() . uniqid());
	}
	
	protected function beforeSave()
	{
	    if ($this->getIsNewRecord()) {
	        $this->create_time = time();
	        $this->create_ip = CDBase::getClientIPAddress();
	    }
	    else {
	        $this->update_time = time();
	        $this->update_ip = CDBase::getClientIPAddress();
	    }
	    
	    return true;
	}
	
	protected function afterSave()
	{
	    if ($this->getIsNewRecord()) {
	        $profile = new UserProfile();
	        $profile->user_id = $this->id;
	        $profile->save();
	    }
	}
	
	protected function beforeDelete()
	{
	    throw new CException('用户不允许删除');
	}
}


