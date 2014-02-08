<?php
define('CD_CONFIG_ROOT', dirname(__FILE__));
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

try {
    $params = require(CD_CONFIG_ROOT . DS . 'params_product.php');
    $cachefile = $params['dataPath'] . DS . 'setting.config.php';
    if (file_exists($cachefile)) {
        $customSetting = require($cachefile);
        $params = array_merge($params, $customSetting);
    }
}
catch (Exception $e) {
    echo $e->getMessage();
    exit(0);
}

return array(
    'basePath' => dirname(__FILE__) . DS . '..',
    'id' => '24beta.cn',
    'name' => '24beta',
    'language' => 'zh_cn',
    'charset' => 'utf-8',
    'timezone' => 'Asia/Shanghai',

    'import' => array(
        'application.models.*',
        'application.extensions.*',
        'application.components.*',
        'application.libs.*',
        'application.widgets.*',
    ),
    'modules' => array(
        'admin' => array(
            'layout' => 'main',
        ),
        'member' => array(
            'layout' => 'main',
        ),
        'mobile' => array(
            'layout' => 'main',
        ),
    ),
    'components' => array(
        'errorHandler' => array(
            'errorAction' => 'system/error',
        ),
        'db' => array(
            'class' => 'CDbConnection',
			'connectionString' => sprintf('mysql:host=%s; port=%s; dbname=%s', DB_MYSQL_HOST, DB_MYSQL_PORT, DB_MYSQL_DBNAME),
			'username' => DB_MYSQL_USER,
		    'password' => DB_MYSQL_PASSWORD,
		    'charset' => 'utf8',
		    'persistent' => false,
		    'tablePrefix' => 'cd_',
            'attributes' => array(
                PDO::ATTR_ORACLE_NULLS => PDO::NULL_TO_STRING,
                PDO::ATTR_EMULATE_PREPARES => true,
            ),
		    'schemaCacheID' => 'cache',
		    'schemaCachingDuration' => 3600 * 24,    // metadata 缓存超时时间(s)
		    'queryCacheID' => 'redis',
		    'queryCachingDuration' => 60,
        ),
        'cache' => array(
            'class'=>'CMemCache',
            'serializer' => array('igbinary_serialize', 'igbinary_unserialize'),
            'useMemcached' => extension_loaded('memcached'),
            'servers'=>array(
                array('host'=>'localhost', 'port'=>22122, 'weight'=>100),
            ),
        ),
        'redis' => array(
            'class' => 'application.extensions.CDRedisCache',
            'host' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 3,
            'options' => array(
                Redis::OPT_PREFIX => 'wdz_',
                Redis::OPT_SERIALIZER => extension_loaded('igbinary') ? Redis::SERIALIZER_IGBINARY : Redis::SERIALIZER_PHP,
            ),
        ),
        'assetManager' => array(
            'basePath' => $params['resourceBasePath'] . 'assets',
            'baseUrl' => $params['resourceBaseUrl'] . 'assets',
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'assignmentTable' => TABLE_AUTH_ASSIGNMENT,
            'itemChildTable' => TABLE_AUTH_ITEMCHILD,
            'itemTable' => TABLE_AUTH_ITEM,
        ),
        'widgetFactory'=>array(
            'enableSkin' => true,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
		    'showScriptName' => false,
            'caseSensitive' => false,
            'cacheID' => 'cache',
            'rules' => array(
            ),
        ),
        'session' => array(
            'autoStart' => true,
            'sessionName' => 'betassid',
            'cookieParams' => array(
                'lifetime' => $params['autoLoginDuration'],
                'domain' => GLOBAL_COOKIE_DOMAIN,
                'path' => GLOBAL_COOKIE_PATH,
            ),
        ),
        'user' => array(
            'class' => 'CDWebUser',
            'allowAutoLogin' => true,
            'autoLoginDuration' => $params['autoLoginDuration'],
            'loginUrl' => array('/account/login'),
            'guestName' => 'Guest',
        ),
        'mailer' => array(
            'class' => 'application.extensions.CDSendCloudMailer',
            'username' => 'postmaster@wdztrigger.sendcloud.org',
            'password' => 'voQh3RP5',
            'fromName' => '24beta.com',
            'fromAddress' => 'noreply@24beta.com',
            'replyTo' => 'service@24beta.com',
        ),
        'localUploader' => array(
            'class' => 'application.extensions.CDLocalUploader',
            'basePath' => $params['localUploadBasePath'],
            'baseUrl' => $params['localUploadBaseUrl'],
        ),
        'upyunImageUploader' => array(
            'class' => 'application.extensions.CDUpyunUploader',
            'isImageBucket' => true,
            'endpoint' => 'v1.api.upyun.com',
            'bucket' => 'betaimage',
            'username' => 'cdcchen',
            'password' => 'cdc790406',
            'basePath' => '/',
            'baseUrl' => $params['upyunImageBaseUrl'],
        ),
        'upyunFileUploader' => array(
            'class' => 'application.extensions.CDUpyunUploader',
            'isImageBucket' => false,
            'endpoint' => 'v1.api.upyun.com',
            'bucket' => 'wdzfile',
            'username' => 'cdcchen',
            'password' => 'cdc790406',
            'basePath' => '/',
            'baseUrl' => $params['upyunFileBaseUrl'],
        ),
    ),
    
    'params' => $params,
);



    
