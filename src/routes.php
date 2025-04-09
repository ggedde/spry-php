<?php declare(strict_types = 1);
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
use SpryPhp\Provider\Alerts;
use SpryPhp\Provider\Request;
use SpryPhp\Provider\Route;
use SpryPhp\Provider\Session;
use SpryPhp\Provider\Store;

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
        ->valid();

        // Check Admin Password, If incorrect then redirect them to Login with Error.
        if (empty($params->password) || $params->password !== constant('APP_AUTH_PASSWORD')) {
            Alerts::set('error', 'Incorrect Password');

            return Route::goTo(APP_URI_LOGIN);
        }

        // Set Session.
        Session::set('admin'.APP_AUTH_PASSWORD, (object) ['type' => 'admin', 'name' => 'Admin']);

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
        Session::clear();
        if (!empty(Request::$params->session) && Request::$params->session === 'expired') {
            Alerts::set('error', 'Your Session has Expired');
        }

        return Route::goTo(APP_URI_LOGIN);
    });
}

/**
 * Run all Queue Actions
 */
if (defined('APP_URI_QUEUE')) {
    Route::POST(APP_URI_QUEUE, function () {

        // Do All Queue Actions Here:
        Alerts::clear();
        Store::clear();

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
