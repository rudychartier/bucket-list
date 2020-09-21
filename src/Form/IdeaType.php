<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Idea;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyPath;

class IdeaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,['label'=>'title'])
            ->add('description',TextareaType::class,['label'=>'description'])
            ->add('author',TextType::class,['label'=>'author','attr'=>['value'=>$options['username']]])
            ->add('category',EntityType::class,['class'=>Category::class,
        'choice_label'=>function($category){return $category->getName();}]);



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Idea::class,
            'username'=>User::class
        ]);

    }
}
