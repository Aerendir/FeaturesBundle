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

use SerendipityHQ\Bundle\FeaturesBundle\Model\BooleanFeatureInterface;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * {@inheritdoc}
 */
class FeatureTransformer implements DataTransformerInterface
{
    /**
     * Transforms a Feature object into the right value to be set in the form.
     *
     * @param FeatureInterface|null $feature
     *
     * @return string
     */
    public function transform($feature)
    {
        if ($feature instanceof BooleanFeatureInterface)
            return $feature->isEnabled();

        throw new \RuntimeException('Unknown feature type :( .');
    }

    /**
     * Transforms a form value into a Feature object.
     *
     * @param string $feature
     *
     * @return DomainEmbeddable|null
     */
    public function reverseTransform($feature)
    {
        die(dump($feature));

        return $feature;
    }
}
