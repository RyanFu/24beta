<?php
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
$params = require(dirname(__FILE__) . DS . 'params_product.php');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'id' => '24beta.com',
	'name'=>'24beta.com',
    'language' => 'zh_cn',
    'charset' => 'utf-8',
    'timezone' => 'Asia/Shanghai',

    'import' => array(
        'application.models.*',
        'application.extensions.*',
        'application.libs.*',
    ),
	'components'=>array(
		'db' => array(
            'class' => 'CDbConnection',
			'connectionString' => 'mysql:host=localhost; port=3306; dbname=cd_beta24',
			'username' => 'root',
		    'password' => 'cdc_790406',
		    'charset' => 'utf8',
		    'persistent' => true,
		    'tablePrefix' => 'cd_',
//             'enableParamLogging' => true,
//             'enableProfiling' => true,
	        'schemaCacheID' => 'cache',
	        'schemaCachingDuration' => 3600 * 24,    // metadata 缓存超时时间(s)
	        'queryCacheID' => 'cache',
	        'queryCachingDuration' => 60,
        ),
        'cache' => array(
            'serializer' => array('igbinary_serialize', 'igbinary_unserialize'),
            'class'=>'CMemCache',
            'useMemcached' => extension_loaded('memcached'),
            'servers'=>array(
                array('host'=>'localhost', 'port'=>22122, 'weight'=>100),
            ),
        ),
	),
    'params' => $params,
);
