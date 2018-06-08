<?php
/**
 * @package Trysoft\app
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Controllers;

use Millipede\Api\Services\EmailInterface;
use Millipede\Forms\RandomForm;
use Millipede\Services\Email;
use Millipede\Services\Millipede as MillipedeService;
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
        /** @var MillipedeService $millipedeService */
        $millipedeService = $this->di->get('millipedeService');

        /** @var MillipedeService $millipede */
        $millipede = $millipedeService->createMillipede($this->request->get());
        $emails = $millipede->getEmails();

        /** @var Email $emailService */
        $emailService = $this->di->get('emailService');
        $emailMessage = $emailService->prepareMessage($emails);
        $emailStatus = $emailService->sendEmails($emails, $emailMessage);

        $this->view->emailMessage = $emailMessage;
        $this->view->emailsSent = implode(', ', $emailStatus[EmailInterface::EMAIL_STATUS_SENT]);
        $this->view->emailsNotSent = implode(', ', $emailStatus[EmailInterface::EMAIL_STATUS_NOT_SENT]);
        $this->view->emailStatus = $emailStatus;
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
