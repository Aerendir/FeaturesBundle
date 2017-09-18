<?php

/*
 * This file is part of the SHQFeaturesBundle.
 *
 * Copyright Adamo Aerendir Crespi 2016-2017.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    Adamo Aerendir Crespi <hello@aerendir.me>
 * @copyright Copyright (C) 2016 - 2017 Aerendir. All rights reserved.
 * @license   MIT License.
 */

namespace SerendipityHQ\Bundle\FeaturesBundle\Property;

/**
 * Manages properties of a Recurring feature.
 */
trait IsRecurringFeatureProperty
{
    /** @var \DateTime $activeUntil */
    private $activeUntil;

    /**
     * @param array $details
     */
    public function __construct(array $details = [])
    {
        if (isset($details['active_until'])) {
            $this->activeUntil = $details['active_until'] instanceof \DateTime ? $details['active_until'] : new \DateTime($details['active_until']['date'], new \DateTimeZone($details['active_until']['timezone']));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getActiveUntil()
    {
        return $this->activeUntil;
    }

    /**
     * {@inheritdoc}
     */
    public function isStillActive(): bool
    {
        if (null === $this->getActiveUntil()) {
            return false;
        }

        return $this->getActiveUntil() >= new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function setActiveUntil(\DateTime $activeUntil): IsRecurringFeatureInterface
    {
        $this->activeUntil = $activeUntil;

        /** @var IsRecurringFeatureInterface $this */
        return $this;
    }
}
