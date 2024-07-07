<?php
class Province
{
    protected $id;
    protected $name;
    protected $type;

    function __construct($id, $name, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    // get Attribute
    function getID()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }
    function getType()
    {
        return $this->type;
    }

    // -------------- Relationship

    // HasMany District
    function getDistricts()
    {
        $districtRepository = new DistrictRepository();
        $districts = $districtRepository->findProvince($this->id);
        return $districts;
    }

    // BelongsTo transport
    function getShippingFee()
    {
        $transportRepository = new TransportRepository();
        $transport = $transportRepository->findByProvinceID($this->id);
        $shipping_fee = $transport->getPrice();
        return $shipping_fee;
    }
}
