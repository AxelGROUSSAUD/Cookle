<?php

namespace App\Form;

use App\Entity\CourseType;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\Source;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('extrainfo')
            ->add('adjustments')



            ->add('courseType', EntityType::class, [
                'class' => CourseType::class,
                'label' => 'Type de plat',
                'choice_label' => 'name'

            ])

            ->add('source', EntityType::class, [
                'class' => Source::class,
                'label' => 'Source' ,
                'choice_label' => 'name'
            ])

            /*->add('ingredient', EntityType::class, [
                'class' =>Ingredient::class,
                'label' => 'Ingredient',
                'choice_label' => 'Ingredients'
            ])*/

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
