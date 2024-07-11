<!-- Province -->
<div class="col-sm-4">
    <select name="province" class="form-control province">
        <option value="">Tỉnh / thành phố</option>
        <?php foreach ($provinces as $province) : ?>
            <option <?= $customer_province_id == $province->getID() ? "selected" : "" ?> value="<?= $province->getID() ?>"><?= $province->getName(); ?></option>
        <?php endforeach; ?>
    </select>
</div>
<!-- District -->
<div class="col-sm-4">
    <select name="district" class="form-control district" required>
        <option value="">Quận / huyện</option>
        <?php foreach ($districts as $district) : ?>
            <option <?= $customer_district_id == $district->getID() ? "selected" : "" ?> value="<?= $district->getID() ?>"><?= $district->getName() ?></option>
        <?php endforeach; ?>
    </select>
</div>
<!-- Ward -->
<div class="col-sm-4">
    <select name="ward" class="form-control ward">
        <option value="">Phường / xã</option>
        <?php foreach ($wards as $ward) : ?>
            <option <?= $customer_ward_id == $ward->getID() ? "selected" : "" ?> value="<?= $ward->getID() ?>"><?= $ward->getName() ?></option>
        <?php endforeach; ?>
    </select>
</div>
