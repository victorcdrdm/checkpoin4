<?php

namespace App\Form;


use App\Entity\Grape;
use App\Entity\Region;
use App\Entity\Vignoble;
use App\Entity\Wine;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class WineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('name')
            ->add('year', DateType::class, [
                'label'    => 'Milesime',
                'years'    => range(1980, 2020,1),
                'format'   => 'dd-MM-yyyy',
                'required' => true,
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'data' => $options['region'],

            ])
            ->add('comment' )

            ->add('grapes', EntityType::class, [
                    'class'  => Grape::class,
                    'choice_label'=> 'name',
                    'multiple'    => true,
                    'expanded'    => true,
                ]
            )
            ->add('vignoble' ,EntityType::class, [
                'class' => Vignoble::class,
                'query_builder' => function (EntityRepository $entityRepository) use($options) {
                    return $entityRepository->createQueryBuilder('v')
                        ->where('v.region = :region' )
                        ->setParameter('region', $options['region']);
                },
                'choice_label' => 'name',
                'multiple'    => false,
                'expanded'    => true,
                'required' => true,
            ])
            ->add('picture')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wine::class,
            'region' => null,
        ]);
    }
}
