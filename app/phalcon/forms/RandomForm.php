<?php
/**
 * @package Millipede\Forms
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Forms;

use Phalcon\Forms\Element\Email as EmailElement;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\Email;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Millipede\Api\Model\MillipedeInterface;

/**
 * Class RandomForm
 */
class RandomForm extends Form
{
    /**
     * @param null $entity
     * @param null $options
     */
    public function initialize($entity = null, $options = null)
    {

            $this->addEmailElement();
            $this->addProjectElement();
            $this->addFunctionElement();

        // CSRF
        $csrf = new Hidden('csrf');
        $csrf->addValidator(
            new Identical(
                [
                    'value' => $this->security->getSessionToken(),
                    'message' => 'CSRF validation failed',
                ]
            )
        );
        $csrf->clear();
        $this->add($csrf);

        // Sign Up
        $this->add(
            new Submit(
                'Choose', [
                    'class' => 'btn btn-success',
                ]
            )
        );
    }

    protected function addEmailElement()
    {
        $email = new EmailElement(MillipedeInterface::EMAIL);
        $email->setLabel('E-Mail');
        $email->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'The e-mail is required',
                    ]
                ),
                new Email(
                    [
                        'message' => 'The e-mail is not valid',
                    ]
                ),
            ]
        );

        $this->add($email);
    }

    protected function addProjectElement()
    {
        $project = new Text(MillipedeInterface::PROJECT);
        $project->setLabel('Main Project');

        $this->add($project);
    }

    protected function addFunctionElement()
    {
        $function = new Text(MillipedeInterface::FUNCTION);
        $function->setLabel('Function: \'D\' - Developer, function \'L\' - Project Leader');

        $this->add($function);
    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}