<?php
/**
 * @package millipede
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

use Phalcon\Config;
use Phalcon\Logger;

return new Config(
    [
        'database' => [
            'adapter' => 'Mysql',
            'host' => '172.19.0.2',
            'username' => 'root',
            'password' => '',
            'dbname' => 'millipede',
        ],
        'application' => [
            'apiDir' => APP_PATH . '/api/',
            'apiModelDir' => APP_PATH . '/api/model',
            'apiServiceDir' => APP_PATH . '/api/service',
            'servicesDir' => APP_PATH . '/services/',
            'controllersDir' => APP_PATH . '/controllers/',
            'modelsDir' => APP_PATH . '/models/',
            'formsDir' => APP_PATH . '/forms/',
            'validationsDir' => APP_PATH . '/validations/',
            'viewsDir' => APP_PATH . '/views/',
            'libraryDir' => APP_PATH . '/library/',
            'pluginsDir' => APP_PATH . '/plugins/',
            'cacheDir' => BASE_PATH . '/cache/',
            'baseUri' => '/',
        ],
        'mail' => [
            'fromName' => 'Millipede',
            'fromEmail' => 'maciej.trybula@gmail.com',
            'smtp' => [
                'server' => 'smtp.gmail.com',
                'port' => 587,
                'security' => 'tls',
                'username' => '',
                'password' => '',
            ],
        ],
        'logger' => [
            'path' => BASE_PATH . '/logs/',
            'format' => '%date% [%type%] %message%',
            'date' => 'D j H:i:s',
            'logLevel' => Logger::DEBUG,
            'filename' => 'application.log',
        ],
        // Set to false to disable sending emails (for use in test environment)
        'useMail' => true,
    ]
);