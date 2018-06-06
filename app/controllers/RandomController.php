<?php
/**
 * @package Trysoft\app
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Controllers;

use Millipede\Api\Services\MillipedeInterface;
use Millipede\Forms\RandomForm;
use Phalcon\Mvc\Controller;

/**
 * Class RandomController
 */
class RandomController extends Controller
{

    /**
     * @param int $amount
     */
    public function indexAction()
    {
        $this->view->setTemplateBefore('public');

        if (!$this->request->getPost('amount')) {
            $this->flash->error('You must enter amount of developers');
            $this->response->redirect('/');
        }

        $this->view->amount = $this->createElementsAmount();

        $form = new RandomForm();

        $this->view->form = $form;
    }

    /**
     *
     */
    public function chosenAction()
    {
        /** @var MillipedeInterface $millipede */
        $millipedeService = $this->di->get('millipedeService');

        $millipede = $millipedeService->getMillipede($this->request->get());

        $this->view->millipede = $millipede;
    }

    /**
     * @return array
     */
    private function createElementsAmount()
    {
        for ($i = 1; $i <= $this->request->getPost('amount'); $i++)
        {
            $devs[] = $i;
        }

        return $devs;
    }
}
