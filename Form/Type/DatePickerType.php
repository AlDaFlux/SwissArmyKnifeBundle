<?php
namespace Aldaflux\SwissArmyKnifeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
 
use Symfony\Component\Form\Extension\Core\Type\DateType;

        
        
        


class DatePickerType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
         
          $resolver->setDefaults(array(
               'input' => 'datetime',
               'format' => 'dd-MM-yyyy',
               'widget' => 'single_text',
               'html5' => false,
               'attr' => array('class' => 'date_picker'))
           );
         
    }

    public function getParent()
    {
        return DateType::class;
    }
}

