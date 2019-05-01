<?php


namespace App\Form;


use App\Entity\EventPresence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresenceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'noOfInningsPlayed',
            IntegerType::class,
            [
                'attr' => [
                    'min' => 0,
                    'max' => $options['innings'],
                ],
                'required' => true,

            ]
        );
        $builder->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', EventPresence::class);
        $resolver->setDefault('label', false);
        $resolver->setDefault('innings', 0);
        $resolver->setAllowedTypes('innings', 'integer');
    }
}
