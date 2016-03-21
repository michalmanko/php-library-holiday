<?php

/*
 * This file is part of the Holiday Library.
 *
 * (c) Michał Mańko <github@michalmanko.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Michalmanko\Holiday;

use DateTimeZone;
use Michalmanko\Holiday\Exception\InvalidArgumentException;

/**
 * Holiday providers factory.
 *
 * Declared abstract, as we have no need for instantiation.
 *
 * @author Michał Mańko <github@michalmanko.com>
 */
abstract class HolidayFactory
{
    /**
     * Registered providers.
     *
     * @var array
     */
    protected static $providers = array(
        'PL' => 'Poland',
        'DK' => 'Denmark',
        'GER' => 'Germany',
        'GER_BB' => 'GermanyBB',
        'GER_BE' => 'GermanyBE',
        'GER_BW' => 'GermanyBW',
        'GER_BY' => 'GermanyBY',
        'GER_HB' => 'GermanyHB',
        'GER_HE' => 'GermanyHE',
        'GER_HH' => 'GermanyHH',
        'GER_MV' => 'GermanyMV',
        'GER_NI' => 'GermanyNI',
        'GER_NW' => 'GermanyNW',
        'GER_RP' => 'GermanyRP',
        'GER_SH' => 'GermanySH',
        'GER_SL' => 'GermanySL',
        'GER_SN' => 'GermanySN',
        'GER_ST' => 'GermanyST',
        'GER_TH' => 'GermanyTH',
    );

    /**
     * Returns array with registered providers.
     *
     * @return array
     */
    public static function getProviders()
    {
        return static::$providers;
    }

    /**
     * Registers a holidays provider class.
     *
     * @param string $countryCode       Country code
     * @param string $providerClassName Provider class name
     */
    public static function registerProvider($countryCode, $providerClassName)
    {
        $countryCode       = strtoupper($countryCode);
        $providerClassName = (string) $providerClassName;

        static::$providers[$countryCode] = $providerClassName;
    }

    /**
     * Unregisters a holidays provider class.
     *
     * @param string $providerClassName Country code of the provider or the provider class name
     *
     * @return bool
     */
    public static function unregisterProvider($providerClassName)
    {
        if (array_key_exists(strtoupper($providerClassName), static::$providers)) {
            unset(static::$providers[strtoupper($providerClassName)]);

            return true;
        }

        $index = array_search((string) $providerClassName, static::$providers, true);
        if ($index !== false) {
            unset(static::$providers[$index]);

            return true;
        }

        return false;
    }

    /**
     * Creates a holidays provider based on $countryCode code.
     *
     * @param string            $countryCode ISO Country Code, County Name or provider class name
     * @param null|DateTimeZone $timezone    (optional) Time zone
     *
     * @throws InvalidArgumentException
     *
     * @return Provider\AbstractProvider
     */
    public static function createProvider($countryCode, DateTimeZone $timezone = null)
    {
        // Use the supplied provider class
        if (substr($countryCode, 0, 1) == '\\') {
            $className = $countryCode;
        } elseif (array_key_exists(strtoupper($countryCode), static::$providers)) {
            $countryCode = strtoupper($countryCode);
            if (substr(static::$providers[$countryCode], 0, 1) == '\\') {
                $className = static::$providers[$countryCode];
            } else {
                $className = '\\' . __NAMESPACE__ . '\\Provider\\'
                    . static::$providers[$countryCode];
            }
        } else {
            $className = '\\' . __NAMESPACE__ . '\\Provider\\' . $countryCode;
        }

        if (!class_exists($className)) {
            throw new InvalidArgumentException(sprintf(
                'Cannot find Holiday provider class "%s"',
                $className
            ));
        }

        $provider = new $className($timezone);

        if (!$provider instanceof Provider\AbstractProvider) {
            throw new InvalidArgumentException(sprintf(
                'Class "%s" must be an instance of '
                . '\\Michalmanko\\Holiday\\Provider\\AbstractProvider',
                $className
            ));
        }

        return $provider;
    }
}
