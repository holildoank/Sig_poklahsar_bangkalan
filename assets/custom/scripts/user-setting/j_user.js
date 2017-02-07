var site_url = $('#site_url').data('site-url');
var mode = $('#mode').data('mode');

// $.fn.select2.defaults.set( "theme", "bootstrap" );
$.fn.modal.Constructor.prototype.enforceFocus = function() {}; //select2 agar bisa search
$('select[name=usergroup_id]').select2({
	placeholder: 'Pilih User Group'
});

function insertAction () {
	var formData = $('#form_user_add').serialize();
	$.ajax({
		url: site_url+'user/create_action',
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
                    text: "User berhasil ditambahkan!",
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
	var formData = $('#form_user_edit').serialize();
	$.ajax({
		url: site_url+'user/update_action',
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
                    text: "User berhasil diperbarui!",
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

function closeModal() {
    $('#modal_form').modal('hide');
}

var validate_form_user_add = function() {
    var form1 = $('#form_user_add');
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
			user_username: {
                required: true
            },
            user_password: {
				minlength: 5,
				required: true
            },
			retype_user_password: {
				minlength: 5,
				required: true,
				equalTo: "#user_password"
            },
            user_active: {
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
            insertAction();
            success1.show();
            error1.hide();
        }
    });
}

var validate_form_user_edit = function() {
    var form1 = $('#form_user_edit');
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
			user_username: {
                required: true
            },
            user_password: {
				minlength: 5,
            },
            user_active: {
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
            updateAction();
            success1.show();
            error1.hide();
        }
    });
}
validate_form_user_add();
validate_form_user_edit();
