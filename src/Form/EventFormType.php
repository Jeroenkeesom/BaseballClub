<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'date',
            DateType::class,
            [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'html5' => false,
                'format' => 'LLL d, y',
            ]
        );
        if ($options['is_game']) {
            $builder->add('noOfInnings', IntegerType::class, ['required' => true, 'data' => 9]);
        }
        $builder->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Event::class);
        $resolver->setDefault('label', false);
        $resolver->setDefault('is_game', false);
        $resolver->setAllowedTypes('is_game', 'boolean');
    }
}
