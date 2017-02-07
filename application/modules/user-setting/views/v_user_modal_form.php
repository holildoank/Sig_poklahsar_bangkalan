<?php
if($mode=='edit'){
	$dt = $data_user->row();
}
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header <?php echo $mode=='add' ? 'modal-add' : 'modal-edit' ?>">
			<button type="button" class="close" onclick="event.preventDefault(); closeModal();"></button>
			<h4 class="modal-title"><?php echo $judul ?></h4>
		</div>
		<div class="modal-body">
			<?php if ($mode=='edit' && !$isValid): ?>
				<h1>Data Tidak Ditemukan</h1>
			<?php else: ?>
				<form class="horizontal-form" id="<?php echo $mode=='add' ? 'form_user_add' : 'form_user_edit' ?>">
	    			<div class="form-body">
	                    <div class="alert alert-danger display-hide">
	                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
	                    </div>
	                    <div class="row">
	    					<div class="col-md-12">
								<div class="form-group">
	                                <label class="control-label">User Group *</label>
									<select class="form-control" name="usergroup_id" style="width:100%">
										<option></option>
										<?php foreach ($data_usergroup->result() as $r): ?>
											<?php $terpilih = $r->usergroup_id==@$dt->usergroup_id ? 'selected' : '' ?>
											<?php echo '<option value="'.$r->usergroup_id.'" '.$terpilih.'>'.$r->usergroup_nama.'</option>' ?>
										<?php endforeach; ?>
									</select>
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label">User Name *</label>
	                                <input type="text" name="user_username" class="form-control" value="<?php echo @$dt->user_username ?>" placeholder="User Name" />
	                            </div>
								<div class="form-group">
	                                <label class="control-label">Password <?php echo $mode=='add' ? '*' : '' ?></label>
	                                <input type="password" name="user_password" id="user_password" class="form-control" value="" placeholder="Password" />
									<span class="help-block">Kosongkan jika tidak ingin mengubah Password sebelumnya.</span>
	                            </div>
								<?php if ($mode=='add'): ?>
									<div class="form-group">
										<label class="control-label">Ulangi Password *</label>
										<input type="password" name="retype_user_password" class="form-control" placeholder="Ulangi Password" />
									</div>
								<?php endif; ?>
								<div class="form-group">
	                                <label class="control-label">Aktif *</label>
									<select class="form-control" name="user_active">
										<option value="y" <?php echo @$dt->user_active=='y' ? 'selected' : '' ?>>Ya</option>
										<option value="t" <?php echo @$dt->user_active=='t' ? 'selected' : '' ?>>Tidak</option>
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
									<input type="hidden" name="id" value="<?php echo @$dt->user_id ?>">
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
<script src="<?php echo base_url() ?>/assets/custom/scripts/user-setting/j_user.js" type="text/javascript"></script>
