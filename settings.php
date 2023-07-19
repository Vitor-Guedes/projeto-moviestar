<?php

define('BASE_DIR', dirname(__FILE__));

define('SETTINGS_DIR', BASE_DIR . '/settings');

define('MODELS_DIR', BASE_DIR . '/models');

define('DAO_DIR', BASE_DIR . '/dao');

define('PAGES_DIR', BASE_DIR . '/pages');

define('TEMPLATES_DIR', BASE_DIR . '/templates');

define('IMAGES_DIR', BASE_DIR . '/public/images');

require_once(SETTINGS_DIR . '/db.php');

require_once(SETTINGS_DIR . '/url.php');

require_once(MODELS_DIR . '/Message.php');

require_once(DAO_DIR . '/UserDAO.php');

require_once(SETTINGS_DIR . '/session.php');