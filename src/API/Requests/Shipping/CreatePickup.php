<?php

namespace ExtremeSa\Aramex\API\Requests\Shipping;

use Exception;
use ExtremeSa\Aramex\API\Classes\LabelInfo;
use ExtremeSa\Aramex\API\Classes\Pickup;
use ExtremeSa\Aramex\API\Interfaces\Normalize;
use ExtremeSa\Aramex\API\Response\Shipping\PickupCreationResponse;

/**
 * This method allows users to create a pickup request.
 * The nodes required to be filled are as follows: ClientInfo and Pickup.
 *
 * Class PickupCreation
 * @package ExtremeSa\Aramex\API\Requests
 */
class CreatePickup extends ShippingAbstract implements Normalize
{
    private $pickup;
    private $labelInfo;

    /**
     * @return PickupCreationResponse
     * @throws Exception
     */
    public function run(): PickupCreationResponse
    {
        $this->validate();

        return PickupCreationResponse::make($this->soapClient->CreatePickup($this->normalize()));
    }

    /**
     * @return Pickup
     */
    public function getPickup()
    {
        return $this->pickup;
    }

    /**
     * @param Pickup $pickup
     * @return CreatePickup
     */
    public function setPickup(Pickup $pickup): CreatePickup
    {
        $this->pickup = $pickup;
        return $this;
    }

    /**
     * @return LabelInfo|null
     */
    public function getLabelInfo()
    {
        return $this->labelInfo;
    }

    /**
     * @param LabelInfo $labelInfo
     * @return CreatePickup
     */
    public function setLabelInfo(LabelInfo $labelInfo): CreatePickup
    {
        $this->labelInfo = $labelInfo;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'Pickup' => $this->getPickup()->normalize(),
            'LabelInfo' => optional($this->getLabelInfo())->normalize(),
        ], parent::normalize());
    }
}