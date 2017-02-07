<?php
if($mode=='edit'){
	$dt = $data_akses->row();
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
				<form class="horizontal-form" id="form_akses">
	    			<div class="form-body">
	                    <div class="alert alert-danger display-hide">
	                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
	                    </div>
	                    <div class="row">
	    					<div class="col-md-12">
								<?php if ($mode=='edit'): ?>
									<table class="table table-bordered table-striped">
		                                <tbody>
		                                    <tr>
		                                        <td style="width:15%"> User Group</td>
		                                        <td style="width:35%">
		                                            <span class="text-muted"><?php echo $dt->usergroup_nama ?></span>
		                                        </td>
		                                    </tr>
											<tr>
		                                        <td style="width:15%"> Menu</td>
		                                        <td style="width:35%">
		                                            <span class="text-muted"><?php echo $dt->menu_nama ?></span>
		                                        </td>
		                                    </tr>
		                                </tbody>
		                            </table>
									<div class="form-group">
									    <label class="control-label">List Fitur</label>
									    <div class="mt-checkbox-list">
											<?php $ar_listfitur = explode(',', @$dt->akses_listfitur); ?>
									        <?php foreach ($data_fitur->result() as $r): ?>
												<?php $terpilih = in_array($r->fitur_id, $ar_listfitur) ? 'checked' : '' ?>
									            <label class="mt-checkbox mt-checkbox-outline"> <?php echo $r->fitur_nama ?>
									                <input type="checkbox" value="<?php echo $r->fitur_id ?>" name="listfitur[]" <?php echo $terpilih ?> />
									                <span></span>
									            </label>
									        <?php endforeach; ?>
									    </div>
									</div>
								<?php elseif ($mode=='add'): ?>
									<div class="form-group">
		                                <label class="control-label">User Group *</label>
										<select class="form-control" name="usergroup_id" style="width:100%">
											<option></option>
											<?php foreach ($data_usergroup->result() as $r): ?>
												<?php echo '<option value="'.$r->usergroup_id.'">'.$r->usergroup_nama.'</option>' ?>
											<?php endforeach; ?>
										</select>
		                            </div>
									<div class="form-group">
										<label class="control-label">Menu *</label>
										<select class="form-control" name="menu_id" id="menu_id" style="width:100%">
											<option></option>
											<?php foreach ($data_menu->result() as $r): ?>
												<?php echo '<option value="'.$r->menu_id.'">'.$r->menu_nama.'</option>' ?>
											<?php endforeach; ?>
										</select>
		                            </div>
									<div class="content_listfitur">

									</div>
								<?php endif; ?>
								<div class="form-group">
	                                <label class="control-label">Aktif *</label>
									<select class="form-control" name="akses_active">
										<option value="y" <?php echo @$dt->akses_active=='y' ? 'selected' : '' ?>>Ya</option>
										<option value="t" <?php echo @$dt->akses_active=='t' ? 'selected' : '' ?>>Tidak</option>
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
									<input type="hidden" name="id" value="<?php echo @$dt->akses_id ?>">
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
<script src="<?php echo base_url() ?>assets/custom/scripts/user-setting/j_akses.js" type="text/javascript"></script>
