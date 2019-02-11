<?php

namespace OC\BookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nb_tickets', ChoiceType::class,
                [ 'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ], 'label' => 'Nombre de billets',
                ])
            ->add('visitDate', DateTimeType::class, array(
                'widget' => 'single_text',
                'label' => 'Date de visite',
                ))
            ->add('visitType', ChoiceType::class, array(
                'placeholder' => 'Veuillez choisir votre type de billet',
                'choices' => array(
                    'Demi-journée (à partir de 14h00)' => 0,
                    'Journée (à partir de 09h00)' => 1,
                ),
                'label' => 'Type de billet',
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Valider'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\BookingBundle\Entity\Booking'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_bookingbundle_booking';
    }


}
