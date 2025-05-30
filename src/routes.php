<?php declare(strict_types=1);
/**
 * Routes file
 */

use App\View\Admin\Users;
use App\View\Dashboard\Admin;
use App\View\Layout\Dashboard;
use App\View\Layout\Page;
use App\View\Page\Home;
use App\View\Page\Login;
use App\View\Page\Signup;
use App\View\Page\View404;
use SpryPhp\Model\Validator;
use SpryPhp\Provider\Functions;
use SpryPhp\Provider\Request;
use SpryPhp\Provider\Route;
use SpryPhp\Provider\Session;

/**
 * Home Page
 */
if (defined('APP_URI')) {

    Route::GET(APP_URI, function () {
        return new Page(new Home());
    });

}

/**
 * Login Page
 */
if (defined('APP_URI_LOGIN')) {

    Route::GET(APP_URI_LOGIN, function () {
        if (Session::getUser() && defined('APP_URI_ADMIN')) {
            Route::goTo(APP_URI_ADMIN);
        }

        return new Page(new Login());
    });

    if (defined('APP_URI_ADMIN')) {
        Route::POST(APP_URI_LOGIN, function () {

            $validator = (new Validator(Request::getParams(), true))
                ->param('email', 'Email')->isRequired()->isEmail()->minLength(5)
                ->param('password', 'Password')
                    ->isRequired()
                    ->matches('/[^0-9a-z\ ]+/', 'Password must contain at least one Special Character.')
                    ->matches('/[A-Z]+/', 'Password must contain at least one uppercase Character.')
                    ->matches('/[a-z]+/', 'Password must contain at least one lower Character.')
                    ->matches('/[0-9]+/', 'Password must contain at least one Number.');

            if (!$validator->isValid()) {
                foreach ($validator->getErrors() as $error) {
                    Session::addAlert('error', $error);
                }

                Route::goTo(APP_URI_LOGIN);
            }

            $params = $validator->getValidParams();

            // Check if Login is Admin
            if ($params->email === APP_ADMIN_EMAIL && $params->password === APP_ADMIN_PASSWORD) {
                // Login User
                Session::loginUser((object) ['id' => 0, 'type' => 'admin', 'name' => 'Admin', 'email' => $params->email]);

                // If Session is set correctly, then redirect to Admin Page, otherwise redirect back to Login.
                Route::goTo(Session::getUser() ? APP_URI_ADMIN : APP_URI_LOGIN);
            }

            // Check if Login is User
            // TODO: Search Database for User
            if (isset($user) && isset($user->name) && isset($user->id) && isset($user->email)) {
                // Login User
                Session::loginUser((object) ['id' => $user->id, 'type' => 'user', 'name' => $user->name, 'email' => $user->email]);
            }

            // If Session is set correctly, then redirect to Admin Page, otherwise redirect back to Login.
            Route::goTo(Session::getUser() ? APP_URI_PORTAL : APP_URI_LOGIN);
        });
    }

}

/**
 * Signup Page
 */
if (defined('APP_URI_SIGNUP')) {

    Route::GET(APP_URI_SIGNUP, function () {
        return new Page(new Signup());
    });

    if (defined('APP_URI_PORTAL')) {
        Route::POST(APP_URI_SIGNUP, function () {

            $params = (new Validator(Request::getParams()))
                ->param('password', 'Password')->isRequired()->minLength(2)
            ->getValidParams();

            // Check Admin Password, If incorrect then redirect them to Login with Error.
            if (empty($params->password) || $params->password !== APP_AUTH_PASSWORD) {
                Session::addAlert('error', 'Incorrect Password');

                Route::goTo(APP_URI_LOGIN);
            }

            // Login User
            Session::loginUser((object) ['type' => 'admin', 'name' => 'Admin']);

            // If Session is set correctly, then redirect to Admin Page.
            if (Session::getUser()) {
                Route::goTo(APP_URI_PORTAL);
            }

            Route::goTo(APP_URI_SIGNUP);
        });
    }

}

/**
 * Admin Page
 */
if (defined('APP_URI_ADMIN')) {
    Route::GET(APP_URI_ADMIN, function () {
        if (Session::getUser()) {
            return new Dashboard(new Admin());
        }
    });
}

/**
 * Logout Page
 */
if (defined('APP_URI_LOGOUT')) {

    // Logout User and redirect to Login page
    Route::POST(APP_URI_LOGOUT, function () {
        Session::logoutUser();
        Route::goTo(APP_URI_LOGIN);
    });
}

/**
 * Run all Queue Actions
 */
if (defined('APP_URI_QUEUE')) {
    Route::POST(APP_URI_QUEUE, function (): string {

        // Do All Queue Actions Here:
        Session::clearAlerts();

        // Check and Update DB Schema.
        // Db::updateSchema(APP_PATH_DB_SCHEMA_FILE);

        return 'Success';
    });
}

/**
 * Admin Pages
 */
Route::GET('/users', function () {
    return new Dashboard(new Users());
});

/**
 * 404 Page
 *
 * If Nothing else found then show 404
 */
http_response_code(404);
new Page(new View404());
exit;
