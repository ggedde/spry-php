<?php declare(strict_types=1);
/**
 * App Config Definitions
 */

define('APP_START', microtime(true));
define('APP_AUTH_KEY', '__AUTH_KEY__'); // A unique key for authentication and salts.  ### WARNING - Changing this could Invalidate all Sessions and break all Encrypted values if using this as the Key.
define('APP_AUTH_PASSWORD', '__AUTH_PASSWORD__');
define('APP_ADMIN_EMAIL', '');
define('APP_ADMIN_PASSWORD', '');
define('APP_DEBUG', getenv('APP_ENVIRONMENT') !== 'production');
define('APP_HOST', getenv('APP_HOST'));
define('APP_HTTPS', true);
define('APP_PATH', rtrim(dirname(__DIR__), '/'));
define('APP_PATH_APP', APP_PATH.'/App');
define('APP_PATH_SRC', APP_PATH.'/src');
define('APP_PATH_DB_SCHEMA_FILE', APP_PATH_SRC.'/schema.php');
define('APP_PATH_ROUTES', APP_PATH_SRC.'/routes.php');
define('APP_PATH_PUBLIC', APP_PATH.'/public');
define('APP_PATH_PUBLIC_ASSETS', APP_PATH_PUBLIC.'/assets');
define('APP_REQUEST_VERIFY_CSRF', true);
define('APP_SESSION_COOKIE_NAME', 'app-session');
define('APP_SESSION_COOKIE_SAMESITE', 'Strict');
define('APP_SESSION_LOGGED_IN_COOKIE_NAME', 'app-logged-in');
define('APP_SESSION_LOGGED_IN_COOKIE_HTTP_ONLY', true);
define('APP_SESSION_TTL', 3600);
define('APP_TIME_OFFSET', -(3600*7));
define('APP_TIME', strtotime(strval(APP_TIME_OFFSET).' seconds'));
define('APP_TITLE', 'SpryPHP');
define('APP_URI', '/');
define('APP_URI_ADMIN', rtrim(APP_URI, '/').'/admin');
define('APP_URI_ASSETS', rtrim(APP_URI, '/').'/assets');
define('APP_URI_LOGIN', rtrim(APP_URI, '/').'/login');
define('APP_URI_LOGOUT', rtrim(APP_URI, '/').'/logout');
define('APP_URI_PORTAL', rtrim(APP_URI, '/').'/portal');
define('APP_URI_QUEUE', rtrim(APP_URI, '/').'/queue');
define('APP_URI_SIGNUP', rtrim(APP_URI, '/').'/signup');
