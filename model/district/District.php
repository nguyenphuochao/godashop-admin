<?php
class District
{
    protected $id;
    protected $name;
    protected $type;
    protected $province_id;

    function __construct($id, $name, $type, $province_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->province_id = $province_id;
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
    function getProvinceID()
    {
        return $this->province_id;
    }

    // ------ RelationShop
    // BelongsTo province
    function getProvince()
    {
        $provinceRepository = new ProvinceRepository();
        $province = $provinceRepository->find($this->province_id);
        return $province;
    }
}
