<?php

/*
 * This file is part of the Serendipity HQ Features Bundle.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Bundle\FeaturesBundle\Model;

use SerendipityHQ\Bundle\FeaturesBundle\Model\Property\IsRecurringFeatureInterface;

/**
 * {@inheritdoc}
 */
interface SubscribedBooleanFeatureInterface extends IsRecurringFeatureInterface, SubscribedFeatureInterface
{
    public function disable(): FeatureInterface;

    public function enable(): FeatureInterface;

    public function isEnabled(): bool;
}
