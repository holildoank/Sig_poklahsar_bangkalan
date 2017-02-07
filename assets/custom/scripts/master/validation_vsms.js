var site_url = $('#site_url').data('site-url');
var mode = $('#mode').data('mode');

function insertAction () {
	var formData = $('#vsms').serialize();
	$.ajax({
		url: site_url+'master_visi_misi/create_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
            closeModal();
            tabel_vsms.ajax.reload();
                NotifikasiToast({
                    type : 'success', // success,warning,info,error
                    msg : 'Data Visi / Misi berhasil ditambahkan',
                    title : 'Sukses',
                });
		}
	})
	.fail(function() {
		console.log("error");
	});
}

function updateAction () {
	var formData = $('#vsms').serialize();
	$.ajax({
		url: site_url+'master_visi_misi/update_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
            closeModal();
            tabel_vsms.ajax.reload();
            NotifikasiToast({
                type : 'success', // success,warning,info,error
                msg : 'Data Visi / Misi  berhasil diperbarui',
                title : 'Sukses',
            });
                // function(isConfirm) {
                //     if (isConfirm) {
                //     }
                // }

		}
	})
	.fail(function() {
		console.log("error");
	});
}

function closeModal() {
    $('#modal_vsms').modal('hide');
}

var validate_vsms = function() {
    var form1 = $('#vsms');
    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);

    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        // messages: {
        //     select_multi: {
        //         maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
        //         minlength: jQuery.validator.format("At least {0} items must be selected")
        //     }
        // },
        messages:
            {
                nm_vis : "Form Nama Angkatan Tidak Boleh Kosong",
            },
        rules: {
            nm_vis: {
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
validate_vsms();
