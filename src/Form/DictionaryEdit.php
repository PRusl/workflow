<?php
namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DictionaryEdit extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, ['label' => 'Назва'])
            ->add('enable' , CheckboxType::class, ['label' => 'Увімкнено', 'required' => false])
            ->add('top' , CheckboxType::class, ['label' => 'Виводити на початку', 'required' => false])
            ->add('save', SubmitType::class, ['label' => 'Зберегти'])
            ->getForm();
    }
}