<?php declare(strict_types = 1);
/**
 * App file
 * This file runs the entire App.
 */

use SpryPhp\Provider\Alerts;
use SpryPhp\Provider\Functions;
use SpryPhp\Provider\Request;
use SpryPhp\Provider\Session;

// Include Auto Loader
require_once dirname(__DIR__).'/vendor/autoload.php';

// Prettify Exceptions Messages and Stack Traces.
Functions::formatExceptions();

// Load Local Environment Vars
if (file_exists(dirname(__DIR__).'/.env')) {
    Functions::loadEnvFile(dirname(__DIR__).'/.env');
}

// Include Config
require_once __DIR__.'/config.php';

// Configure Debug Settings
Functions::setDebug();

// Check Host and Protocol
Functions::forceHost();

// Start Sessions
$sessionId = Session::setup();

// Check if Admin is Logged In and if so then update their session.
if ($sessionId === Session::makeIdFrom('admin'.APP_AUTH_PASSWORD)) {
    Session::update((object) ['type' => 'admin', 'name' => 'Admin']);
}

// Setup Request Data
Request::setup();

// Grab Alerts from Session
Alerts::setup();

// Check the App for Issues.
Functions::checkAppIntegrity();

// Call Routes
require_once APP_PATH_ROUTES;
