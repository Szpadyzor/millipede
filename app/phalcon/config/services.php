<?php
/**
 * @package millipede
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Logger\Formatter\Line as FormatterLine;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * Register the global configuration as config
 */
$di->setShared(
    'config',
    function () {
        $config = include APP_PATH . '/config/config.php';

        if (is_readable(APP_PATH . '/config/config.dev.php')) {
            $override = include APP_PATH . '/config/config.dev.php';
            $config->merge($override);
        }

        return $config;
    }
);

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared(
    'url',
    function () {
        $config = $this->getConfig();
        $url = new UrlResolver();
        $url->setBaseUri($config->application->baseUri);

        return $url;
    }
);

/**
 * Setting up the view component
 */
$di->set(
    'view',
    function () {
        $config = $this->getConfig();
        $view = new View();
        $view->setViewsDir($config->application->viewsDir);
        $view->registerEngines(
            [
                '.volt' => function ($view) {
                    $config = $this->getConfig();
                    $volt = new VoltEngine($view, $this);
                    $volt->setOptions(
                        [
                            'compiledPath' => $config->application->cacheDir . 'volt/',
                            'compiledSeparator' => '_',
                        ]
                    );

                    return $volt;
                },
            ]
        );

        return $view;
    },
    true
);

/**
 * Start the session the first time some component request the session service
 */
$di->set(
    'session',
    function () {
        $session = new SessionAdapter();
        $session->start();

        return $session;
    }
);

/**
 * Dispatcher use a default namespace
 */
$di->set(
    'dispatcher',
    function () {
        $dispatcher = new Dispatcher();
        $dispatcher->setDefaultNamespace('Millipede\Controllers');

        return $dispatcher;
    }
);

// Set up the flash service
$di->set(
    'flash',
    function () {
        $flash = new FlashDirect(
            ['error' => 'alert alert-info']
        );

        return $flash;
    }
);

// Set up the flash session service
$di->set(
    'flashSession',
    function () {
        return new FlashSession();
    }
);

$di->set(
    'millipedeService',
    function () {
        return new \Millipede\Services\Millipede();
    }
);

$di->set(
    'emailService',
    function () {
        return new \Millipede\Services\Email();
    }
);

/**
 * Loading routes from the routes.php file
 */
$di->set(
    'router',
    function () {
        return require APP_PATH . '/config/routes.php';
    }
);

/**
 * Logger service
 */
$di->set(
    'logger',
    function ($filename = null, $format = null) {
        $config = $this->getConfig();
        $format = $format ?: $config->get('logger')->format;
        $filename = trim($filename ?: $config->get('logger')->filename, '\\/');
        $path = rtrim($config->get('logger')->path, '\\/') . DIRECTORY_SEPARATOR;
        $formatter = new FormatterLine($format, $config->get('logger')->date);
        $logger = new FileLogger($path . $filename);
        $logger->setFormatter($formatter);
        $logger->setLogLevel($config->get('logger')->logLevel);

        return $logger;
    }
);