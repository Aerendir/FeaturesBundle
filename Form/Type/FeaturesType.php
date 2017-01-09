<?php

/*
 * This file is part of the Trust Back Me Www.
 *
 * Copyright Adamo Aerendir Crespi 2012-2016.
 *
 * This code is to consider private and non disclosable to anyone for whatever reason.
 * Every right on this code is reserved.
 *
 * @author    Adamo Aerendir Crespi <hello@aerendir.me>
 * @copyright Copyright (C) 2012 - 2016 Aerendir. All rights reserved.
 * @license   SECRETED. No distribution, no copy, no derivative, no divulgation or any other activity or action that
 *            could disclose this text.
 */

namespace SerendipityHQ\Bundle\FeaturesBundle\Form\Type;

use SerendipityHQ\Bundle\FeaturesBundle\Form\DataTransformer\BooleanFeatureTransformer;
use SerendipityHQ\Bundle\FeaturesBundle\Form\DataTransformer\CountableFeatureTransformer;
use SerendipityHQ\Bundle\FeaturesBundle\Form\DataTransformer\RechargeableFeatureTransformer;
use SerendipityHQ\Bundle\FeaturesBundle\Model\ConfiguredBooleanFeature;
use SerendipityHQ\Bundle\FeaturesBundle\Model\ConfiguredCountableFeature;
use SerendipityHQ\Bundle\FeaturesBundle\Model\ConfiguredCountableFeatureInterface;
use SerendipityHQ\Bundle\FeaturesBundle\Model\ConfiguredCountableFeaturePack;
use SerendipityHQ\Bundle\FeaturesBundle\Model\ConfiguredFeaturePackInterface;
use SerendipityHQ\Bundle\FeaturesBundle\Model\ConfiguredRechargeableFeature;
use SerendipityHQ\Bundle\FeaturesBundle\Model\FeatureInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * {@inheritdoc}
 */
class FeaturesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var FeatureInterface $feature */
        foreach ($options['configured_features']->getValues() as $feature) {
            switch (get_class($feature)) {
                case ConfiguredBooleanFeature::class:
                    $builder->add($feature->getName(), CheckboxType::class, ['required' => false]);
                    $builder->get($feature->getName())->addModelTransformer(new BooleanFeatureTransformer($feature->getName()));
                    break;
                case ConfiguredCountableFeature::class:
                    /** @var ConfiguredCountableFeatureInterface $feature */
                    $builder->add($feature->getName(), ChoiceType::class, ['required' => false, 'choices' => $this->getCountableFeaturePacks($feature)]);
                    $builder->get($feature->getName())->addModelTransformer(new CountableFeatureTransformer($feature->getName()));
                    break;
                case ConfiguredRechargeableFeature::class:
                    $builder->add($feature->getName(), IntegerType::class, ['required' => false]);
                    $builder->get($feature->getName())->addModelTransformer(new RechargeableFeatureTransformer($feature->getName()));
                    break;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setRequired([
            'configured_features',
        ]);
    }

    /**
     * @param ConfiguredCountableFeatureInterface $feature
     *
     * @return array
     */
    private function getCountableFeaturePacks(ConfiguredCountableFeatureInterface $feature)
    {
        $choices = [];
        /** @var ConfiguredCountableFeaturePack $pack */
        foreach ($feature->getPacks() as $pack) {
            $choices[$pack->getNumOfUnits()] = $pack->getNumOfUnits();
        }

        return $choices;
    }
}
