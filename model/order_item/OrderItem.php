<?php
class OrderItem
{

    // Khởi tạo các thuộc tính
    protected $product_id;
    protected $order_id;
    protected $qty;
    protected $unit_price;
    protected $total_price;

    // Hàm autoload khởi tạo đối tượng
    function __construct($product_id, $order_id, $qty, $unit_price, $total_price)
    {
        $this->product_id = $product_id;
        $this->order_id = $order_id;
        $this->qty = $qty;
        $this->unit_price = $unit_price;
        $this->total_price = $total_price;
    }

    // Lấy giá trị thuộc tính
    function getProductID()
    {
        return $this->product_id;
    }
    function getOrderID()
    {
        return $this->order_id;
    }
    function getQty()
    {
        return $this->qty;
    }
    function getUnitPrice()
    {
        return $this->unit_price;
    }
    function getTotalPrice()
    {
        return $this->total_price;
    }

    // gán giá trị thuộc tính
    function setProductID($product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }
    function setOrderID($order_id)
    {
        $this->order_id = $order_id;
        return $this;
    }
    function setQty($qty)
    {
        $this->qty = $qty;
        return $this;
    }
    function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;
        return $this;
    }
    function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
        return $this;
    }

    // -------- RelationShip
    // BelongsTo product
    function getProduct()
    {
        $productRepository = new ProductRepository();
        $product = $productRepository->find($this->product_id);
        return $product;
    }
}
