<?php

namespace ExtremeSa\Aramex\API\Requests\Shipping;

use Exception;
use ExtremeSa\Aramex\API\Interfaces\Normalize;
use ExtremeSa\Aramex\API\Response\Shipping\LastReservedShipmentNumberRangeResponse;

/**
 * This method allows you to inquire about the last reserved range using a specific entity and product group
 *
 * Class LastReserveShipmentNumberRange
 * @package ExtremeSa\Aramex\API\Requests
 */
class GetLastShipmentsNumbersRange extends ShippingAbstract implements Normalize
{
    private $entity;
    private $productGroup;

    /**
     * @return LastReservedShipmentNumberRangeResponse
     * @throws Exception
     */
    public function run(): LastReservedShipmentNumberRangeResponse
    {
        $this->validate();

        return LastReservedShipmentNumberRangeResponse::make($this->soapClient->GetLastShipmentsNumbersRange($this->normalize()));
    }

    /**
     * @throws \Exception
     */
    protected function validate()
    {
        parent::validate();

        if (!$this->entity) {
            throw new \Exception('Entity Not Provided');
        }

        if (!$this->productGroup) {
            throw new \Exception('Product Group Not Provided');
        }
    }

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     * @param string $entity
     * @return GetLastShipmentsNumbersRange
     */
    public function setEntity(string $entity): GetLastShipmentsNumbersRange
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductGroup(): string
    {
        return $this->productGroup;
    }

    /**
     * @param string $productGroup
     * @return GetLastShipmentsNumbersRange
     */
    public function setProductGroup(string $productGroup): GetLastShipmentsNumbersRange
    {
        $this->productGroup = $productGroup;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'Entity' => $this->getEntity(),
            'ProductGroup' => $this->getProductGroup()
        ], parent::normalize());
    }
}