
function deleteObject(self, event, confirm_message, url, data) {
	event.preventDefault();
	if (!confirm(confirm_message)) {
		return;
	}

	$.ajax({
		url: url,
		data: data,
	})
		.done(function (response) {
			var rs = JSON.parse(response);
			var can_delete = rs.can_delete;//data chứa 0 hoặc 1
			if (can_delete == 1) {
				var href = $(self).attr('href');
				window.location.href = href;
			} else {
				$(".error").html(rs.message);
				window.scrollTo({ top: 0, behavior: 'smooth' });
			}
		})
		.fail(function () {
			console.log("error");
		});
}

// load jquery sau khi tải xong trang html
$(function () {

	// xóa role
	$(".btn-delete-role").click(function (event) {
		var confirm_message = 'Bạn có muốn xóa vai trò này không?';
		var url = "index.php?c=permission&a=checkDeleteRole";
		var role_id = $(this).attr('data');
		var data = {
			role_id: role_id
		}
		deleteObject(this, event, confirm_message, url, data);
	});

	// xóa category
	$(".btn-delete-cat").click(function (event) {
		var confirm_message = 'Bạn có muốn xóa danh mục này không?';
		var url = "index.php?c=category&a=checkDelete";
		var category_id = $(this).attr('data');
		var data = {
			category_id: category_id
		}
		deleteObject(this, event, confirm_message, url, data);
	});

	// xóa brand
	$(".btn-delete-brand").click(function (event) {
		var confirm_message = 'Bạn có muốn xóa nhãn hiệu này không?';
		var url = "index.php?c=brand&a=checkDelete";
		var brand_id = $(this).attr('data');
		var data = {
			brand_id: brand_id
		}
		deleteObject(this, event, confirm_message, url, data);
	});

	// xóa product
	$(".btn-delete-product").click(function (event) {
		var confirm_message = 'Bạn có muốn xóa sản phẩm này không?';
		var url = "index.php?c=product&a=checkDelete";
		var product_id = $(this).attr('data');
		var data = {
			product_id: product_id
		}
		deleteObject(this, event, confirm_message, url, data);
	});

	// Xóa nhiều
	$("#delete").parents("form").submit(function (event) {
		event.preventDefault();
		if (!confirm("Bạn muốn xóa phải không?")) {
			return false;
		}
		var type = 'GET';
		var form_data = $(this).serialize();
		var c = getUrlParameter('c');
		var self = this;
		$.ajax({
			type: type,
			url: 'index.php?c=' + c + '&a=checkDeletes',
			data: form_data
		})
			.done(function (data) {
				var rs = JSON.parse(data);
				if (rs.can_delete == 1) {
					self.submit();
				} else {
					$(".error").html(rs.message);
					window.scrollTo({ top: 0, behavior: 'smooth' });
				}
			})
			.fail(function () {
				console.log("error");
			})
	});

	// thay đổi province(tỉnh/thành phố)
	$("#content-wrapper .province").change(function (event) {
		var province_id = $(this).val();
		if (!province_id) {
			updateSelectBox(null, "#content-wrapper .district");
			updateSelectBox(null, "#content-wrapper .ward");
		}
		$.ajax({
			type: "GET",
			url: "index.php?c=address&a=getDistricts",
			data: {
				province_id: province_id
			}
		})
			.done(function (data) {
				updateSelectBox(data, "#content-wrapper .district");
				updateSelectBox(null, "#content-wrapper .ward");
			})
		// update lun cái shipping fee tương ứng với tỉnh/thành phố
		if ($("#content-wrapper .shipping-fee").length) {
			$.ajax({
				type: "GET",
				url: "index.php?c=address&a=getShippingFee",
				data: {
					province_id: province_id
				}
			})
				.done(function (data) {
					// update shipping fee and total on UI
					var shipping_fee = data;
					updateShippingFee(shipping_fee);
				});
		}
	});

	// thay đổi quận/ huyện
	$("#content-wrapper .district").change(function (event) {
		var district_id = $(this).val();
		if (!district_id) {
			updateSelectBox(null, "#content-wrapper .ward");
			return;
		}
		$.ajax({
			type: "GET",
			url: "index.php?c=address&a=getWards",
			data: {
				district_id: district_id
			}
		})
			.done(function (data) {
				updateSelectBox(data, "#content-wrapper .ward");
			});
	});

	// thay đổi customer
	$(".chosen-customer").change(function (event) {
		$(".shipping-name").val('');
		$(".shipping-mobile").val('');
		updateSelectBox(null, ".province");
		updateSelectBox(null, ".district");
		updateSelectBox(null, ".ward");
		$(".hoursenmber-street").val('');
		var customer_id = $(this).val();
		// nếu chọn khách hàng mới thì dừng tiến trình
		if (!customer_id) {
			updateShippingFee(0);
			return;
		}
		// thực hiện ajax lấy thông tin khách hàng
		$.ajax({
			url: "index.php?c=order&a=ajaxGetShippingInfoDefault",
			data: {
				customer_id: customer_id
			}
		})
			.done(function (data) {
				data = JSON.parse(data);
				$(".shipping-name").val(data.shipping_name);
				$(".shipping-mobile").val(data.shipping_mobile);

				updateSelectBox(JSON.stringify(data.provinces), ".province", data.selected_province_id);
				updateSelectBox(JSON.stringify(data.districts), ".district", data.selected_district_id);
				updateSelectBox(JSON.stringify(data.wards), ".ward", data.selected_ward_id);
				$(".housenumber-street").val(data.housenumber_street);

				if (data.selected_province_id) {
					updateShippingFeeAjax(data.selected_province_id);
				}
			})
			.fail(function () {
				console.log("error");
			});
	});





	// ngăn chặn sự kiện enter
	$("#search-barcode").keydown(function (event) {
		if (event.keyCode == 13) {
			event.preventDefault();
		}
	});

	// search by enter
	$("#search-barcode").keyup(function (event) {
		var barcode = $(this).val();
		if (!barcode) {
			return;
		}

		// nhấn enter
		if (event.keyCode == 13) {
			$.ajax({
				type: "GET",
				url: "index.php?c=product&a=findBarCode",
				data: {
					barcode: barcode
				},
				success: function (data) {
					// error product
					if (!data) {
						alert('Không tìm thấy sản phẩm');
						return;
					}
					// success product
					$("#search-barcode").val(''); // clear input
					var product = JSON.parse(data); // chuyển chuỗi json thành object
					// Nếu tồn tại barcode trong bảng rồi thì tăng số lượng lên 1
					var tds = $(".product-item tbody tr td:first-child"); // chứa barcode
					for (var i = 0; i <= tds.length - 1; i++) {
						var td = tds[i];
						var barcode_in_table = $(td).html();
						if (barcode_in_table == product.barcode) {
							// tăng số lượng lên 1
							input_obj = $(td).parent().find('input[type=number]');
							var current_val = $(input_obj).val();
							$(input_obj).val(Number(current_val) + 1);
							updateQty(input_obj);
							return;
						}
					}

					// Thêm mới sản phẩm vào bảng
					var str_price = '';
					if (product.sale_price != product.price) {
						str_price = `<del>${number_format(product.price)}đ</del> `;
					}
					str_price += number_format(product.sale_price) + 'đ';
					var tr = `<tr>
									<td>${product.barcode}</td>
									<td>
										${product.name}
										<input type="hidden" name="product_id[]" value="${product.id}">
									</td>
									<td>
										<img src="../uploads/${product.feature_image}"">
									</td>
									<td>${str_price}</td>
									<td>
										<input type="number" name="qties[]" data="${product.sale_price}" value="1" min="1" onchange="updateQty(this)">
									</td>
									<td>
										${number_format(product.sale_price)}đ
									<td>
										<button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">X</button>
									</td>
							 </tr>`;
					$(".product-item").append(tr);
					updatePaymentTotal();
				},
				error: function () {
					console.log('error');
				}
			});
		}

	});
});

// -------------các hàm xử lí----------------

function checkAll(check_all) {
	$(check_all).change(function () {
		var checkboxes = $(this).closest('table').find(':checkbox');
		checkboxes.prop('checked', $(this).is(':checked'));
	});
}

// hàm update select box
function updateSelectBox(data, selector, selected_id = null) {
	var items = JSON.parse(data);
	$(selector).find("option").not(':first').remove(); // xóa hết option trừ option đầu tiên
	if (!data) return;
	for (let i = 0; i < items.length; i++) {
		let item = items[i];
		selected = '';
		if (selected_id == item.id) {
			selected = 'selected';
		}
		let option = '<option ' + selected + ' value="' + item.id + '">' + item.name + '</option>';
		$(selector).append(option);
	}
}

function updateSubTotal() {
	var inputs = $(".product-item tbody input[type=number]");
	var sub_total = 0;
	for (var i = 0; i <= inputs.length - 1; i++) {
		var input = inputs[i];
		var sale_price = $(input).attr("data");
		var qty = $(input).val();
		sub_total += sale_price * qty;
	}
	var format_sub_total = number_format(sub_total) + "đ";
	$(".sub-total").html(format_sub_total);
	$(".sub-total").attr("data", sub_total);
}

function updatePaymentTotal() {
	updateSubTotal();
	var shipping_fee = $("#content-wrapper .shipping-fee").val();
	var sub_total = $("#content-wrapper .sub-total").attr("data");
	var payment_total = Number(shipping_fee) + Number(sub_total);
	$("#content-wrapper .payment-total").html(number_format(payment_total) + "đ");
}

function updateQty(self) {
	var salse_price = $(self).attr('data');
	var qty = $(self).val();
	var total = salse_price * qty;
	var format_total = number_format(total) + 'đ';
	$(self).parent().next().html(format_total);
	updatePaymentTotal();
}

function deleteRow(self) {
	var row = $(self).parent().parent();
	$(row).remove();
	updatePaymentTotal();
}

function updateShippingFee(shipping_fee) {
	shipping_fee = Number(shipping_fee);
	$("input[name=shipping_fee]").val(shipping_fee);
	updatePaymentTotal();
}

function updateShippingFeeAjax(province_id) {
	$.ajax({
		url: 'index.php?c=address&a=getShippingFee',
		data: { province_id: province_id },
	})
		.done(function (data) {
			var shipping_fee = data;
			updateShippingFee(shipping_fee);
		})
		.fail(function () {
			console.log("error");
		});

}

var loadFile = function (event) {
	var image = document.getElementById('image');
	image.src = URL.createObjectURL(event.target.files[0]);
};

var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		}
	}
};

var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		}
	}
};

