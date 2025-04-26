<?php declare(strict_types=1);
/**
 * Routes file
 */

use App\View\Dashboard\Admin;
use App\View\Layout\Dashboard;
use App\View\Layout\Page;
use App\View\Page\Home;
use App\View\Page\Login;
use App\View\Page\View404;
use SpryPhp\Model\Validator;
use SpryPhp\Provider\Request;
use SpryPhp\Provider\Route;
use SpryPhp\Provider\Session;

/**
 * GET Home Page
 */
if (defined('APP_URI')) {
    Route::GET(APP_URI, function () {
        return new Page(new Home(), 'Form');
    });
}

/**
 * GET Login Page
 *
 * If user is logged in the Redirect them to the Admin
 */
if (defined('APP_URI_LOGIN')) {
    Route::GET(APP_URI_LOGIN, function () {
        if (Session::getUser() && defined('APP_URI_ADMIN')) {
            Route::goTo(APP_URI_ADMIN);
        }

        return new Page(new Login(), 'Login');
    });
}

/**
 * GET Admin Page
 */
if (defined('APP_URI_ADMIN')) {
    Route::GET(APP_URI_ADMIN, function () {
        if (Session::getUser()) {
            return new Dashboard(new Admin(), 'Admin');
        }
    });
}

/**
 * POST Login Form
 */
if (defined('APP_URI_LOGIN') && defined('APP_URI_ADMIN')) {
    Route::POST(APP_URI_LOGIN, function () {

        $params = (new Validator(Request::$params))
            ->param('password', 'Password')->required()->minLength(8)
        ->getValidParams();

        // Check Admin Password, If incorrect then redirect them to Login with Error.
        if (empty($params->password) || $params->password !== constant('APP_AUTH_PASSWORD')) {
            Session::addAlert('error', 'Incorrect Password');

            return Route::goTo(APP_URI_LOGIN);
        }

        // Login User
        Session::loginUser((object) ['type' => 'admin', 'name' => 'Admin']);

        // If Session is set correctly, then redirect to Admin Page.
        if (Session::getUser()) {
            return Route::goTo(APP_URI_ADMIN);
        }

        return Route::goTo(APP_URI_LOGIN);
    });
}

/**
 * Logout
 *
 * Will Logout User and redirect to Login page
 */
if (defined('APP_URI_LOGOUT')) {
    Route::POST(APP_URI_LOGOUT, function () {
        Session::logoutUser();

        return Route::goTo(APP_URI_LOGIN);
    });
}

/**
 * Run all Queue Actions
 */
if (defined('APP_URI_QUEUE')) {
    Route::POST(APP_URI_QUEUE, function () {

        // Do All Queue Actions Here:
        Session::clearAlerts();

        // Check and Update DB Schema.
        // Db::updateSchema(APP_PATH_DB_SCHEMA_FILE);

        return 'Success';
    });
}

/**
 * 404
 *
 * If Nothing else found then show 404
 */
http_response_code(404);
new Page(new View404(), '404 Not Found');
exit;
