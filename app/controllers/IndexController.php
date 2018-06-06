<?php
/**
 * @package millipede
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Controllers;

use Millipede\Forms\IndexForm;
use Phalcon\Mvc\Controller;

/**
 * Class IndexController
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->setTemplateBefore('public');

        $this->view->form = new IndexForm();
    }
}
