var site_url = $('#site_url').data('site-url');
var mode = $('#mode').data('mode');


function insertAction () {
	var formData = $('#form_listfitur').serialize();
	$.ajax({
		url: site_url+'akses/save_action_listfitur',
		type: 'post',
		data: formData
	})
	.done(function(res) {
		if(res.stat){
			table.ajax.reload();
            table_fitur.ajax.reload();
			NotifikasiToast({
				type : 'success', // success,warning,info,error
				msg : 'Fitur berhasil ditambahkan.',
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
	table.ajax.reload();
    $('#modal_form').modal('hide');
}
