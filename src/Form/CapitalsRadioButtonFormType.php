<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CapitalsRadioButtonFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('selectedOption', ChoiceType::class, [
				'choices' => $options['choices'], // Set choices dynamically
				'expanded' => true,
				'multiple' => false,
				'label' => 'Select an option:',
				'attr' => [
				//'class' => 'form-control', // Add your CSS classes here
			]
			])
			->add('country_name', HiddenType::class, [
				'data' => $options['country_name']
			])
			->add('submit', SubmitType::class, [
				'label' => 'Submit',
				'attr' => [
					'class' => 'btn btn-primary' // Optionally, add CSS classes for styling
				]
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'method' => 'POST',
			'country_name' => '',
			'choices' => [], // Default empty array for choices
		]);
	}

	public function getName()
	{
		return 'CapitalsRadioButtonFormType';
	}
}
