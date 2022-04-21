<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImageType extends AbstractType
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
            ->add('photo',FileType::class, $this->configuration('Image : ',"Veuillez selectionner votre images"))
            ->add('caption',TextType::class, $this->configuration('Légende :',"Tapez ici a légende du photo"))
            // ->add('ad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
