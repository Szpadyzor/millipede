<?php
/**
 * Created by PhpStorm.
 * User: mtrybula
 * Date: 20.12.18
 * Time: 23:50
 */

namespace App\Form\EventListener;

use App\Entity\Millipede;
use App\Form\DeveloperType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DynamicallyFieldGeneratorSubscriber
 *
 * @package App\Form\EventListener
 */
class DynamicallyFieldGeneratorSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [FormEvents::PRE_SET_DATA => 'dynamicallyFieldGenerator'];
    }

    /**
     * @param FormEvent $event
     */
    public function dynamicallyFieldGenerator(FormEvent $event)
    {
        $form = $event->getForm();
        $form
            ->add(
                'developers',
                CollectionType::class,
                [
                    'entry_type' => DeveloperType::class,
                    'entry_options' => ['label' => false],
                ]
            );
    }

    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults(['data_class' => Millipede::class]);
    }
}
