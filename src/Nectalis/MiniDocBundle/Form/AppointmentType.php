<?php

namespace Nectalis\MiniDocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patientName')
            ->add('startDate')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nectalis\MiniDocBundle\Entity\Appointment'
        ));
    }

    public function getName()
    {
        return 'nectalis_minidocbundle_appointmenttype';
    }
}
