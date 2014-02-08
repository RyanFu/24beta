<?php
define('CD_YES', 1);
define('CD_NO', 0);

define('SITE_DOMAIN', '24beta.com');
define('CD_LAST_VISIT', 'beta_lastvisit');
define('CD_CLIENT_ID', 'beta_clientid');
define('GLOBAL_COOKIE_DOMAIN', '.' . SITE_DOMAIN);
define('GLOBAL_COOKIE_PATH', '/');

// 以下是表名
define('TABLE_AUTH_ASSIGNMENT', '{{auth_assignment}}');
define('TABLE_AUTH_ITEMCHILD', '{{auth_itemchild}}');
define('TABLE_AUTH_ITEM', '{{auth_item}}');
define('TABLE_CONFIG', '{{config}}');
define('TABLE_COMMENT', '{{comment}}');
define('TABLE_TAG', '{{tag}}');
define('TABLE_QUESTION_TAG', '{{question_tag}}');
define('TABLE_QUESTION_FAVORITE', '{{questiont_favorite}}');
define('TABLE_USER', '{{user}}');
define('TABLE_USER_PROFILE', '{{user_profile}}');
define('TABLE_FILTER_KEYWORD', '{{filter_keyword}}');
define('TABLE_LINK', '{{link}}');
define('TABLE_ADVERT', '{{advert}}');
define('TABLE_ADCODE', '{{adcode}}');
define('TABLE_FEEDBACK', '{{feedback}}');

/* user state */
define('USER_STATE_UNVERIFY', 0);
define('USER_STATE_ENABLED', 1);
define('USER_STATE_FORBIDDEN', -1);

/* advert state */
define('ADVERT_STATE_DISABLED', 0);
define('ADVERT_STATE_ENABLED', 1);
/* advert state */
define('ADCODE_STATE_DISABLED', 0);
define('ADCODE_STATE_ENABLED', 1);

/* link ishome */
define('LINK_IN_HOME', 1);
define('LINK_NOT_IN_HOME', 0);

/*
 * 这些尺寸与又拍云里的自定义版本相对应
 */

define('AVATAR_MINI_SIZE', 24);
define('AVATAR_SMALL_SIZE', 48);
define('AVATAR_LARGE_SIZE', 144);

define('IMAGE_THUMB_WIDTH', 200);
define('IMAGE_SMALL_WIDTH', 320);
define('IMAGE_MIDDLE_WIDTH', 640);
define('IMAGE_LARGE_WIDTH', 1024);

define('UPYUN_AVATAR_MINI', 'mavatar');
define('UPYUN_AVATAR_SMALL', 'savatar');
define('UPYUN_AVATAR_LARGE', 'lavatar');

define('UPYUN_IMAGE_SEPARATOR', '!');
define('UPYUN_IMAGE_THUMB', 'thumb');
define('UPYUN_IMAGE_SMALL', 'small');
define('UPYUN_IMAGE_MIDDLE', 'middle');
define('UPYUN_IMAGE_LARGE', 'large');


/*
 * 图片尺寸添加水印阀值
 */
define('IMAGE_WATER_URL_SIZE', 200);
define('IMAGE_WATER_SITENAME_SIZE', 500);

define('GENDER_UNKOWN', 0);
define('GENDER_FEMALE', 1);
define('GENDER_MALE', 2);

define('USER_DEFAULT_MINI_AVATAR_URL', 'images/default_avatar.png');
define('USER_DEFAULT_SMALL_AVATAR_URL', 'images/default_avatar.png');
define('USER_DEFAULT_LARGE_AVATAR_URL', 'images/default_avatar.png');




