<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\NewsLetterSubscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Component\Validator\Constraints as Assert;

class NewsLetterSubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subscriptionEmail', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Enter your email address',
                    'aria-describedby' => 'button-addon2',
                ],
                'constraints' => [
//                    new Assert\NotNull(message: 'This information is mandatory'),
//                    new Assert\Email(message: 'This field should be a valid email')
                ],
            ])
            /*->add('submitSubscription', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-dark',
                ],
            ])*/;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsLetterSubscription::class,
        ]);
    }
}
