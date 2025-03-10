<?php

namespace ExtremeSa\Aramex\API\Requests\Tracking;

use Exception;
use ExtremeSa\Aramex\API\Interfaces\Normalize;
use ExtremeSa\Aramex\API\Requests\API;
use ExtremeSa\Aramex\API\Response\Tracking\ShipmentTrackingResponse;

/**
 * This method allows the user to track an existing shipment’s updates and latest status.
 *
 * Class TrackShipments
 * @package ExtremeSa\Aramex\API\Requests\Tracking
 */
class TrackShipments extends API implements Normalize
{
    private $shipments;
    private $getLastTrackingUpdateOnly;

    public function __construct()
    {
        parent::__construct();
        $this->live_wsdl = $this->live_wsdl . '/ShippingAPI.V2/tracking/Service_1_0.svc?wsdl';
        $this->test_wsdl = $this->test_wsdl . '/ShippingAPI.V2/tracking/Service_1_0.svc?wsdl';
    }
    
    /**
     * @return ShipmentTrackingResponse
     * @throws Exception
     */
    public function run()
    {
        $this->validate();

        return ShipmentTrackingResponse::make($this->soapClient->TrackShipments($this->normalize()));
    }

    protected function validate()
    {
        parent::validate();

        if (!$this->shipments) {
            throw new Exception('Shipments are not provided');
        }
    }

    /**
     * @return bool
     */
    public function getGetLastTrackingUpdateOnly(): ?bool
    {
        return $this->getLastTrackingUpdateOnly;
    }

    /**
     * @param bool $getLastTrackingUpdateOnly
     * @return TrackShipments
     */
    public function setGetLastTrackingUpdateOnly(bool $getLastTrackingUpdateOnly = null): TrackShipments
    {
        $this->getLastTrackingUpdateOnly = $getLastTrackingUpdateOnly;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getShipments(): array
    {
        return $this->shipments;
    }

    /**
     * @param string[] $shipments
     * @return TrackShipments
     */
    public function setShipments(array $shipments): TrackShipments
    {
        $this->shipments = $shipments;
        return $this;
    }

    /**
     * @param string $shipment
     * @return TrackShipments
     */
    public function addShipment(string $shipment): TrackShipments
    {
        $this->shipments[] = $shipment;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'Shipments' => $this->getShipments(),
            'GetLastTrackingUpdateOnly' => $this->getGetLastTrackingUpdateOnly()
        ], parent::normalize());
    }

}