<?php

namespace App\Form;

use App\Entity\Announcement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;


class AnnouncementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                'label' => 'Titre'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'constraints' => [
                    new Assert\Positive()
                ]

            ])
            ->add('description')
            ->add('city')
            ->add('photos', FileType::class, [
                'label' => 'Insérez une image : ',
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/jpg',
                            'application/png',
                            'application/jpeg'
                        ],
                        'mimeTypesMessage' => 'Insérez une image valide',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announcement::class,
        ]);
    }
}
