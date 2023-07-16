$(document).ready(function () {
	$(document).on('click', '.sellUpdate', function () {
		$('#saleModal').find("input,textarea,select").val('');
		$("#saleModalTitle").text(langUpdateButton+" "+langSale);
		$("#saleId").val($(this).data('sellid'));
		$("#salePId").val($(this).data('productid'));
		$.ajax({
			url: baseUrl+'SaleProduct/validateUpdateSale',
			type: 'POST',
			dataType: 'json',
			data: {
				saleId: $(this).data('sellid'),
				productId: $(this).data('productid'),
			},
			success: function (data) {
				if(data.status) {
					$("#salePName").val(data.productResult[0]['productname']);
					$("#salePUnit").val(data.productResult[0]['unit']);
					$("#salePRemaining").val(parseInt(data.productResult[0]['remaining'])+parseInt(data.saleResult[0]['quantity']));
					$("#salePQuantity").attr('max', parseInt(data.productResult[0]['remaining'])+parseInt(data.saleResult[0]['quantity']));
					$("#salePPrice").val(data.productResult[0]['price']);
					$('#salePEPrice').val('0');
					$('#salePQuantity').val(data.saleResult[0]['quantity']);
					$('#salePDiscount').val(data.saleResult[0]['discount']);
					$('#salePComment').val(data.saleResult[0]['comments']);
					$('#saleModal').modal('toggle');
				} else {
					$("#saleMessage").text(data.message);
					$("#saleMessage").show("slow").delay(3000).fadeOut("slow");
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				$("#saleMessage").text('Status: '+textStatus+'   Error: '+errorThrown+' ');
				$("#saleMessage").show("slow").delay(3000).fadeOut("slow");
			}
		});

	});

	$(document).on('click', '.sellDelete', function () {
		$('#deleteSaleModal').find("input,textarea,select").val('');
		$("#deleteSaleProductId").val($(this).data('productid'));
		$("#deleteSaleId").val($(this).data('sellid'));
		$('#deleteSaleModal').modal('toggle');
	});

	$(document).on('click', '.returnProduct', function () {
		$('#returnPModal').find("input,textarea,select").val('');
		$("#returnPId").val($(this).data('productid'));
		$("#returnSalePId").val($(this).data('sellid'));
		$("#returnSalePName").val($("#returnProductName"+$(this).data('sellid')).text());
		$("#returnSalePQuantity").attr('max', $("#returnQuantityMax"+$(this).data('sellid')).text());
		$("#maxSaleQuantity").val($("#returnQuantityMax"+$(this).data('sellid')).text());
		$('#returnPModal').modal('toggle');
	});

	$(document).on('click', '.sellProduct', function () {
		$('#billModal').find("input,textarea,select").val('');
		$("#saleModalTitle").text(langSale+" "+langProducts);
		$("#saleId").val('');
		$("#salePId").val($(this).data('productid'));
		$("#salePName").val($("#productRow"+$(this).data('productid')).find($(".editableProductName")).text());
		$("#salePUnit").val($("#editableProductUnit"+$(this).data('productid')).val());
		$("#salePRemaining").val($("#editableProductRemaining"+$(this).data('productid')).text());
		$("#salePQuantity").attr('max', $("#editableProductRemaining"+$(this).data('productid')).text());
		$("#salePPrice").val($("#productRow"+$(this).data('productid')).find($(".editableProductPrice")).text());
		$('#salePEPrice').val('0');
		$('#saleModal').modal('toggle');
	});

	$(document).on('input', '#salePQuantity', function () {
		let per = 100 - $("#salePDiscount").val();
		$("#salePEPrice").val((per/100)*$("#salePQuantity").val()*$("#salePPrice").val());
	});

	$(document).on('input', '#salePDiscount', function () {
		let per = 100 - $("#salePDiscount").val();
		$("#salePEPrice").val((per/100)*$("#salePQuantity").val()*$("#salePPrice").val());
	});
});
