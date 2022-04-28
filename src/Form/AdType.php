<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends AbstractType
{
    private function configuration($label,$placeholder){
        return [
            'label'=>$label,
            'attr'=>[
                'placeholder'=>$placeholder
            ]
        ];
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, $this->configuration('Nom :',"Tapez ici le nom de l'evenement"))
            ->add('slug',TextType::class, $this->configuration('Slug : ',"Tapez ici le slug de l'evenement"))
            ->add('introduction',TextType::class, $this->configuration('Thème : ',"Tapez ici le thème de l'evenement"))
            ->add('content',TextareaType::class, $this->configuration('Contenue ',"Tapez ici le contenue, les déroulement de l'evenement"))
            ->add('lieu',TextType::class, $this->configuration("Lieu d'évenement","Tapez ici le lieu d'évenement"))
            ->add('dateevt',DateTimeType::class, $this->configuration("Date de début : ",'Tapez ici le nom du client'))
            ->add('datefinevt',DateTimeType::class, $this->configuration("Date de fin : ",'Tapez ici le nom du client'))
            ->add('coverImage',FileType::class, $this->configuration('Image : ',"Veuillez selectionner votre images"))
            ->add('Images',CollectionType::class,
                [
                    "entry_type" => ImageType::class,
                    // "allow_add" =>true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
