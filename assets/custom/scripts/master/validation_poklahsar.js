var site_url = $('#site_url').data('site-url');
var mode = $('#mode').data('mode');

function insertAction () {
	var formData = $('#form_poklahsar').serialize();
	$.ajax({
		url: site_url+'poklahsar/create_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
        if(res.stat){
            window.location.replace(site_url+'poklahsar');
        }else{
            NotifikasiToast({
                positionClass: 'toast-top-full-width',
                type : 'error',
                msg : res.pesan,
                title : 'Peringatan',
            });
        }

	})
	.fail(function() {
		console.log("error");
	});
}

function updateAction () {
	var formData = $('#form_poklahsar').serialize();
	$.ajax({
		url: site_url+'poklahsar/update_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
        if(res.stat){
            window.location.replace(site_url+'poklahsar');
        }else{
            NotifikasiToast({
                positionClass: 'toast-top-full-width',
                type : 'error',
                msg : res.pesan,
                title : 'Peringatan',
            });
        }
	})
	.fail(function() {
		console.log("error");
	});
}


var validate_form_poklahsar = function() {
    var form1 = $('#form_poklahsar');
    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);

    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        messages:
            {
                poklahsar_nama : "Form nama poklahsar  tidak boleh Kosong",
                alamat_poklahsar : "Form Alamat Tidak Boleh Kosong",
                jumproduk_tahun : "Form  jumlah produk Tidak Boleh Kosong",
                lat : "Form  Titik kordinat Lattitude Tidak Boleh Kosong",
                long : "Form  Titik Kordinat Longitude Tidak Boleh Kosong",
            },
        rules: {
            poklahsar_nama: {
                required: true
            },
            alamat_poklahsar: {
                required: true
            },
            jumproduk_tahun: {
                required: true
            },
            lat: {
                required: true
            },long: {
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
validate_form_poklahsar();
