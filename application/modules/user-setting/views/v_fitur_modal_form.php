<?php
if($mode=='fitur'){
	$dt = $data_menu->row();
}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" onclick="event.preventDefault(); closeModal();"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
			<?php if ($mode=='fitur' && !$isValid): ?>
				<h1>Data Tidak Ditemukan</h1>
			<?php else: ?>
				<form class="horizontal-form" id="form_fitur">
	    			<div class="form-body">
	                    <div class="alert alert-danger display-hide">
	                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
	                    </div>
	                    <div class="row">
	    					<div class="col-md-12">
								<div class="form-group">
	                                <label class="control-label">Kode Fitur*</label>
									<input type="text" name="fitur_kode" id="fitur_kode" class="form-control" placeholder="Kode Fitur" />
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label">Nama Fitur *</label>
	                                <input type="text" name="fitur_nama" id="fitur_nama" class="form-control" placeholder="Nama Fitur" />
	                            </div>
	    					</div>
	    				</div>
	    			</div>
					<br>
	                <div class="form-actions">
	                    <div class="row">
	                        <div class="col-md-9">
								<input type="hidden" name="submode" id="submode" value="<?php echo $submode ?>">
								<input type="hidden" name="menu_id" value="<?php echo @$dt->menu_id ?>">
								<input type="hidden" name="fitur_id" id="fitur_id" value="">
								<button type="button" class="btn dark btn-outline btn-cancel display-hide" onclick="event.preventDefault(); cancelEdit();">Batal</button>
								<button type="submit" class="btn blue btn-insert">Tambah</button>
								<button type="submit" class="btn green btn-update display-hide">Update</button>
	                        </div>
	                    </div>
	                </div>
	            </form>
				<br>
				<table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="table_fitur">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Fitur</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
			<?php endif; ?>
		</div>
	</div>
</div>
<script src="<?php echo base_url() ?>assets/custom/scripts/user-setting/j_fitur.js" type="text/javascript"></script>
<script type="text/javascript">
table_fitur = $('#table_fitur').DataTable({
    buttons: [
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('menu/list_fitur')?>",
        "type": "POST",
        data: function (d) {
			d.menu_id = <?php echo json_encode(@$dt->menu_id) ?>;
        }
    },

    "columns": [
        {"orderable": false},
        {"orderable": true},
        {"orderable": true},
        {"orderable": false}
    ],
    "order": [
        [1, "asc"]
    ],
});

function btn_edit_fitur(id, kode, nama) {
	submode = 'edit';
	$('#submode').val('edit');
	$('.btn-insert').hide();
	$('.btn-cancel').show();
	$('.btn-update').show();
	$('#fitur_id').val(id);
	$('#fitur_kode').val(kode);
	$('#fitur_nama').val(nama);
	$("#modal_form").scrollTop(0);
}

function btn_delete_fitur(id) {
	cancelEdit();
	var sure = confirm('Apakah Anda yakin?');
	if (sure) {
		$.post('<?php echo site_url() ?>menu/delete_fitur', {id:id}, function(res) {
			if (res.stat) {
				table.ajax.reload();
				table_fitur.ajax.reload();
				NotifikasiToast({
					type : 'success', // success,warning,info,error
					msg : 'Berhasil dihapus.',
					title : 'Sukses',
				});
			} else {
				NotifikasiToast({
					type : 'error', // success,warning,info,error
					msg : res.pesan,
					title : 'Error',
				});
			}
		});
	}
}
</script>
