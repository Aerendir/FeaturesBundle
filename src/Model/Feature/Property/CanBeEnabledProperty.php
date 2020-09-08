<?php

/*
 * This file is part of the Serendipity HQ Features Bundle.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Bundle\FeaturesBundle\Model\Feature\Property;

trait CanBeEnabledProperty
{
    /** @var bool $enabled */
    private $enabled = false;

    public function disable(): CanBeEnabledInterface
    {
        $this->enabled = false;

        /** @var CanBeEnabledInterface $this */
        return $this;
    }

    public function enable(): CanBeEnabledInterface
    {
        $this->enabled = true;

        /** @var CanBeEnabledInterface $this */
        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
