<?php
namespace App\form;

use App\Entity\Medicijn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class medicijnFormType extends abstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('discription')
            ->add('sideEffect')
            ->add('insurance')
            ;

    }
    /**
     * {@inheritdoc}
     */

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medicijn::class,
        ]);
    }

}