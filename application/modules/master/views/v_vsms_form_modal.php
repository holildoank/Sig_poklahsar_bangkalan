<?php
if($mode=='edit'){
	$dt = $data_visi->row();
}
?>
<div class="modal-dialog ">
	<div class="modal-content modal-lg">
		<div class="modal-header ">
			<button type="button" class="close" onclick="event.preventDefault(); closeModal();"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
			<form class="horizontal-form" id="vsms">
				<div class="form-body">
					<div class="alert alert-danger display-hide">
						<button class="close" data-close="alert"></button> Silahkan Lengkapi Form yang bertanda *.
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							<label class="control-label">Silahkan Pilih Jenis  *</label>
								<select class="form-control" name="tipe_vs">
									<option value="v" <?php echo @$dt->tipe_vs=='v' ? 'selected' : '' ?>>Visi</option>
									<option value="m" <?php echo @$dt->tipe_vs=='m' ? 'selected' : '' ?>>Misi</option>
								</select>
								</div>
							<div class="form-group">
								<label class="control-label">Isi  *</label>
								<!-- <textarea name="nm_vis"  id="nm_vis" rows="3" cols="3" class="form-control" value=""> <?php echo @$dt->nm_vis ?></textarea>
> -->
								<input type="text" name="nm_vis" class="form-control" value="<?php echo @$dt->nm_vis ?>" />
							</div>

						</div>
					</div>
				</div>
				<br>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-9">
							<?php if ($mode=='add'): ?>
								<button type="button" class="btn dark btn-outline" onclick="event.preventDefault(); closeModal();">Batal</button>
								<button type="submit" class="btn blue">Tambah</button>
							<?php elseif ($mode=='edit'): ?>
								<input type="hidden" name="id" value="<?php echo @$dt->id_vis ?>">
								<button type="button" class="btn dark btn-outline" onclick="event.preventDefault(); closeModal();">Batal</button>
								<button type="submit" class="btn green">Update</button>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<span id="mode" data-mode="<?php echo $mode ?>"></span>
<script src="<?php echo base_url() ?>assets/custom/scripts/master/validation_vsms.js" type="text/javascript"></script>
