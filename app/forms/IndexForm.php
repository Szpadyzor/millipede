<?php
/**
 * @package Millipede\Forms
 * @author Maciej Trybuła <mtrybula@divante.pl>
 * @copyright 2018 Divante Sp. z o.o.
 * @license See LICENSE_DIVANTE.txt for license details.
 */

namespace Millipede\Forms;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Class IndexForm
 */
class IndexForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $amount = new Text('amount');

        $amount->setLabel('Amount');

        $amount->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'Amount is required',
                    ]
                ),

                new Numericality(
                    [
                        'message' => 'Amount is numerical',
                    ]
                ),
            ]
        );

        $this->add($amount);

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
                'Confirm', [
                    'class' => 'btn btn-success',
                ]
            )
        );
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