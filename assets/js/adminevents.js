$(document).ready(function () {
	var i = 0;
	var arr = [i];
	var productTotalPrice = '';
	var originalBillNumber;
	var checkUpdateQuantity = 1;

	$(document).on('input', '.detectQuantityInput', function () {
		if($('#submitBillButton').text() == updateBillButton) {
			var pId = $("#productId"+$(this).data('id')).val();
			var pQuantity = $(this).val();
			let dataId = $(this).data('id');
			if(pQuantity != '') {
				$.ajax({
					url: baseUrl+'SaleProduct/checkUpdateQuantity',
					type: 'POST',
					dataType: 'json',
					data: {
						productId: pId,
						checkUpdateQuantity: pQuantity,
					},
					success: function (data) {
						if(data.status) {
							$("#productQuantityError"+dataId).hide();
							checkUpdateQuantity = 1;
						} else {
							checkUpdateQuantity = 0;
							$("#productQuantityError"+dataId).text(data.statusMessage);
							$("#productQuantityError"+dataId).show();
						}
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						$("#createBillBackendError").text('Status: '+textStatus+'   Error: '+errorThrown+' ');
						$("#createBillBackendError").show("slow").delay(3000).fadeOut("slow");
					}
				});
			}
		}
	});

	$('#viewProfilePhoto').click(function () {
		$('#profileImagePreview').attr('src', $('#profileImage').attr('src'));
		$('#profileImgViewModal').modal('toggle');
	});

	$('#productRow').on('click', '.deleteProduct',  function() {
		$('#deleteProductId').val($(this).data('productid'));
		productTotalPrice = $(this).data('productprice');
		$('#deleteModal').modal('toggle');
	});

	$('#addNewProduct').click(function () {
		$('#billModalTitle').text(addMore+' '+products);
		$('#submitBillButton').text(addBillButton);
		$('#billModal').find("input,textarea,select").val('');
		$('#addProductBillId').val($(this).data('billid'));
		$('#billNumber').val($('#billDetailNumber').text());
		$('#billNumber').attr("readonly", true);
		$('#billComment').val($('#billDetailComment').text());
		$('#billComment').attr("readonly", true);
		$('#billModal').modal('toggle');
	});

	$('#productRow').on('click', '.updateProduct',  function() {
		let productId = $(this).data('productid');
		let billId = $('#addNewProduct').data("billid");
		productTotalPrice = $(this).data('productprice');
		if($(this).html() == langSaveButton) {
			let productName = $.trim($(this).parents('tr').find('td.editableProductName').text());
			let productQuantity = $.trim($(this).parents('tr').find('td.editableProductQuantity').text());
			let productPrice = $.trim($(this).parents('tr').find('td.editableProductPrice').text());
			let productUnit = $.trim($(this).parents('tr').find('td.editableProductUnit').find('option:selected').text());
			let productComments = $.trim($(this).parents('tr').find('td.editableProductComments').text());
			let productDescription = $.trim($(this).parents('tr').find('td.editableProductDescription').text());
			var isCorrect = 1;
			if (productName  === '') {
				isCorrect = 0;
				alert(langProductName+' '+LangIsEmpty);
			} else if(productQuantity  === '') {
				isCorrect = 0;
				alert(products+' '+langQuantity+' '+LangIsEmpty);
			} else if(!$.isNumeric(productQuantity)) {
				isCorrect = 0;
				alert(products+' '+langQuantity+' '+LangMustNumeric);
			} else if (productPrice  === '') {
				isCorrect = 0;
				alert(products+' '+langPrice+' '+LangIsEmpty);
			} else if(!$.isNumeric(productPrice)) {
				isCorrect = 0;
				alert(products+' '+langPrice+' '+LangMustNumeric);
			} else if (productUnit === '') {
				isCorrect = 0;
				alert(products+' '+langUnit+' '+LangIsEmpty);
			}
			if(isCorrect) {
				$.ajax({
					url: baseUrl+'admin/editProduct',
					type: 'POST',
					dataType: 'json',
					data: {
						billId: billId,
						productId: productId,
						productName: productName,
						productQuantity: productQuantity,
						productPrice: productPrice,
						productUnit: productUnit,
						productComments: productComments,
						productDescription: productDescription,
					},
					success: function (data) {
						if(data.status) {
							let totalPrice = $('#billDetailTotal').text();
							totalPrice = totalPrice - $('#editableProductTotal'+productId).text();
							totalPrice = totalPrice + data.totalPrice;
							$("#billDetailTotal").text(totalPrice);
							$('#productRow').find('#updatedAt'+productId).text(data.updatedAt);
							$('#editableProductRemaining'+productId).text(data.remaining);
							$('#editableProductTotal'+productId).text(data.totalPrice);
							$('[data-productid='+productId+']').each(function(){
								$(this).attr('data-productprice', data.totalPrice);
							});
							$("#pageLastUpdated").text(data.updatedAt);
							$("#billDetailUpdatedAt").text(data.updatedAt);
						}
						$("#billDetailMessage").text(data.statusMessage);
						$("#billDetailMessage").show("slow").delay(1000).fadeOut("slow");
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						$("#billDetailMessage").text('Status: '+textStatus+'   Error: '+errorThrown+' ');
						$("#billDetailMessage").show("slow").delay(3000).fadeOut("slow");
					}
				});
			}
		}

		let currentTD = $(this).parents('tr').find('td.editable');
		if ($(this).html() == updateBillButton) {
			$.each(currentTD, function () {
				$(this).prop('contenteditable', true);
			});
			$(this).parents('tr').find('select').prop("disabled", false);
			$(this).parents('tr').find('td.editable').first().focus();
		} else {
			if(isCorrect) {
				$.each(currentTD, function () {
					$(this).prop('contenteditable', false);
				});
				$(this).parents('tr').find('select').prop("disabled", true);
			}
		}
		if(isCorrect) {
			$(this).html($(this).html() == updateBillButton ? langSaveButton : updateBillButton)
		} else {
			$(this).html(langSaveButton);
		}

	});

	$('#billRow').on('click', '.deleteBill',  function() {
		$('#deleteBillId').val($(this).data('billid'));
		$('#deleteModal').modal('toggle');
	});

	$('#deleteBill').click(function () {
		let billId = '';
		let productId = '';
		if($.trim($("#deleteBillId").val()) !== '') {
			billId = $.trim($("#deleteBillId").val());
		} else if($.trim($("#deleteProductId").val()) !== '') {
			productId = $.trim($("#deleteProductId").val());
		}

		if(billId !== '') {
			$.ajax({
				url: baseUrl+'admin/deleteBill',
				type: 'POST',
				dataType: 'JSON',
				data: {deleteBillId: billId},
				success: function (data) {
					if(data.status) {
						let datatable = $('#dataTable').DataTable();
						datatable.row("#billRow"+billId).remove().draw();
					}
					$('#deleteModal').modal('toggle');
					$("#createBillMessage").text(data.statusMessage);
					$("#createBillMessage").show("slow").delay(1000).fadeOut("slow");
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					$("#createBillMessage").text('Status: '+textStatus+'   Error: '+errorThrown+' ');
					$('#deleteModal').modal('toggle');
					$("#createBillMessage").show("slow").delay(3000).fadeOut("slow");
				}
			});
		} else if(productId !== '') {
			$.ajax({
				url: baseUrl+'admin/deleteProduct',
				type: 'POST',
				dataType: 'JSON',
				data: {deleteProductId: productId},
				success: function (data) {
					if(data.status) {
						let datatable = $('#dataTable').DataTable();
						datatable.row("#productRow"+productId).remove().draw();
						let totalProducts = $('#billDetailProducts').text();
						totalProducts--;
						$("#billDetailProducts").text(totalProducts);
						let totalPrice = $('#billDetailTotal').text();
						totalPrice = totalPrice - productTotalPrice;
						$("#billDetailTotal").text(totalPrice);
					}
					$('#deleteModal').modal('toggle');
					$("#billDetailMessage").text(data.statusMessage);
					$("#billDetailMessage").show("slow").delay(1000).fadeOut("slow");
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					$("#billDetailMessage").text('Status: '+textStatus+'   Error: '+errorThrown+' ');
					$('#deleteModal').modal('toggle');
					$("#billDetailMessage").show("slow").delay(3000).fadeOut("slow");
				}
			});
		}

	});

	$('#billRow').on('click', '.updateBill',  function() {
		$('#billModalTitle').text(updateBill);
		$('#submitBillButton').text(updateBillButton);
		$('#billModal').find("input,textarea,select").val('');
		$("#addMoreProducts").hide();
		$('#addProductBillId').val($(this).data('billid'));
		let billId = $(this).data('billid');
		$.ajax({
			url: baseUrl+'admin/getAllProduct',
			type: 'POST',
			dataType: 'JSON',
			data: {billId: billId},
			success: function (data) {
				if(data.status) {
					originalBillNumber = data.billRow[0]['billnumber'];
					$('#billNumber').val(data.billRow[0]['billnumber']);
					$('#billComment').val(data.billRow[0]['comments']);
					$('#productId0').val(data.productRow[0]['id']);
					$('#productName0').val(data.productRow[0]['productname']);
					$('#productQuantity0').val(data.productRow[0]['quantity']);
					$('#productPrice0').val(data.productRow[0]['price']);
					$('#productUnit0').val(data.productRow[0]['unit']);
					$('#productComment0').val(data.productRow[0]['comments']);
					$('#productDescription0').val(data.productRow[0]['description']);

					if(data.productRow.length > 1) {
						for(var k = 0; k < data.productRow.length-1; k++) {
							arr.push(k+1);
							let addNewProductRow = '<div id="addNewProductsRow'+(k+1)+'"> <div class="form-group">\n' +
								'\t\t\t\t\t\t\t<div class="form-group">\n' +
								'\t\t\t\t\t\t\t\t<div>\n' +
								'\t\t\t\t\t\t\t\t\t<input type="text" id="productId'+(k+1)+'" name="productId[]" value="'+data.productRow[k+1]['id']+'" class="form-control" style="text-align: center; display:none;">\n' +
								'\t\t\t\t\t\t\t\t\t<input type="text" id="productName'+(k+1)+'" name="productName[]" value="'+data.productRow[k+1]['productname']+'" data-id="'+(k+1)+'" class="form-control" placeholder="'+langProductName+'">\n' +
								'\t\t\t\t\t\t\t\t\t<p id="productNameError'+(k+1)+'" class="alert alert-warning" role="alert" style="text-align: center; display:none;"></p>\n' +
								'\t\t\t\t\t\t\t\t</div>\n' +
								'\t\t\t\t\t\t\t</div>\n' +
								'\t\t\t\t\t\t\t<div class="form-group">\n' +
								'\t\t\t\t\t\t\t\t<div class="form-row">\n' +
								'\t\t\t\t\t\t\t\t\t<div class="form-group col-md-5">\n' +
								'\t\t\t\t\t\t\t\t\t\t<input type="text" id="productQuantity'+(k+1)+'" name="productQuantity[]" value="'+data.productRow[k+1]['quantity']+'" data-id="'+(k+1)+'" class="form-control detectQuantityInput" placeholder="'+langQuantity+'">\n' +
								'\t\t\t\t\t\t\t\t\t\t<p id="productQuantityError'+(k+1)+'" class="alert alert-warning" role="alert" style="text-align: center; display:none;"></p>\n' +
								'\t\t\t\t\t\t\t\t\t</div>\n' +
								'\t\t\t\t\t\t\t\t\t<div class="form-group col-md-5">\n' +
								'\t\t\t\t\t\t\t\t\t\t<input type="text" id="productPrice'+(k+1)+'" name="productPrice[]" value="'+data.productRow[k+1]['price']+'" data-id="'+(k+1)+'" class="form-control" placeholder="'+langPrice+'/'+langUnit+'">\n' +
								'\t\t\t\t\t\t\t\t\t\t<p id="productPriceError'+(k+1)+'" class="alert alert-warning" role="alert" style="text-align: center; display:none;"></p>\n' +
								'\t\t\t\t\t\t\t\t\t</div>\n' +
								'\t\t\t\t\t\t\t\t\t<div class="form-group col-md-2">\n' +
								'\t\t\t\t\t\t\t\t\t\t<select id="productUnit'+(k+1)+'" name="productUnit[]" class="form-control">\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="/KG">/'+langKg+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="/Metre">/'+langMetre+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="/Square Metre">/'+langSquare+' '+langMetre+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="/1000 Metre">/1000 '+langMetre+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="/100 Metre">/100 '+langMetre+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="/10 Metre">/10 '+langMetre+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="/100 GM">/100 '+langGm+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="/100 Millilitres">/100 '+langMillilitres+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="/Item Included">/'+langItemIncluded+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t\t<option value="Other">'+langOther+'</option>\n' +
								'\t\t\t\t\t\t\t\t\t\t</select>\n' +
								'\t\t\t\t\t\t\t\t\t\t<p id="productUnitError'+(k+1)+'" class="alert alert-warning" role="alert" style="text-align: center; display:none;"></p>\n' +
								'\t\t\t\t\t\t\t\t\t</div>\n' +
								'\t\t\t\t\t\t\t\t</div>\n' +
								'\t\t\t\t\t\t\t</div>\n' +
								'\t\t\t\t\t\t\t<div class="form-group">\n' +
								'\t\t\t\t\t\t\t\t<textarea  class="form-control" id="productComment'+(k+1)+'" name="productComment[]" placeholder="'+langProductComments+' ('+LangOptional+')" form="billForm">'+data.productRow[k+1]['comments']+'</textarea>\n' +
								'\t\t\t\t\t\t\t</div>' +
								'\t\t\t\t\t\t\t<div class="form-group">\n' +
								'\t\t\t\t\t\t\t\t<textarea  class="form-control" id="productDescription'+(k+1)+'" name="productDescription[]"  placeholder="'+products+" "+langDescription+' ('+LangOptional+')" form="billForm">'+data.productRow[k+1]['description']+'</textarea>\n' +
								'\t\t\t\t\t\t\t</div> ' +
								'\t\t\t\t\t\t\t<div class="form-group">\n' +
								'\t\t\t\t\t\t\t\t<div class="form-label-group">\n' +
								'\t\t\t\t\t\t\t\t\t<input type="file" name="productImage[]" />\n' +
								'\t\t\t\t\t\t\t\t\t\t<label>'+products+" "+langImage+" ("+LangOptional+")"+'</label>\n' +
								'\t\t\t\t\t\t\t\t\t</div></div>';
							$('#productsRow').append(addNewProductRow);
							$('#productUnit'+(k+1)).val(data.productRow[k+1]['unit']);
						}
					}
					i = (i+data.productRow.length) - 1;
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				$("#createBillBackendError").text('Status: '+textStatus+'   Error: '+errorThrown+' ');
				$("#createBillBackendError").show("slow").delay(3000).fadeOut("slow");
			}
		});
		$('#billModal').modal('toggle');
	});

	$('#addNewBill').click(function () {
		$('#billModalTitle').text(addNewBill);
		$('#submitBillButton').text(addBillButton);
		$('#billModal').find("input,textarea,select").val('');
		$('#addMoreProducts').show();
		$('#billModal').modal('toggle');
	});

	$(document).on('click', '#submitBillButton', function () {
		$("#createBillBackendError").hide();

		let isCorrect = 1;
		let productName;
		let productQuantity;
		let productPrice;
		let productUnit;

		let billNumber = $.trim($("#billNumber").val());
		if (billNumber  === '') {
			isCorrect = 0;
			$("#billNumberError").text(langBill+' '+langNumber+' '+' '+LangIsEmpty);
			$("#billNumberError").show("slow");
		} else {
			$("#billNumberError").hide("slow");
			let j;
			for (j = 0; j <= i; j++) {
				productName = $.trim($("#productName"+arr[j]).val());
				productQuantity = $.trim($("#productQuantity"+arr[j]).val());
				productPrice = $.trim($("#productPrice"+arr[j]).val());
				productUnit = $.trim($("#productUnit"+arr[j]).val());

				if (productName  === '') {
					isCorrect = 0;
					$("#productNameError"+arr[j]).text(langProductName+' '+LangIsEmpty);
					$("#productNameError"+arr[j]).show("slow");
				} else {
					$("#productNameError"+arr[j]).hide("slow");
				}
				if (productQuantity  === '') {
					isCorrect = 0;
					$("#productQuantityError"+arr[j]).text(products+' '+langQuantity+' '+LangIsEmpty);
					$("#productQuantityError"+arr[j]).show("slow");
				} else if(!$.isNumeric(productQuantity)) {
					isCorrect = 0;
					$("#productQuantityError"+arr[j]).text(products+' '+langQuantity+' '+LangMustNumeric);
					$("#productQuantityError"+arr[j]).show("slow");
				} else {
					if(checkUpdateQuantity) {
						$("#productQuantityError"+arr[j]).hide("slow");
					}
				}
				if (productPrice  === '') {
					isCorrect = 0;
					$("#productPriceError"+arr[j]).text(products+' '+langPrice+' '+LangIsEmpty);
					$("#productPriceError"+arr[j]).show("slow");
				} else if(!$.isNumeric(productPrice)) {
					isCorrect = 0;
					$("#productPriceError"+arr[j]).text(products+' '+langPrice+' '+LangMustNumeric);
					$("#productPriceError"+arr[j]).show("slow");
				} else {
					$("#productPriceError"+arr[j]).hide("slow");
				}
				if (productUnit === '') {
					isCorrect = 0;
					$("#productUnitError"+arr[j]).text(products+' '+langUnit+' '+LangIsEmpty);
					$("#productUnitError"+arr[j]).show("slow");
				} else {
					$("#productUnitError"+arr[j]).hide("slow");
				}
			}
		}
		if (isCorrect) {
			let formData = new FormData($('#billForm')[0]);
			if($("#submitBillButton").text() == updateBillButton) {
				if(checkUpdateQuantity) {
					formData.append('originalBillNumber', originalBillNumber);
					$.ajax({
						url: baseUrl+'admin/updateBill',
						type: 'POST',
						dataType: 'JSON',
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						success: function (data) {
							if(data.status) {
								$('#billForm')[0].reset();
								$('#billTotalPrice'+data.billId).text(data.totalPrice);
								$('#billNumber'+data.billId).text(data.billNumber);
								$("#createBillMessage").text(data.statusMessage);
								$('#billModal').modal('toggle');
								$("#createBillMessage").show("slow").delay(3000).fadeOut("slow");
								if(i > 0) {
									for(let l = 1; l <= i; l++) {
										$("#addNewProductsRow"+l).remove();
									}
								}
								i = 0;
							} else {
								if(data.statusMessage) {
									$('#createBillBackendError').html(data.statusMessage);
									$("#createBillBackendError").show("slow");
								} else if(data.billNumberError != '') {
									$('#createBillBackendError').html(data.billNumberError);
									$("#createBillBackendError").show("slow");
									$("#createBillBackendError").show("slow");
								} else if(data.productNameError != '') {
									$('#createBillBackendError').html(data.productNameError);
									$("#createBillBackendError").show("slow");
								} else if(data.productQuantityError != '') {
									$('#createBillBackendError').html(data.productQuantityError);
									$("#createBillBackendError").show("slow");
								} else if(data.productPriceError != '') {
									$('#createBillBackendError').html(data.productPriceError);
									$("#createBillBackendError").show("slow");
								} else if(data.productUnitError != '') {
									$('#createBillBackendError').html(data.productUnitError);
									$("#createBillBackendError").show("slow");
								} else if(data.imageError != '') {
									$('#createBillBackendError').html(data.imageError);
									$("#createBillBackendError").show("slow");
								}
							}
							if(data.status2) {
								$("#imageUploadMessage").text(data.imageError);
								$("#imageUploadMessage").show("slow").delay(3000).fadeOut("slow");
							}
						},
						error: function (XMLHttpRequest, textStatus, errorThrown) {
							$('#billForm')[0].reset();
							$("#createBillMessage").text('Status: '+textStatus+'   Error: '+errorThrown+' ');
							$('#billModal').modal('toggle');
							$("#createBillMessage").show("slow").delay(3000).fadeOut("slow");
						}
					});
				} else {
					$("#createBillBackendError").text('Please Correct the Error first');
					$("#createBillBackendError").show("slow").delay(2000).fadeOut("slow");
				}
			} else {
				$.ajax({
					url: baseUrl+'admin/addNewBill',
					type: 'POST',
					dataType: 'JSON',
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success: function (data) {
						if(data.status) {
							let datatable = $('#dataTable').DataTable();
							$('#billForm')[0].reset();
							let totalPrice = $('#billDetailTotal').text();
							totalPrice = parseInt(totalPrice) + parseInt(data.totalPrice);
							$("#billDetailTotal").text(totalPrice);
							let totalProducts = $('#billDetailProducts').text();
							totalProducts = parseInt(totalProducts) + parseInt(data.numberOfProducts);
							$("#billDetailProducts").text(totalProducts);

							if($('#addProductBillId').val() != '') {
								var k=0;
								$("#pageLastUpdated").text(data.updatedAt);
								$("#billDetailUpdatedAt").text(data.updatedAt);

								for(let i=data.firstId; i <= data.lastId; i++) {
									let rowNode = datatable.row.add( [
										data.productName[k],
										data.quantity[k],
										data.quantity[k],
										data.total[k],
										parseInt(data.quantity[k])*parseInt(data.total[k]),
										'<select class="form-control" disabled>'+
										'<option value="/KG">/'+langKg+'</option>'+
										'<option value="/Metre">/'+langMetre+'</option>'+
										'<option value="/Square Metre">/'+langSquare+' '+langMetre+'</option>'+
										'<option value="/1000 Metre">/1000 '+langMetre+'</option>'+
										'<option value="/100 Metre">/100 '+langMetre+'</option>'+
										'<option value="/10 Metre">/10 '+langMetre+'</option>'+
										'<option value="/100 GM">/100 '+langGm+'</option>'+
										'<option value="/100 Millilitres">/100 '+langMillilitres+'</option>'+
										'<option value="/Item Included">/'+langItemIncluded+'</option>'+
										'<option value="Other">'+langOther+'</option>'+
										'</select>',
										data.comments[k],
										data.description[k],
										data.addedAt,
										data.updatedAt,
										'<button data-productid="'+i+'" type="button" class="btn btn-outline-secondary sellProduct">'+langSell+'</button>'+
										'<button data-productprice="'+parseInt(data.quantity[k])*parseInt(data.total[k])+'" data-productid="'+i+'" type="button" class="btn btn-outline-secondary updateProduct">'+updateBillButton+'</button>\n' +
										'\t\t\t\t\t\t\t\t\t<button data-productprice="'+parseInt(data.quantity[k])*parseInt(data.total[k])+'" data-productid="'+i+'" type="button" class="btn btn-outline-danger deleteProduct">'+langDelete+'</button>'
									] ).draw( false ).node();
									$(rowNode).find('td:nth-child(1)').addClass('editable editableProductName');
									$(rowNode).find('td:nth-child(2)').addClass('editable editableProductQuantity');
									$(rowNode).find('td:nth-child(3)').attr('id', 'editableProductRemaining'+i);
									$(rowNode).find('td:nth-child(4)').addClass('editable editableProductPrice');
									$(rowNode).find('td:nth-child(5)').attr('id', 'editableProductTotal'+i);
									$(rowNode).find('td:nth-child(6)').addClass('editableProductUnit');
									$(rowNode).find('select').attr('id', 'editableProductUnit'+i);
									$(rowNode).find('td:nth-child(7)').addClass('editable editableProductComments');
									$(rowNode).find('td:nth-child(8)').addClass('editable editableProductDescription');
									$(rowNode).attr("id", "productRow"+i);
									$('select[id="editableProductUnit'+i+'"] option[value="'+data.unit[k]+'"]').attr('selected','selected');
									k++;
								}
								$("#tempInvoice").hide();
								$("#billDetailMessage").text(data.statusMessage);
								$('#billModal').modal('toggle');
								$("#billDetailMessage").show("slow").delay(3000).fadeOut("slow");
							} else {
								let rowNode = datatable.row.add( [
									data.billNumber,
									data.totalPrice,
									data.numberOfProducts,
									data.addedAt,
									'<a class="btn btn-outline-primary" href="'+baseUrl+'admin/bill_detail/'+data.id+'">'+langViewDetails+'</a>\n' +
									'\t\t\t\t\t\t\t\t\t\t\t<button data-billid="'+data.id+'" type="button" class="btn btn-outline-secondary updateBill">'+updateBillButton+'</button>\n' +
									'\t\t\t\t\t\t\t\t\t\t\t<button data-billid="'+data.id+'" type="button" class="btn btn-outline-danger deleteBill">'+langDelete+'</button>'
								] ).draw( false ).node();
								$(rowNode).attr("id", "billRow"+data.id);
								$("#createBillMessage").text(data.statusMessage);
								$('#billModal').modal('toggle');
								$("#createBillMessage").show("slow").delay(3000).fadeOut("slow");
							}
							i = 0;
						} else {
							if(data.statusMessage) {
								$('#createBillBackendError').html(data.statusMessage);
								$("#createBillBackendError").show("slow");
							} else if(data.billNumberError != '') {
								$('#createBillBackendError').html(data.billNumberError);
								$("#createBillBackendError").show("slow");
								$("#createBillBackendError").show("slow");
							} else if(data.productNameError != '') {
								$('#createBillBackendError').html(data.productNameError);
								$("#createBillBackendError").show("slow");
							} else if(data.productQuantityError != '') {
								$('#createBillBackendError').html(data.productQuantityError);
								$("#createBillBackendError").show("slow");
							} else if(data.productPriceError != '') {
								$('#createBillBackendError').html(data.productPriceError);
								$("#createBillBackendError").show("slow");
							} else if(data.productUnitError != '') {
								$('#createBillBackendError').html(data.productUnitError);
								$("#createBillBackendError").show("slow");
							}
						}
						if(data.status2) {
							if($('#addProductBillId').val() != '') {
								$("#imageUploadMessage2").text(data.imageError);
								$("#imageUploadMessage2").show("slow").delay(3000).fadeOut("slow");
							} else {
								$("#imageUploadMessage").text(data.imageError);
								$("#imageUploadMessage").show("slow").delay(3000).fadeOut("slow");
							}
						}
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						$('#billForm')[0].reset();
						$("#billDetailMessage").text('Status: '+textStatus+'   Error: '+errorThrown+' ');
						$('#billModal').modal('toggle');
						$("#billDetailMessage").show("slow").delay(3000).fadeOut("slow");
					}
				});
			}
		}

	});

	$('#productsRow').on('input', '.detectNameInput', function () {
		if($('#submitBillButton').text() == 'Add') {
			$(".invoicePName"+$(this).data('id')).text($(this).val());
			if($('#productName0').val() != '') {
				$("#tempInvoice").show();
			} else {
				$("#tempInvoice").hide();
			}
		}
	});

	$('#productsRow').on('input', '.detectQuantityInput', function () {
		if($('#submitBillButton').text() == 'Add') {
			$(".invoiceQuantity"+$(this).data('id')).text($(this).val());
			if($.isNumeric($(this).val()) && $.isNumeric($('#productPrice'+$(this).data('id')).val())) {
				$(".tempInvoiceTotalPrice"+$(this).data('id')).text(($(this).val()) * ($('#productPrice'+$(this).data('id')).val()));
			}
			let a;
			let tempInvoiceTotal2 = 0;
			let tempInvoiceTotal4 = 0;
			for(a = 0; a <= i; a++) {
				if(parseInt($("#invoiceQuantity"+arr[a]).text())) {
					tempInvoiceTotal2 = tempInvoiceTotal2 + parseInt($("#invoiceQuantity"+arr[a]).text());
				}
				if(parseInt($("#tempInvoiceTotalPrice"+arr[a]).text())) {
					tempInvoiceTotal4 = tempInvoiceTotal4 + parseInt($("#tempInvoiceTotalPrice"+arr[a]).text());
				}
			}
			$("#tempInvoiceTotal2").text(tempInvoiceTotal2);
			$("#tempInvoiceTotal4").text(tempInvoiceTotal4);
		}
	});

	$('#productsRow').on('input', '.detectPriceInput', function () {
		if($('#submitBillButton').text() == 'Add') {
			$(".invoicePrice"+$(this).data('id')).text($(this).val());
			if($.isNumeric($(this).val()) && $.isNumeric($('#productQuantity'+$(this).data('id')).val())) {
				$(".tempInvoiceTotalPrice"+$(this).data('id')).text(($(this).val()) * ($('#productQuantity'+$(this).data('id')).val()));
			}
			let a;
			let tempInvoiceTotal3 = 0;
			let tempInvoiceTotal4 = 0;
			for(a = 0; a <= i; a++) {
				if(parseInt($("#invoicePrice"+arr[a]).text())) {
					tempInvoiceTotal3 = tempInvoiceTotal3 + parseInt($("#invoicePrice"+arr[a]).text());
				}
				if(parseInt($("#tempInvoiceTotalPrice"+arr[a]).text())) {
					tempInvoiceTotal4 = tempInvoiceTotal4 + parseInt($("#tempInvoiceTotalPrice"+arr[a]).text());
				}
			}
			$("#tempInvoiceTotal3").text(tempInvoiceTotal3);
			$("#tempInvoiceTotal4").text(tempInvoiceTotal4);
		}
	});

	$('#productsRow').on('click', '.removeProductRow', function () {
		if($("#productQuantity"+$(this).data("id")).val() !== undefined) {
			if($.isNumeric($("#productQuantity"+$(this).data("id")).val())) {
				$("#tempInvoiceTotal2").text($("#tempInvoiceTotal2").text() - $("#productQuantity"+$(this).data("id")).val());
			}
		}
		if($("#productPrice"+$(this).data("id")).val() !== undefined) {
			if($.isNumeric($("#productPrice"+$(this).data("id")).val())) {
				$("#tempInvoiceTotal3").text($("#tempInvoiceTotal3").text() - $("#productPrice"+$(this).data("id")).val());
			}
		}
		$('#tempInvoiceTotal4').text($("#tempInvoiceTotal4").text() - $("#tempInvoiceTotalPrice"+$(this).data("id")).text());
		$('#addNewProductsRow'+$(this).data('id')).remove();
		$('.invoicePName'+$(this).data('id')).remove();
		$('.invoiceQuantity'+$(this).data('id')).remove();
		$('.invoicePrice'+$(this).data('id')).remove();
		$('.tempInvoiceTotalPrice'+$(this).data('id')).remove();
		let tempI = $("#tempInvoiceTotal1").text();
		tempI--;
		$("#tempInvoiceTotal1").text(tempI);

		i--;
		let index = arr.indexOf($(this).data('id'));
		if (index > -1) {
			arr.splice(index, 1);
		}
	});

	$('#addMoreProducts').click(function () {
		i++;
		$("#tempInvoiceTotal1").text(i+1);
		let largest = 0;
		let m;
		for (m=0; m<=arr.length;m++){
			if (arr[m]>largest) {
				largest = arr[m];
			}
		}
		arr.push(largest+1);

		let addNewProductRow = '<div id="addNewProductsRow'+(largest+1)+'"> <div class="form-group">\n' +
			'\t\t\t\t\t\t\t\t<div class="form-row">\n' +
			'\t\t\t\t\t\t\t\t\t<button style="margin-left: auto;" type="button" class="close removeProductRow" data-id="'+(largest+1)+'" aria-label="Close">\n' +
			'\t\t\t\t\t\t\t\t\t\t<span aria-hidden="true">&times;</span>\n' +
			'\t\t\t\t\t\t\t\t\t</button>\n' +
			'\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t<div class="form-group">\n' +
			'\t\t\t\t\t\t\t\t<div>\n' +
			'\t\t\t\t\t\t\t\t\t<input type="text" id="productName'+(largest+1)+'" name="productName[]" data-id="'+(largest+1)+'" class="form-control detectNameInput" placeholder="'+langProductName+'">\n' +
			'\t\t\t\t\t\t\t\t\t<p id="productNameError'+(largest+1)+'" class="alert alert-warning" role="alert" style="text-align: center; display:none;"></p>\n' +
			'\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t<div class="form-group">\n' +
			'\t\t\t\t\t\t\t\t<div class="form-row">\n' +
			'\t\t\t\t\t\t\t\t\t<div class="form-group col-md-5">\n' +
			'\t\t\t\t\t\t\t\t\t\t<input type="text" id="productQuantity'+(largest+1)+'" name="productQuantity[]" data-id="'+(largest+1)+'" class="form-control detectQuantityInput" placeholder="'+langQuantity+'">\n' +
			'\t\t\t\t\t\t\t\t\t\t<p id="productQuantityError'+(largest+1)+'" class="alert alert-warning" role="alert" style="text-align: center; display:none;"></p>\n' +
			'\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t<div class="form-group col-md-5">\n' +
			'\t\t\t\t\t\t\t\t\t\t<input type="text" id="productPrice'+(largest+1)+'" name="productPrice[]"data-id="'+(largest+1)+'" class="form-control detectPriceInput" placeholder="'+langPrice+'/'+langUnit+'">\n' +
			'\t\t\t\t\t\t\t\t\t\t<p id="productPriceError'+(largest+1)+'" class="alert alert-warning" role="alert" style="text-align: center; display:none;"></p>\n' +
			'\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t\t<div class="form-group col-md-2">\n' +
			'\t\t\t\t\t\t\t\t\t\t<select id="productUnit'+(largest+1)+'" name="productUnit[]" class="form-control">\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="/KG">/'+langKg+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="/Metre">/'+langMetre+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="/Square Metre">/'+langSquare+' '+langMetre+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="/1000 Metre">/1000 '+langMetre+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="/100 Metre">/100 '+langMetre+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="/10 Metre">/10 '+langMetre+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="/100 GM">/100 '+langGm+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="/100 Millilitres">/100 '+langMillilitres+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="/Item Included">/'+langItemIncluded+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t\t<option value="Other">'+langOther+'</option>\n' +
			'\t\t\t\t\t\t\t\t\t\t</select>\n' +
			'\t\t\t\t\t\t\t\t\t\t<p id="productUnitError'+(largest+1)+'" class="alert alert-warning" role="alert" style="text-align: center; display:none;"></p>\n' +
			'\t\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t</div>\n' +
			'\t\t\t\t\t\t\t<div class="form-group">\n' +
			'\t\t\t\t\t\t\t\t<textarea  class="form-control" id="productComment'+(largest+1)+'" name="productComment[]" placeholder="'+langProductComments+' ('+LangOptional+')" form="billForm"></textarea>\n' +
			'\t\t\t\t\t\t\t</div>' +
			'\t\t\t\t\t\t\t<div class="form-group">\n' +
			'\t\t\t\t\t\t\t\t<textarea  class="form-control" id="productDescription'+(largest+1)+'" name="productDescription[]" placeholder="'+products+" "+langDescription+' ('+LangOptional+')" form="billForm"></textarea>\n' +
			'\t\t\t\t\t\t\t</div>' +
			'\t\t\t\t\t\t\t<div class="form-group">\n' +
			'\t\t\t\t\t\t\t\t<div class="form-label-group">\n' +
			'\t\t\t\t\t\t\t\t\t<input type="file" name="productImage[]" />\n' +
			'\t\t\t\t\t\t\t\t\t\t<label>'+products+" "+langImage+" ("+LangOptional+")"+'</label>\n' +
			'\t\t\t\t\t\t\t\t\t</div></div>';
		$('#productsRow').prepend(addNewProductRow);

		let addInvoiceProductName = '<span class="invoicePName'+(largest+1)+'"></span><br class="invoicePName'+(largest+1)+'">';
		let addInvoiceProductQuantity = '<span id="invoiceQuantity'+(largest+1)+'" class="invoiceQuantity'+(largest+1)+'"></span><br class="invoiceQuantity'+(largest+1)+'">';
		let addInvoiceProductPrice = '<span id="invoicePrice'+(largest+1)+'" class="invoicePrice'+(largest+1)+'"></span><br class="invoicePrice'+(largest+1)+'">';
		let addInvoiceProductTotalPrice = '<span id="tempInvoiceTotalPrice'+(largest+1)+'" class="tempInvoiceTotalPrice'+(largest+1)+'"></span><br class="tempInvoiceTotalPrice'+(largest+1)+'">';
		$('#tempInvoiceName').append(addInvoiceProductName);
		$('#tempInvoiceQuantity').append(addInvoiceProductQuantity);
		$('#tempInvoicePrice').append(addInvoiceProductPrice);
		$('#tempInvoiceTotalPrice').append(addInvoiceProductTotalPrice);


	});

	$(".closeBillModal").click( function () {
		if(i > 0) {
			for(let l = 1; l <= arr.length; l++) {
				$("#addNewProductsRow"+arr[l]).remove();
			}
		}
		arr = [];
		i = 0;
		arr = [i];
		$("#tempInvoiceName").empty();
		$("#tempInvoiceName").append('<span class="invoicePName0"></span><br class="invoicePName0">');
		$("#tempInvoiceQuantity").empty();
		$("#tempInvoiceQuantity").append('<span id="invoiceQuantity0" class="invoiceQuantity0"></span><br class="invoiceQuantity0">');
		$("#tempInvoicePrice").empty();
		$("#tempInvoicePrice").append('<span id="invoicePrice0" class="invoicePrice0"></span><br class="invoicePrice0">');
		$("#tempInvoiceTotalPrice").empty();
		$("#tempInvoiceTotalPrice").append('<span id="tempInvoiceTotalPrice0" class="tempInvoiceTotalPrice0"></span><br class="tempInvoiceTotalPrice0">');
		$("#tempInvoiceTotal1").text('1');
		$("#tempInvoiceTotal2").text('');
		$("#tempInvoiceTotal3").text('');
		$("#tempInvoiceTotal4").text('');
		$("#tempInvoice").hide();
	});
});
