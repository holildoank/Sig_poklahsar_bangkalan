<?php
if($mode=='edit'){
	$dt = $data_usergroup->row();
}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header ">
			<button type="button" class="close" onclick="event.preventDefault(); closeModal();"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
			<?php if ($mode=='edit' && !$isValid): ?>
				<h1>Data Tidak Ditemukan</h1>
			<?php else: ?>
				<form class="horizontal-form" id="form_usergroup">
	    			<div class="form-body">
	                    <div class="alert alert-danger display-hide">
	                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
	                    </div>
	                    <div class="row">
	    					<div class="col-md-12">
	                            <div class="form-group">
	                                <label class="control-label">Nama Usergroup *</label>
	                                <input type="text" name="usergroup_nama" class="form-control" value="<?php echo @$dt->usergroup_nama ?>" placeholder="Nama User Group" />
	                            </div>
								<div class="form-group">
	                                <label class="control-label">Keterangan *</label>
									<textarea class="form-control" name="usergroup_ket" rows="2" placeholder="Keterangan"><?php echo @$dt->usergroup_ket ?></textarea>
	                            </div>
								<div class="form-group">
	                                <label class="control-label">Aktif *</label>
									<select class="form-control" name="usergroup_active">
										<option value="y" <?php echo @$dt->usergroup_active=='y' ? 'selected' : '' ?>>Ya</option>
										<option value="t" <?php echo @$dt->usergroup_active=='t' ? 'selected' : '' ?>>Tidak</option>
									</select>
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
									<input type="hidden" name="id" value="<?php echo @$dt->usergroup_id ?>">
									<button type="button" class="btn dark btn-outline" onclick="event.preventDefault(); closeModal();">Batal</button>
									<button type="submit" class="btn green">Update</button>
								<?php endif; ?>
	                        </div>
	                    </div>
	                </div>
	            </form>
			<?php endif; ?>
		</div>
	</div>
</div>
<span id="mode" data-mode="<?php echo $mode ?>"></span>
<script src="<?php echo base_url() ?>assets/custom/scripts/user-setting/j_usergroup.js" type="text/javascript"></script>
