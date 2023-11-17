<?php
// Database credentials
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', "");
//define('DB_NAME', 'bibliotheek');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'biblwnot_roman4');
define('DB_PASSWORD', "es,RV.J3&7Bg'U=");
define('DB_NAME', 'biblwnot_database');

// Import aliases
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/alperenGit');
define('ROUTES', ROOT . '/routes.php');
define('PUBLIC_R', ROOT . '/public');
define('SRC', ROOT . '/src');
define('COMPONENTS', SRC . '/components');
define('DATABASE', SRC . '/database');
define('LIB', SRC . '/lib');
define('PUBLIC_S', SRC . '/public');

// User structure
define('USER_STRUCTURE', [
  'id' => null,
  'username' => null,
  'email' => null,
  'theme' => null,
  'language' => null,
]);

// Error mapping
define('ERROR_MAPPING', [
  'server' => 'Something went wrong on our end, please try again later',
  'missing' => 'Missing email or password',
  'empty' => 'Empty email or password',
  'invalid' => 'Invalid email or password',
  'password' => 'Passwords do not match',
  'email' => 'Email is already in use',
  'noChanges' => 'No changes were made',
  'accountUpdate' => 'Something went wrong while updating your account',
  'usernameTaken' => 'Username is already taken',
  'deleteProduct' => 'Failed to delete product',
  'leaveReview' => 'Failed to leave review',
]);

// Success mapping
define('SUCCES_MAPPING', [
  'register' => 'You have been succesfully registered',
  'accountUpdate' => 'Your account has been updated',
  'deleteProduct' => 'Product has been deleted',
  'leaveReview' => 'Review has been left',
]);

// Theme mapping
define('THEME_MAPPING', [
  'default' => 'customLight',
  'dark' => 'customDark',
  'light' => 'customLight',
]);

?>
