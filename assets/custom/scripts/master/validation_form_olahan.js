var site_url = $('#site_url').data('site-url');
var submode = $('#submode').val();

$.fn.modal.Constructor.prototype.enforceFocus = function() {}; //select2 agar bisa search

function cancelEdit() {
	submode = 'add';
	$('#submode').val('add');
	$('.btn-update').hide();
	$('.btn-cancel').hide();
	$('.btn-insert').show();
	$('#bahanpoklahsar_id').val('');
  $('#bahanpoklahsar_nama').val('');
  $('#tahun_olahan').val('');
  $('#bahan').val('');
	$('#jumlah').val('');
	$("#modal_form_poklahsar").scrollTop(0);
}


function insertAction () {
	var formData = $('#form_olahan').serialize();
	$.ajax({
		url: site_url+'poklahsar/create_action_olahan',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
      table_olahan.ajax.reload();
			NotifikasiToast({
				type : 'success', // success,warning,info,error
				msg : 'Data Olahan berhasil ditambahkan.',
				title : 'Sukses',
			});
			cancelEdit();
		}else{
			NotifikasiToast({
				type : 'error', // success,warning,info,error
				msg : res.pesan,
				title : 'Error',
			});
		}
	})
	.fail(function() {
		console.log("error");
	});
}

function updateAction () {
	var formData = $('#form_olahan').serialize();
	$.ajax({
		url: site_url+'poklahsar/update_action_olahan',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
            table_olahan.ajax.reload();
			NotifikasiToast({
				type : 'success', // success,warning,info,error
				msg : 'Data Olahan berhasil diperbarui.',
				title : 'Sukses',
			});
			cancelEdit();
		}else{
			NotifikasiToast({
				type : 'error', // success,warning,info,error
				msg : res.pesan,
				title : 'Error',
			});
		}
	})
	.fail(function() {
		console.log("error");
	});
}

function closeModal() {
	table_olahan.ajax.reload();
    $('#modal_form_poklahsar').modal('hide');
}

var validate_form_olahan = function() {
    var form1 = $('#form_olahan');
    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);

    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        messages: {
            select_multi: {
                maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                minlength: jQuery.validator.format("At least {0} items must be selected")
            }
        },
        rules: {
    			bahanpoklahsar_nama: {
                    required: true
                },
          tahun_olahan: {
                    required: true
          },bahan: {
                    required: true
          },jumlah: {
                    required: true,
                    digits :true
          },
        },

        invalidHandler: function (event, validator) { //display error alert on form submit
            success1.hide();
            error1.show();
            App.scrollTo(error1, -200);
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label
                .closest('.form-group').removeClass('has-error'); // set success class to the control group
        },

        submitHandler: function (form) {
            // form.submit();
            if(submode=='add'){
                insertAction();
            }else if(submode=='edit'){
                updateAction();
            }
            success1.show();
            error1.hide();
        }
    });
}
validate_form_olahan();
