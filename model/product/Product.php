<?php
class Product
{
    protected $id;
    protected $barcode;
    protected $sku;
    protected $name;
    protected $price;
    protected $discount_percentage;
    protected $discount_from_date;
    protected $discount_to_date;
    protected $featured_image;
    protected $inventory_qty;
    protected $category_id;
    protected $brand_id;
    protected $created_date;
    protected $description;
    protected $star;
    protected $featured;
    protected $sale_price;

    function __construct(
        $id,
        $barcode,
        $sku,
        $name,
        $price,
        $discount_percentage,
        $discount_from_date,
        $discount_to_date,
        $featured_image,
        $inventory_qty,
        $category_id,
        $brand_id,
        $created_date,
        $description,
        $star,
        $featured,
        $sale_price
    ) {
        $this->id = $id;
        $this->barcode = $barcode;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->discount_percentage = $discount_percentage;
        $this->discount_from_date = $discount_from_date;
        $this->discount_to_date = $discount_to_date;
        $this->featured_image = $featured_image;
        $this->inventory_qty = $inventory_qty;
        $this->category_id = $category_id;
        $this->brand_id = $brand_id;
        $this->created_date = $created_date;
        $this->description = $description;
        $this->star = $star;
        $this->featured = $featured;
        $this->sale_price = $sale_price;
    }
    // Get giá trị của thuộc tính
    function getID()
    {
        return $this->id;
    }
    function getBarCode()
    {
        return $this->barcode;
    }
    function getSKU()
    {
        return $this->sku;
    }
    function getName()
    {
        return $this->name;
    }
    function getPrice()
    {
        return $this->price;
    }
    function getDiscountPercentage()
    {
        return $this->discount_percentage;
    }
    function getDiscountFromDate()
    {
        return $this->discount_from_date;
    }
    function getDiscountToDate()
    {
        return $this->discount_to_date;
    }
    function getFeaturedImage()
    {
        return $this->featured_image;
    }
    function getInventoryQty()
    {
        return $this->inventory_qty;
    }
    function getCategoryID()
    {
        return $this->category_id;
    }
    function getBrandID()
    {
        return $this->brand_id;
    }
    function getCreatedDate()
    {
        return $this->created_date;
    }
    function getDescription()
    {
        return $this->description;
    }
    function getStar()
    {
        return $this->star;
    }
    function getFeatured()
    {
        return $this->featured;
    }
    function getSalePrice()
    {
        return $this->sale_price;
    }
    // Set giá trị cho thuộc tính
    function setBarCode($barcode)
    {
        $this->barcode = $barcode;
        return $this;
    }
    function setSKU($sku)
    {
        $this->sku = $sku;
        return $this;
    }
    function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    function setDiscountPercentage($discount_percentage)
    {
        $this->discount_percentage = $discount_percentage;
        return $this;
    }
    function setDiscountFromDate($discount_from_date)
    {
        $this->discount_from_date = $discount_from_date;
        return $this;
    }
    function setDiscountToDate($discount_to_date)
    {
        $this->discount_to_date = $discount_to_date;
        return $this;
    }
    function setFeaturedImage($featured_image)
    {
        $this->featured_image = $featured_image;
        return $this;
    }
    function setInventoryQty($inventory_qty)
    {
        $this->inventory_qty = $inventory_qty;
        return $this;
    }
    function setCategoryID($category_id)
    {
        $this->category_id = $category_id;
        return $this;
    }
    function setBrandID($brand_id)
    {
        $this->brand_id = $brand_id;
        return $this;
    }
    function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
        return $this;
    }
    function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    function setStar($star)
    {
        $this->star = $star;
        return $this;
    }
    function setFeatured($featured)
    {
        $this->featured = $featured;
        return $this;
    }

    // ------------- Relationship---------

    // belongsTo Category
    function getCategory()
    {
        $categoryRepository = new CategoryRepository();
        $category = $categoryRepository->find($this->category_id);
        return $category;
    }
    // belogsTo Brand
    function getBrand()
    {
        $brandRepository = new BrandRepository();
        $brand = $brandRepository->find($this->brand_id);
        return $brand;
    }
}
