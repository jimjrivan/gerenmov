<?php

namespace App\Form;

use App\Entity\Movimentos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MovimentosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descricao_str', TextAreaType::class, 
                array('label' => 'Descrição : ',
                      'attr' => array('maxlength' => 500)))
            ->add('valor_num', MoneyType::class, 
                array('label' => 'Valor : ',
                      'currency' => 'false'))
            ->add('funcionario', null,
                array('label' => 'Funcionário : '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movimentos::class,
        ]);
    }
}
