<?php
/**
 * @package docker
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace controllers;

use Phalcon\Mvc\Controller;

/**
 * Class IndexController
 *
 * @package controllers
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        echo '<h1>Hello!</h1>';
    }
}