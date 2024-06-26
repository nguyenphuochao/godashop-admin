<?php
class Order
{
    protected $id;
    protected $created_date;
    protected $order_status_id;
    protected $staff_id;
    protected $customer_id;
    protected $shipping_fullname;
    protected $shipping_mobile;
    protected $payment_method;
    protected $shipping_ward_id;
    protected $shipping_housenumber_street;
    protected $shipping_fee;
    protected $delivered_date;

    function __construct($id, $created_date, $order_status_id, $staff_id, $customer_id, $shipping_fullname, $shipping_mobile, $payment_method, $shipping_ward_id, $shipping_housenumber_street, $shipping_fee, $delivered_date)
    {
        $this->id = $id;
        $this->created_date = $created_date;
        $this->order_status_id = $order_status_id;
        $this->staff_id = $staff_id;
        $this->customer_id = $customer_id;
        $this->shipping_fullname = $shipping_fullname;
        $this->shipping_mobile = $shipping_mobile;
        $this->payment_method = $payment_method;
        $this->shipping_ward_id = $shipping_ward_id;
        $this->shipping_housenumber_street = $shipping_housenumber_street;
        $this->shipping_fee = $shipping_fee;
        $this->delivered_date = $delivered_date;
    }
    // Get attribute
    function getID()
    {
        return $this->id;
    }
    function getCreatedDate()
    {
        return $this->created_date;
    }
    function getOrderStatusID()
    {
        return $this->order_status_id;
    }
    function getStaffID()
    {
        return $this->staff_id;
    }
    function getCustomerID()
    {
        return $this->customer_id;
    }
    function getShippingFullname()
    {
        return $this->shipping_fullname;
    }
    function getShippingMobile()
    {
        return $this->shipping_mobile;
    }
    function getPaymentMethod()
    {
        return $this->payment_method;
    }
    function getShippingWardID()
    {
        return $this->shipping_ward_id;
    }
    function getShippingHousenumberStreet()
    {
        return $this->shipping_housenumber_street;
    }
    function getShippingFee()
    {
        return $this->shipping_fee;
    }
    function getDeliveredDate()
    {
        return $this->delivered_date;
    }
    // Set attribute
    function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
    }
    function setOrderStatusID($order_status_id)
    {
        $this->order_status_id = $order_status_id;
    }
    function setStaffID($staff_id)
    {
        $this->staff_id = $staff_id;
    }
    function setCustomerID($customer_id)
    {
        $this->customer_id = $customer_id;
    }
    function setShippingFullname($shipping_fullname)
    {
        $this->shipping_fullname = $shipping_fullname;
    }
    function setShippingMobile($shipping_mobile)
    {
        $this->shipping_mobile = $shipping_mobile;
    }
    function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
    }
    function setShippingWardID($shipping_ward_id)
    {
        $this->shipping_ward_id = $shipping_ward_id;
    }
    function setShippingHousenumberStreet($shipping_housenumber_street)
    {
        $this->shipping_housenumber_street = $shipping_housenumber_street;
    }
    function setShippingFee($shipping_fee)
    {
        $this->shipping_fee = $shipping_fee;
    }
    function setDeliveredDate($delivered_date)
    {
        $this->delivered_date = $delivered_date;
    }

    // Hàm tính tạm tính tiền
    function getSubTotal()
    {
        $order_items = $this->getOrderItem();
        $sum = 0;
        foreach ($order_items as $order_item) {
            $sum += $order_item->getTotalPrice();
        }
        return $sum;
    }

    //----------- Relationshop here -------------
    // BelongsTo customer
    function getCustomer()
    {
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->find($this->customer_id);
        return $customer;
    }
    // HasMany order_item
    function getOrderItem()
    {
        $orderItemRepository = new OrderItemRepository();
        $order_items = $orderItemRepository->findOderID($this->id);
        return $order_items;
    }
    // BelongsTo staff
    function getStaff()
    {
        if (empty($this->staff_id)) {
            return null;
        }
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->find($this->staff_id);
        return $staff;
    }
    // BelongsTo status
    function getStatus()
    {
        $statusRepository = new StatusRepository();
        $status = $statusRepository->find($this->order_status_id);
        return $status;
    }
}
