<?php
class Ward
{
    protected $id;
    protected $name;
    protected $type;
    protected $district_id;

    function __construct($id, $name, $type, $district_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->district_id = $district_id;
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
    function getDistrictID()
    {
        return $this->district_id;
    }

    // ------ RelationShip
    // BelongsTo district
    function getDistrict()
    {
        $districtRepository = new DistrictRepository();
        $district = $districtRepository->find($this->district_id);
        return $district;
    }
}
