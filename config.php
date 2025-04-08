<?php declare(strict_types = 1);
/**
 * App Config Definitions
 */

define('APP_AUTH_KEY', '__AUTH_KEY__'); // A unique key for authentication and salts.  ### WARNING - Changing this could Invalidate all Sessions.
define('APP_AUTH_PASSWORD', '__AUTH_PASSWORD__');
define('APP_DEBUG', true);
define('APP_HOST', getenv('APP_HOST'));
define('APP_HTTPS', true);
define('APP_PATH', rtrim(__DIR__, '/'));
define('APP_PATH_ROOT', APP_PATH);
define('APP_PATH_DATA', APP_PATH_ROOT.'/data');
define('APP_PATH_DB_SCHEMA_FILE', APP_PATH.'/schema.php');
define('APP_PATH_ROUTES', APP_PATH.'/routes.php');
define('APP_PATH_PUBLIC', APP_PATH_ROOT.'/public');
define('APP_PATH_PUBLIC_ASSETS', APP_PATH_PUBLIC.'/assets');
define('APP_REQUEST_VERIFY_CSRF', true);
define('APP_SESSION_COOKIE_NAME', 'app-session');
define('APP_SESSION_COOKIE_NAME_ACTIVE', 'app-session-active');
define('APP_SESSION_COOKIE_NAME_ALERTS', 'app-alerts');
define('APP_SESSION_COOKIE_HTTP_ONLY', true);
define('APP_SESSION_TTL', 3600);
define('APP_SESSION_TTL_GUEST', 0);
define('APP_TIME_OFFSET', -(3600*7));
define('APP_TIME', strtotime(strval(APP_TIME_OFFSET).' seconds'));
define('APP_TITLE', 'Maryland Form');
define('APP_URI', '/');
define('APP_URI_ADMIN', rtrim(APP_URI, '/').'/admin');
define('APP_URI_ASSETS', rtrim(APP_URI, '/').'/assets');
define('APP_URI_LOGIN', rtrim(APP_URI, '/').'/login');
define('APP_URI_LOGOUT', rtrim(APP_URI, '/').'/logout');
define('APP_URI_QUEUE', rtrim(APP_URI, '/').'/queue');
