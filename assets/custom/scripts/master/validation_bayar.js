var site_url = $('#site_url').data('site-url');
var mode = $('#mode').data('mode');

function insertAction () {
	var formData = $('#form_bayar').serialize();
	$.ajax({
		url: site_url+'bayar/create_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
        if(res.stat){
            window.location.replace(site_url+'bayar');
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
	var formData = $('#form_bayar').serialize();
	$.ajax({
		url: site_url+'bayar/update_action',
		type: 'post',
		data: formData
	})
	.done(function(res) {
        if(res.stat){
            window.location.replace(site_url+'bayar');
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


var validate_form_bayar = function() {
    var form1 = $('#form_bayar');
    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);

    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        messages:
            {
                jurusan_id : "Form Jurusan  tidak boleh Kosong",
                bayar_kode : "Form Kode Pembayaran Tidak Boleh Kosong",
                bayar_nama : "Form Nama Pembayaran Tidak Boleh Kosong",
				bayar_jenis: "Form Jenis Pembayaran Tidak Boleh Kosong",
				bayar_premi: "Form Premi Pembayaran Tidak Boleh Kosong dan hanya angka yang boleh di masukan",
            },
        rules: {
            jurusan_id: {
                required: true
            },
            bayar_kode: {
                required: true
            },
            bayar_nama: {
                required: true
            },
			bayar_jenis: {
                required: true
            },
			bayar_premi: {
                required: true,
				digits : true
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
validate_form_bayar();
