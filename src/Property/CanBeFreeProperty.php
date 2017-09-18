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
 * Concrete implementetion of the CanBeFreeInterface.
 */
trait CanBeFreeProperty
{
    /**
     * @return bool
     */
    public function isFree(): bool
    {
        return empty($this->netPrices) && empty($this->grossPrices);
    }
}
