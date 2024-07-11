<?php
// Khởi tạo lớp đối tượng 
class Customer
{
    // khởi tạo các thuộc tính
    protected $id;
    protected $name;
    protected $password;
    protected $mobile;
    protected $email;
    protected $login_by;
    protected $ward_id;
    protected $shipping_name;
    protected $shipping_mobile;
    protected $housenumber_street;
    protected $is_active;

    // Khởi tạo hàm khởi tạo autoload
    function __construct($id, $name, $password, $mobile, $email, $login_by, $ward_id, $shipping_name, $shipping_mobile, $housenumber_street, $is_active)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->login_by = $login_by;
        $this->ward_id = $ward_id;
        $this->shipping_name = $shipping_name;
        $this->shipping_mobile = $shipping_mobile;
        $this->housenumber_street = $housenumber_street;
        $this->is_active = $is_active;
    }

    // Lấy giá trị thuộc tính
    function getID()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getMobile()
    {
        return $this->mobile;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getLoginBy()
    {
        return $this->login_by;
    }
    function getWardID()
    {
        return $this->ward_id;
    }
    function getShippingName()
    {
        return $this->shipping_name;
    }
    function getShippingMobile()
    {
        return $this->shipping_mobile;
    }
    function getHousenumberStreet()
    {
        return $this->housenumber_street;
    }
    function getIsActive()
    {
        return $this->is_active;
    }

    // Gán giá trị thuộc tính
    function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }
    function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    function setLoginBy($login_by)
    {
        $this->login_by = $login_by;
        return $this;
    }
    function setWardID($ward_id)
    {
        $this->ward_id = $ward_id;
        return $this;
    }
    function setShippingName($shipping_name)
    {
        $this->shipping_name = $shipping_name;
        return $this;
    }
    function setShippingMobile($shipping_mobile)
    {
        $this->shipping_mobile = $shipping_mobile;
        return $this;
    }
    function setHousenumberStreet($housenumber_street)
    {
        $this->housenumber_street = $housenumber_street;
        return $this;
    }
    function setIsActive($is_active)
    {
        $this->is_active = $is_active;
        return $this;
    }

    function getWard()
    {
        if (empty($this->ward_id)) return null;
        $wardRepository = new WardRepository();
        $ward = $wardRepository->find($this->ward_id);
        return $ward;
    }

    function getAddress()
    {
        $address = "";
        if ($this->housenumber_street) {
            $address = $this->housenumber_street;
        }
        if ($this->ward_id) {
            $ward = $this->getWard()->getName();
            $district = $this->getWard()->getDistrict()->getName();
            $province = $this->getWard()->getDistrict()->getProvince()->getName();
            $address .= ", $ward, $district, $province";
        }
        return $address;
    }
}
