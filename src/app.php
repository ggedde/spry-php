<?php declare(strict_types=1);
/**
 * App file
 * This file runs the entire App.
 */

use SpryPhp\Provider\Functions;
use SpryPhp\Provider\Request;
use SpryPhp\Provider\Session;

// Include Auto Loader
require_once dirname(__DIR__).'/vendor/autoload.php';

// Prettify Exceptions Messages and Stack Traces.
Functions::formatExceptions();

// Load Local Environment Vars.
if (file_exists(dirname(__DIR__).'/.env')) {
    Functions::loadEnvFile(dirname(__DIR__).'/.env');
}

// Include Config.
require_once __DIR__.'/config.php';

// Configure Debug Settings.
Functions::setDebug();

// Check Host and Protocol.
Functions::forceHost();

// // Start and Setup Sessions.
Session::start();

// Setup Request Data.
Request::setup();

// Check the App for Issues.
Functions::checkAppIntegrity();

// Call Routes.
require_once APP_PATH_ROUTES;
