<?php
/**
 * Created by PhpStorm.
 * User: mtrybula
 * Date: 20.12.18
 * Time: 20:36
 */

namespace App\Form;

use App\Entity\Millipede;
use App\Form\EventListener\DynamicallyFieldGeneratorSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MillipedeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new DynamicallyFieldGeneratorSubscriber());
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' =>  Millipede::class]
        );
    }
}