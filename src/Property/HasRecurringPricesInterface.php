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

use SerendipityHQ\Bundle\FeaturesBundle\Model\SubscriptionInterface;
use SerendipityHQ\Component\ValueObjects\Currency\CurrencyInterface;
use SerendipityHQ\Component\ValueObjects\Money\MoneyInterface;

/**
 * Common methods to manage a feature that is bought in a recurring subscription.
 */
interface HasRecurringPricesInterface extends CanBeFreeInterface
{
    /**
     * @param CurrencyInterface|string $currency             This is not typecasted so the method can be called from inside Twig templates simply passing a string
     * @param string                   $subscriptionInterval
     * @param string|null              $type
     *
     * @throws \InvalidArgumentException If the $subscriptionInterval does not exist
     *
     * @return MoneyInterface|null if the price is not set in the required currency
     */
    public function getInstantPrice($currency, string $subscriptionInterval, string $type = null): MoneyInterface;

    /**
     * @param CurrencyInterface|string $currency             This is not typecasted so the method can be called from inside Twig templates simply passing a string
     * @param string                   $subscriptionInterval
     * @param string|null              $type
     *
     * @return MoneyInterface
     */
    public function getPrice($currency, string $subscriptionInterval, string $type = null): MoneyInterface;

    /**
     * @param string|null $type
     *
     * @return array
     */
    public function getPrices(string $type = null): array;

    /**
     * @return string
     */
    public function getTaxName(): string;

    /**
     * @return float
     */
    public function getTaxRate(): float;

    /**
     * @param CurrencyInterface|string $currency             This is not typecasted so the method can be called from inside Twig templates simply passing a string
     * @param string                   $subscriptionInterval
     * @param string|null              $type
     *
     * @return bool
     */
    public function hasPrice($currency, string $subscriptionInterval, string $type = null): bool;

    /**
     * @param SubscriptionInterface $subscription
     *
     * @return HasRecurringPricesInterface
     */
    public function setSubscription(SubscriptionInterface $subscription): HasRecurringPricesInterface;

    /**
     * @param float  $rate
     * @param string $name
     *
     * @return HasRecurringPricesInterface
     */
    public function setTax(float $rate, string $name): HasRecurringPricesInterface;
}
