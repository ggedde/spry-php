<?php declare(strict_types=1);
/**
 * Routes file
 */

use App\Controller\Users as UsersController;
use App\Model\User;
use App\View\Admin\Users;
use App\View\Dashboard\Admin;
use App\View\Layout\AdminLayout;
use App\View\Layout\Page;
use App\View\Layout\PortalLayout;
use App\View\Page\Login;
use App\View\Page\Signup;
use App\View\Page\View404;
use App\View\Portal\Dashboard;
use SpryPhp\Model\Validator;
use SpryPhp\Provider\Request;
use SpryPhp\Provider\Route;
use SpryPhp\Provider\Session;

/**
 * Home Page
 */
if (defined('APP_URI')) {

    Route::GET(APP_URI, function () {
        Route::redirect(APP_URI_LOGIN);
    });

}

/**
 * Login Page
 */
if (defined('APP_URI_LOGIN')) {

    Route::GET(APP_URI_LOGIN, function () {
        $user = Session::getUser();

        if ($user && $user->type === 'admin' && defined('APP_URI_ADMIN')) {
            Route::redirect(APP_URI_ADMIN);
        }

        if ($user && $user->type === 'user' && defined('APP_URI_PORTAL')) {
            Route::redirect(APP_URI_PORTAL);
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

                Route::redirect(APP_URI_LOGIN);
            }

            $params = $validator->getValidParams();

            // Check if Login is Admin
            if ($params->email === APP_ADMIN_EMAIL && $params->password === APP_ADMIN_PASSWORD) {
                // Login User
                Session::loginUser((object) [
                    'id' => 0,
                    'type' => 'admin',
                    'name' => 'Admin',
                    'email' => $params->email,
                ]);

                // If Session is set correctly, then redirect to Admin Page, otherwise redirect back to Login.
                Route::redirect(Session::getUser() ? APP_URI_ADMIN : APP_URI_LOGIN);
            }

            // Check if Login is User
            try {
                // Get User
                $user = new User(['email' => $params->email, 'password' => hash('sha256', $params->password)]);
                // Login User
                Session::loginUser((object) [
                    'id' => $user->id,
                    'type' => 'user',
                    'name' => $user->name,
                    'email' => $user->email,
                ]);
            } catch (\Exception $e) {
                Session::addAlert('error', 'Incorrect Email or Password');
            }

            // If Session is set correctly, then redirect to Portal Page
            if (Session::getUser()) {
                Route::redirect(APP_URI_PORTAL);
            }

            // Otherwise redirect back to Login with Params.
            Route::redirect(APP_URI_LOGIN, ['loginEmail' => $params->email]);
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

            $validator = (new Validator(Request::getParams()))
                ->param('name', 'Name')
                    ->isRequired()
                    ->isString()
                    ->minLength(2)
                ->param('email', 'Email')
                    ->isRequired()
                    ->isEmail()
                    ->minLength(5)
                ->param('password', 'Password')
                    ->isRequired()
                    ->minLength(2)
                    ->matches('/[^0-9a-z\ ]+/', 'Password must contain at least one Special Character.')
                    ->matches('/[A-Z]+/', 'Password must contain at least one uppercase Character.')
                    ->matches('/[a-z]+/', 'Password must contain at least one lower Character.')
                    ->matches('/[0-9]+/', 'Password must contain at least one Number.');

            // Check Params
            $params = $validator->getValidParams();
            if (!$validator->isValid() || empty($params)) {
                foreach ($validator->getErrors() as $error) {
                    Session::addAlert('error', $error);
                }
                Route::redirect(APP_URI_SIGNUP);
            }

            // Try and Signup User.
            try {
                $user = UsersController::signup($params->name, $params->email, $params->password);
            } catch (\Exception $e) {
                Session::addAlert('error', sprintf('Error: %s', $e->getMessage()));
                Route::redirect(APP_URI_SIGNUP);
            }

            // Login User
            Session::loginUser((object) [
                'id' => $user->id,
                'type' => 'user',
                'name' => $user->name,
                'email' => $user->email,
            ]);

            // If Session is set correctly, then redirect to Admin Page.
            Route::redirect(Session::getUser() ? APP_URI_PORTAL : APP_URI_SIGNUP);
        });
    }

}

/**
 * Logout Page
 */
if (defined('APP_URI_LOGOUT')) {

    // Logout User and redirect to Login page
    Route::POST(APP_URI_LOGOUT, function () {
        Session::logoutUser();
        Route::redirect(APP_URI_LOGIN);
    });
}

$user = Session::getUser();

/**
 * Admin Pages
 */
if ($user && $user->type === 'admin') {
    Route::GET(APP_URI_ADMIN, function () {
        if (Session::getUser()) {
            return new AdminLayout(new Admin());
        }
    });
    Route::GET('/users', function () {
        return new AdminLayout(new Users());
    });
}


/**
 * Portal Pages
 */
if ($user && $user->type === 'user') {
    Route::GET('/portal', function () {
        if (Session::getUser()) {
            return new PortalLayout(new Dashboard());
        }
    });
}


/**
 * Run all Queue Actions
 */
if (defined('APP_URI_QUEUE')) {
    Route::POST(APP_URI_QUEUE, function (): string {

        return 'Success';
    });
}

/**
 * 404 Page
 *
 * If Nothing else found then show 404
 */
http_response_code(404);
new Page(new View404());
exit;
