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

namespace SerendipityHQ\Bundle\FeaturesBundle\InvoiceDrawer;

use SerendipityHQ\Bundle\FeaturesBundle\Model\InvoiceInterface;

/**
 * Common interface for InvoiceDrawers.
 */
interface InvoiceDrawerInterface
{
    /**
     * @param InvoiceInterface $invoice
     *
     * @return mixed
     */
    public function draw(InvoiceInterface $invoice): array;
}
