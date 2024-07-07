<?php
class AddressController
{
    function getProvinces()
    {
        $provinceRepository = new ProvinceRepository();
        $provinces = $provinceRepository->getAll();
        echo json_encode($this->convertToAssociativeArray($provinces));
    }

    function getDistricts()
    {
        $province_id = $_GET["province_id"];
        $districtRepository = new DistrictRepository();
        $districts = $districtRepository->findProvince($province_id);
        echo json_encode($this->convertToAssociativeArray($districts));
    }

    function getWards()
    {
        $district_id = $_GET["district_id"];
        $wardRepository = new WardRepository();
        $wards = $wardRepository->findDistrict($district_id);
        echo json_encode($this->convertToAssociativeArray($wards));
    }

    // hàm chuyển đổi sang mảng kết hợp
    function convertToAssociativeArray($objects)
    {
        $array = [];
        foreach ($objects as $object) {
            $array[] = array("id" => $object->getID(), "name" => $object->getName());
        }
        return $array;
    }

    function getShippingFee()
    {
        $province_id = $_GET["province_id"];
        $provinceRepository = new ProvinceRepository();
        $province = $provinceRepository->find($province_id);
        echo $province->getShippingFee();
    }
}
