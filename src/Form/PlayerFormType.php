<?php


namespace App\Form;

use App\Entity\Player;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, ['required' => true]);
        $builder->add('lastName', TextType::class, ['required' => true]);
        $builder->add('nickName', TextType::class, ['required' => false]);
        $builder->add('shirtNumber', IntegerType::class, ['required' => false]);
        $builder->add('preferredPosition', TextType::class, ['required' => false]);
        $builder->add(
            'activeSince',
            DateType::class,
            [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'html5' => false,
                'format' => 'LLL d, y',
            ]
        );
        $builder->add(
            'active',
            ChoiceType::class,
            [
                'required' => true,
                'choices' => [
                    'active' => true,
                    'inactive' => false,
                ],
            ]
        );
        $builder->add(
            'playerType',
            ChoiceType::class,
            [
                'required' => true,
                'choices' => [
                    'trainee' => 1,
                    'gamer' => 2,
                ],
                'multiple' => false,
            ]
        );
        $builder->add(
            'team',
            EntityType::class,
            [
                'class' => Team::class,
                'required' => true,
                'choice_label' => 'name',
            ]
        );
        $builder->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Player::class);
        $resolver->setDefault('label', false);
    }
}
