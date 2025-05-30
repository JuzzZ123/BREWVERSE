<?php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use CodeIgniter\Boot;
use Config\Paths;

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */

$minPhpVersion = '8.1';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
        $minPhpVersion,
        PHP_VERSION,
    );

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;
    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Define paths for InfinityFree structure (everything in htdocs)
define('APPPATH', FCPATH . 'app' . DIRECTORY_SEPARATOR);
define('SYSTEMPATH', FCPATH . 'system' . DIRECTORY_SEPARATOR);
define('VENDORPATH', FCPATH . 'vendor' . DIRECTORY_SEPARATOR);
define('WRITEPATH', FCPATH . 'writable' . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 */

// Load Composer's autoloader
if (is_file(VENDORPATH . 'autoload.php')) {
    require VENDORPATH . 'autoload.php';
} else {
    echo 'Cannot find composer autoloader. Please run "composer install".';
    exit(1);
}

// Load our paths config file
if (is_file(APPPATH . 'Config/Paths.php')) {
    require APPPATH . 'Config/Paths.php';
} else {
    echo 'Cannot find paths config. Please check your installation.';
    exit(1);
}

$paths = new Paths();

// Location of the framework bootstrap file.
require SYSTEMPATH . 'Boot.php';

exit(Boot::bootWeb($paths));
