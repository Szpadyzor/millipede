<?php
/**
 * @package millipede
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */


use Phalcon\Loader;

$loader = new Loader();
/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
    [
        'Millipede\Api' => $config->application->apiDir,
        'Millipede\Api\Model' => $config->application->apiModelDir,
        'Millipede\Api\Service' => $config->application->apiServiceDir,
        'Millipede\Services' => $config->application->servicesDir,
        'Millipede\Models' => $config->application->modelsDir,
        'Millipede\Controllers' => $config->application->controllersDir,
        'Millipede\Forms' => $config->application->formsDir,
        'Millipede\Validations' => $config->application->validationsDir,
        'Millipede' => $config->application->libraryDir,
    ]
);

$loader->register();
// Use composer autoloader to load vendor classes
require_once BASE_PATH . '/vendor/autoload.php';