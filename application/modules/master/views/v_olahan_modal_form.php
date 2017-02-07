<?php
if($mode=='olahan'){
	$dt = $data_poklahsar->row();
}
?>
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" onclick="event.preventDefault(); closeModal();"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
			<?php if ($mode=='olahan' && !$isValid): ?>
				<h1>Data Tidak Ditemukan</h1>
			<?php else: ?>
				<form class="horizontal-form" id="form_olahan">
	    			<div class="form-body">
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button> Silahkan lengkapi Form di bawah ini
                </div>
                <div class="row">
	    					<div class="col-md-5">
                  <div class="form-group">
                      <label class="control-label">Nama Olahan *</label>
                      <input type="text" name="bahanpoklahsar_nama" id="bahanpoklahsar_nama" class="form-control" placeholder="Nama Olahan" />
                  </div>
	    					</div>
								<div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Jumlah *</label>
                      <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah" />
                  </div>
	    					</div>
								<div class="col-md-4">
									<div class="form-group">
											<label class="control-label">Tahun *</label>
											<input type="text" name="tahun_olahan" id="tahun_olahan" class="form-control datepicker" placeholder="Tahun" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Bahan</label>
										<textarea name="bahan" rows="2" cols="2" id="bahan" class="form-control"></textarea>
									</div>
								</div>
	    				</div>
	    			</div>
					<br>
          <div class="form-actions">
              <div class="row">
                  <div class="col-md-9">
											<input type="hidden" name="submode" id="submode" value="<?php echo $submode ?>">
											<input type="hidden" name="poklahsar_id" value="<?php echo @$dt->poklahsar_id ?>">
											<input type="hidden" name="bahanpoklahsar_id" id="bahanpoklahsar_id" value="">
											<button type="button" class="btn dark btn-outline btn-cancel display-hide" onclick="event.preventDefault(); cancelEdit();">Batal</button>
											<button type="submit" class="btn blue btn-insert">Tambah</button>
											<button type="submit" class="btn green btn-update display-hide">Update</button>
                      </div>
                  </div>
              </div>
          </form>
		<br>
				<table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="table_olahan">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Olahan</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
			<?php endif; ?>
		</div>
	</div>
</div>
<script src="<?php echo base_url() ?>assets/custom/scripts/master/validation_form_olahan.js" type="text/javascript"></script>
<script type="text/javascript">
table_olahan = $('#table_olahan').DataTable({
    buttons: [
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('poklahsar/list_olahan')?>",
        "type": "POST",
        data: function (d) {
			d.poklahsar_id = <?php echo json_encode(@$dt->poklahsar_id) ?>;
        }
    },

    "columns": [
        {"orderable": false},
        {"orderable": true},
        {"orderable": false}
    ],
    "order": [
        [1, "asc"]
    ],
});

function btn_edit_olahan(id,nama,tahun_olahan,bahan,jumlah) {
	submode = 'edit';
	$('#submode').val('edit');
	$('.btn-insert').hide();
	$('.btn-cancel').show();
	$('.btn-update').show();
	$('#bahanpoklahsar_id').val(id);
	$('#bahanpoklahsar_nama').val(nama);
	$('#tahun_olahan').val(tahun_olahan);
  $('#bahan').val(bahan);
	$('#jumlah').val(jumlah);
	$("#modal_form_poklahsar").scrollTop(0);
}

function btn_delete_olahan(id) {
	cancelEdit();
	var sure = confirm('Apakah Anda yakin?');
	if (sure) {
		$.post('<?php echo site_url() ?>poklahsar/delete_olahan', {id:id}, function(res) {
			if (res.stat) {
				table_olahan.ajax.reload();
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
$('.datepicker').datepicker({
   rtl: App.isRTL(),
   orientation: "left",
   format: 'dd MM yyyy',
   autoclose: true
});
</script>
