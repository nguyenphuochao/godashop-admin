
$(function () {
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

function checkAll(check_all) {
	$(check_all).change(function () {
		var checkboxes = $(this).closest('table').find(':checkbox');
		checkboxes.prop('checked', $(this).is(':checked'));
	});
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

function updateShippingFee(shipping_fee){
	shipping_fee = Number(shipping_fee);
	$("input[name=shipping_fee]").val(shipping_fee);
	updatePaymentTotal();
}

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

