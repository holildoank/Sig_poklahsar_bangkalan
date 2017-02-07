var site_url = $('#site_url').data('site-url');
var mode = $('#mode').data('mode');

$.fn.modal.Constructor.prototype.enforceFocus = function() {}; //select2 agar bisa search
$('select[name=usergroup_id]').select2({
	placeholder: 'Pilih User Group'
});
$('select[name=menu_id]').select2({
	placeholder: 'Pilih Menu'
});

$('#menu_id').change(function(e) {
	e.preventDefault();
	var menu_id = $(this).val();
	$('.content_listfitur').load(site_url+'akses/content_listfitur', {menu_id:menu_id}, function() {
		/* Act on the event */
	});
});
function insertAction () {
	var formData = $('#form_akses').serialize();
	$.ajax({
		url: site_url+'akses/create_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
            closeModal();
            table.ajax.reload();
            swal(
                {
                    title: "Berhasil!",
                    text: "Hak Akses berhasil ditambahkan!",
                    type: "success",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Success",
                    closeOnConfirm: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        // window.location.replace(site_url+'opportunity');
                    }
                }
            );
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
	var formData = $('#form_akses').serialize();
	$.ajax({
		url: site_url+'akses/update_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
            closeModal();
            table.ajax.reload();
            swal(
                {
                    title: "Berhasil!",
                    text: "Hak Akses berhasil diperbarui!",
                    type: "success",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Success",
                    closeOnConfirm: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        // window.location.replace(site_url+'opportunity');
                    }
                }
            );
		}
	})
	.fail(function() {
		console.log("error");
	});
}

function closeModal() {
    $('#modal_form').modal('hide');
}

var validate_form_akses = function() {
    var form1 = $('#form_akses');
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
            usergroup_id: {
                required: true
            },
			menu_id: {
                required: true
            },
            akses_active: {
                required: true
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
            if(mode=='add'){
                insertAction();
            }else if(mode=='edit'){
                updateAction();
            }
            success1.show();
            error1.hide();
        }
    });
}
validate_form_akses();
