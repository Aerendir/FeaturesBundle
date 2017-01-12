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

namespace SerendipityHQ\Bundle\FeaturesBundle\Form\DataTransformer;

use SerendipityHQ\Bundle\FeaturesBundle\Model\SubscribedFeatureInterface;
use SerendipityHQ\Bundle\FeaturesBundle\Model\SubscribedFeaturesCollection;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * {@inheritdoc}
 */
abstract class AbstractFeatureTransformer implements DataTransformerInterface
{
    /** @var string $field */
    private $featureName;

    /** @var null|SubscribedFeaturesCollection $subscribedFeatures */
    private $subscribedFeatures;

    /**
     * @param string $featureName
     * @param SubscribedFeaturesCollection $subscribedFeatures
     */
    public function __construct(string $featureName, SubscribedFeaturesCollection $subscribedFeatures)
    {
        $this->featureName = $featureName;
        $this->subscribedFeatures = $subscribedFeatures;
    }

    /**
     * @return string
     */
    public function getFeatureName() : string
    {
        return $this->featureName;
    }

    /**
     * @return SubscribedFeatureInterface
     */
    public function getCurrentTransformingFeature() : SubscribedFeatureInterface
    {
        return $this->getSubscribedFeatures()->get($this->getFeatureName());
    }

    /**
     * @return SubscribedFeaturesCollection
     */
    public function getSubscribedFeatures() : SubscribedFeaturesCollection
    {
        return $this->subscribedFeatures;
    }
}
