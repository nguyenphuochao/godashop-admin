<?php
$customer_shipping_name = '';
$customer_shipping_mobile = '';
$customer_province_id = '';
$customer_district_id = '';
$customer_ward_id = '';
$districts = array(); // set default districts để tránh bị undifined
$wards = array(); // set default wards để tránh bị undifined
// trường hợp nếu chọn khách hàng đã có ward_id
if (!empty($customer)) {
    $customer_shipping_name = $customer->getShippingName();
    $customer_shipping_mobile = $customer->getShippingMobile();
    $customer_ward = $customer->getWard();
    if (!empty($customer_ward)) {
        $customer_district = $customer_ward->getDistrict(); // lấy dc quận/huyện
        $customer_province = $customer_district->getProvince(); // lấy dc tỉnh/thành phố
        $districts = $customer_province->getDistricts(); // từ tỉnh lấy danh sách quận/huyện
        $wards = $customer_district->getWards(); // từ quận lấy danh sách phường/xã

        $customer_province_id = $customer_province->getID();
        $customer_district_id = $customer_district->getID();
        $customer_ward_id = $customer_ward->getID();
    }
}
