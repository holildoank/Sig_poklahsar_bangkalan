<?php
if($mode=='edit'){
	$dt = $data_menu->row();
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
				<form class="horizontal-form" id="form_menu">
	    			<div class="form-body">
	                    <div class="alert alert-danger display-hide">
	                        <button class="close" data-close="alert"></button> You have some form errors. Please check below.
	                    </div>
	                    <div class="row">
	    					<div class="col-md-12">
								<div class="form-group">
	                                <label class="control-label">Kode Menu *</label>
	                                <input type="text" name="menu_kode" class="form-control" value="<?php echo @$dt->menu_kode ?>" placeholder="Kode Menu" />
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label">Nama Menu *</label>
	                                <input type="text" name="menu_nama" class="form-control" value="<?php echo @$dt->menu_nama ?>" placeholder="Nama Menu" />
	                            </div>
								<div class="form-group">
	                                <label class="control-label">Keterangan</label>
									<textarea class="form-control" name="menu_ket" rows="2" placeholder="Keterangan"><?php echo @$dt->menu_ket ?></textarea>
	                            </div>
								<div class="form-group">
	                                <label class="control-label">Url *</label>
	                                <input type="text" name="menu_url" class="form-control" value="<?php echo @$dt->menu_url ?>" placeholder="Url" />
	                            </div>
								<div class="form-group">
	                                <label class="control-label">Icon</label>
	                                <input type="text" name="menu_icon" class="form-control" value="<?php echo @$dt->menu_icon ?>" placeholder="Icon" />
									<span class="help-block">ex: fa fa-plus (or you can check to <a href="http://fontawesome.io/icons/" target="_blank">fontawesome.io</a> website)</span>
								</div>
								<div class="form-group">
	                                <label class="control-label">Parent *</label>
									<?php if ($mode=='add'): ?>
										<select class="form-control" name="menu_parent" style="width:100%">
											<option></option>
											<option value="0">This is Parent</option>
											<?php foreach ($data_parent->result() as $r): ?>
												<?php echo '<option value="'.$r->menu_id.'">'.$r->menu_nama.'</option>' ?>
											<?php endforeach; ?>
										</select>
									<?php elseif ($mode=='edit'): ?>
										<select class="form-control" name="menu_parent" style="width:100%">
											<option></option>
											<option value="0" <?php echo @$dt->menu_parent==0 ? 'selected' : ''; ?>>This is Parent</option>
											<?php foreach ($data_parent->result() as $r): ?>
												<?php if ($r->menu_id!=@$dt->menu_id): ?>
													<?php $terpilih = $r->menu_id==@$dt->menu_parent ? 'selected' : '' ?>
													<?php echo '<option value="'.$r->menu_id.'" '.$terpilih.'>'.$r->menu_nama.'</option>' ?>
												<?php endif; ?>
											<?php endforeach; ?>
										</select>
									<?php endif; ?>
	                            </div>
								<div class="form-group">
	                                <label class="control-label">Aktif *</label>
									<select class="form-control" name="menu_active">
										<option value="y" <?php echo @$dt->menu_active=='y' ? 'selected' : '' ?>>Ya</option>
										<option value="t" <?php echo @$dt->menu_active=='t' ? 'selected' : '' ?>>Tidak</option>
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
									<input type="hidden" name="id" value="<?php echo @$dt->menu_id ?>">
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
<script src="<?php echo base_url() ?>assets/custom/scripts/user-setting/j_menu.js" type="text/javascript"></script>
