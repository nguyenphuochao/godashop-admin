<?php require "layout/header.php" ?>
<style>
    font,.error {
        color: red;
    }
    #img_url {
    background: #ddd;
    width: 200px;
    height: 150px;
    display: block;
    }
</style>
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Quản lý</a>
            </li>
            <li class="breadcrumb-item active">Sản phẩm</li>
        </ol>
        <!-- /form -->
        <form method="post" action="index.php?c=product&a=store" enctype="multipart/form-data" id="form-add">
            <!-- Barcode -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="barcode">Barcode <font>*</font></label>

                <div class="col-md-9 col-lg-6">
                    <input name="barcode" id="barcode" type="text" class="form-control">
                </div>
            </div>
            <!-- SKU -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="sku">SKU <font>*</font></label>
                <div class="col-md-9 col-lg-6">
                    <input name="sku" id="sku" type="text" class="form-control">
                </div>
            </div>
            <!-- Name -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="name">Tên <font>*</font></label>
                <div class="col-md-9 col-lg-6">
                    <input name="name" id="name" type="text" class="form-control">
                </div>
            </div>
            <!-- Feature_image -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="name">Hình đại diện</label>
                <div class="col-md-9 col-lg-6">
                    <img src="" id="img_url" alt="your image">
                    <br>
                    <input name="image" type="file" id="img_file" onChange="img_pathUrl(this);">
                </div>
            </div>
            <!-- Price -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="price">Giá <font>*</font></label>
                <div class="col-md-9 col-lg-6">
                    <input name="price" id="price" type="text" class="form-control">
                </div>
            </div>
            <!-- discount_percentage -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="discount_percentage">% Giảm giá</label>
                <div class="col-md-9 col-lg-6">
                    <input name="discount_percentage" id="discount_percentage" value="0" type="text" class="form-control">
                </div>
            </div>
            <!-- discount_from_date -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="discount_from_date">Giảm giá từ</label>
                <div class="col-md-9 col-lg-6">
                    <input name="discount_from_date" id="discount_from_date" type="date" class="form-control">
                </div>
            </div>
            <!-- discount_to_date -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="discount_to_date">Giảm giá đến</label>
                <div class="col-md-9 col-lg-6">
                    <input name="discount_to_date" id="discount_to_date" type="date" class="form-control">
                </div>
            </div>
            <!-- inventory_qty -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="inventory_qty">Lượng tồn <font>*</font></label>
                <div class="col-md-9 col-lg-6">
                    <input name="inventory_qty" id="inventory_qty" type="text" class="form-control">
                </div>
            </div>
            <!-- category_id -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="category">Danh mục <font>*</font></label>
                <div class="col-md-9 col-lg-6">
                    <select name="category_id" id="category_id" class="form-control">
                        <option value=""></option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->getID() ?>"><?= $category->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- brand_id -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="brand">Nhãn hàng <font>*</font></label>
                <div class="col-md-9 col-lg-6">
                    <select name="brand_id" id="brand_id" class="form-control">
                        <option value=""></option>
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?= $brand->getID(); ?>"><?= $brand->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- description -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="description">Mô tả</label>
                <div class="col-md-12">
                    <textarea name="description" id="description" rows="10" cols="80"></textarea>
                </div>
            </div>
            <!-- featured -->
            <div class="form-group row">
                <label class="col-md-12 control-label" for="description">Nổi bật
                    <input name="featured" type="checkbox" value="1">
                </label>
            </div>
            <!-- Action -->
            <div class="form-action text-left mb-2">
                <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
                <a href="index.php?c=product" class="btn btn-warning btn-sm">Quay về</a>
            </div>
        </form>
        <script type="text/javascript" src="../public/vendor/ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('description');
        </script>
<?php require "layout/footer.php" ?>

<script>

    // Load image in html
    function img_pathUrl(input){
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }

    // form validate
    $("#form-add").validate({
        rules: {
            barcode: "required",
            sku: "required",
            name: "required",
            price: "required",
            discount_from_date: {
                required: function(element) {
                    var discount = $("#discount_percentage").val();
                    return discount > 0;
                }
            },
            discount_to_date: {
                required: function(element) {
                    var discount = $("#discount_percentage").val();
                    return discount > 0;
                },
            },
            inventory_qty: "required",
            category_id: "required",
            brand_id: "required"
        },
        messages: {
            barcode: "Barcode không được để trống",
            sku: "SKU không được để trống",
            name: "Tên sản phẩm không được để trống",
            price: "Giá không được để trống",
            discount_from_date: "Giảm giá từ không được để trống",
            discount_to_date: "Giảm giá đến không được để trống",
            inventory_qty: "Lượng tồn kho không được để trống",
            category_id: "Vui lòng chọn tên danh mục",
            brand_id: "Vui lòng chọn tên nhãn hiệu"
        }
    });
</script>