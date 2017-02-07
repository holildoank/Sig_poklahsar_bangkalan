var site_url = $('#site_url').data('site-url');
var mode = $('#mode').data('mode');

function insertAction () {
	var formData = $('#form_usergroup').serialize();
	$.ajax({
		url: site_url+'usergroup/create_action',
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
                    text: "User Group berhasil ditambahkan!",
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

function updateAction () {
	var formData = $('#form_usergroup').serialize();
	$.ajax({
		url: site_url+'usergroup/update_action',
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
                    text: "User Group berhasil diperbarui!",
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

var validate_form_usergroup = function() {
    var form1 = $('#form_usergroup');
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
            usergroup_nama: {
                required: true
            },
            usergroup_ket: {
                required: true
            },
            usergroup_active: {
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
validate_form_usergroup();
