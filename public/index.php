<?php
/**
 * @package millipede
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */


use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application;
error_reporting(E_ALL);

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new FactoryDefault();
    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';
    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();
    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';
    /**
     * Handle the request
     */
    $application = new Application($di);
    echo $application->handle()
        ->getContent();
} catch (Exception $e) {
    echo $e->getMessage(), '<br>';
    echo nl2br(htmlentities($e->getTraceAsString()));
}