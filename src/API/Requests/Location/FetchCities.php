<?php

namespace ExtremeSa\Aramex\API\Requests\Location;

use ExtremeSa\Aramex\API\Interfaces\Normalize;
use ExtremeSa\Aramex\API\Response\Location\CitiesFetchingResponse;

/**
 * This method allows users to get all the cities within a certain country (country code).
 * And allows users to get list of the cities that start with a specific prefix.
 * The required nodes to be filled are Client Info and Country Code.
 *
 * Class FetchCities
 * @package ExtremeSa\Aramex\API\Requests\Location
 */
class FetchCities extends LocationAbstract implements Normalize
{
    private $countryCode;
    private $state;
    private $nameStartsWith;

    /**
     * @return CitiesFetchingResponse
     * @throws \Exception
     */
    public function run()
    {
        $this->validate();

        return CitiesFetchingResponse::make($this->soapClient->FetchCities($this->normalize()));
    }

    /**
     * @return string
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return FetchCities
     */
    public function setCountryCode(string $countryCode): FetchCities
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     * @return FetchCities
     */
    public function setState(?string $state): FetchCities
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNameStartsWith(): ?string
    {
        return $this->nameStartsWith;
    }

    /**
     * @param string|null $nameStartsWith
     * @return FetchCities
     */
    public function setNameStartsWith(?string $nameStartsWith): FetchCities
    {
        $this->nameStartsWith = $nameStartsWith;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'CountryCode' => $this->getCountryCode(),
            'State' => $this->getState(),
            'NameStartsWith' => $this->getNameStartsWith(),
        ], parent::normalize());
    }
}