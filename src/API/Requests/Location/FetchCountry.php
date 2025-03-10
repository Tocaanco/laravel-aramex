<?php

namespace ExtremeSa\Aramex\API\Requests\Location;

use Exception;
use ExtremeSa\Aramex\API\Interfaces\Normalize;
use ExtremeSa\Aramex\API\Response\Location\CountryFetchingResponse;

/**
 * This method allows users to get details of a certain country.
 *
 * Class FetchCountry
 * @package ExtremeSa\Aramex\API\Requests\Location
 */
class FetchCountry extends LocationAbstract implements Normalize
{
    private $code;

    /**
     * @return CountryFetchingResponse
     * @throws Exception
     */
    public function run()
    {
        $this->validate();

        return CountryFetchingResponse::make($this->soapClient->FetchCountry($this->normalize()));
    }

    protected function validate()
    {
        parent::validate();

        if (!$this->code) {
            throw new Exception('Should provide country code!');
        }
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return FetchCountry
     */
    public function setCode(string $code): FetchCountry
    {
        $this->code = $code;
        return $this;
    }


    public function normalize(): array
    {
        return array_merge([
            'Code' => $this->getCode()
        ], parent::normalize());
    }
}