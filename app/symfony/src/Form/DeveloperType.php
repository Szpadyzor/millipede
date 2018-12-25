<?php
/**
 * Created by PhpStorm.
 * User: mtrybula
 * Date: 25.12.18
 * Time: 12:54
 */

namespace App\Form;


use App\Entity\Developer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DeveloperType
 *
 * @package App\Form
 */
class DeveloperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(Developer::FIRSTNAME, null, ['required' => false])
            ->add(Developer::LASTNAME, null, ['required' => false])
            ->add(Developer::PROJECT, null, ['required' => false])
            ->add(Developer::FUNCTION, null, ['required' => false])
            ->add(Developer::EMAIL, null, ['required' => false]);
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Developer::class,
            ]
        );
    }
}