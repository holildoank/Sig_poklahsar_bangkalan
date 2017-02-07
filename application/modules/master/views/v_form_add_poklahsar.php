<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBRHsKqP4FdJEtV7Se5EWWRg8USK3_VpLA"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/library/css/jquery-gmaps-latlon-picker.css"/>
<script src="<?php echo base_url() ?>assets/library/js/jquery-gmaps-latlon-picker.js"></script>
<link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<?php if($mode=='edit'){
     $dt=$data_poklahsar->row();
}
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-bar">
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="<?php echo site_url() ?>poklahsar">Data Poklahsar</a>
                    <i class="fa fa-circle"></i>
                </li>

            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">

                        <!-- <div class="actions">
                            <div class="btn-group">
                                <a class="btn green btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            </div>
                        </div> -->
                    </div>
                    <div class="portlet-body">
                        <form class="horizontal-form" id="form_poklahsar" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> Silahkan Cek form di bawah ini
                                </div>
                                <div class="row">
                                    <div class="col-md-6">

                					</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> Name Poklahsar *</label>
                                            <input type="text" name="poklahsar_nama" id="poklahsar_nama" class="form-control" value="<?php echo @$dt->poklahsar_nama ?>" placeholder="Nama Poklahsar" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> Alamat *</label>
                                            <input type="text" name="alamat_poklahsar" id="alamat_poklahsar" class="form-control" value="<?php echo @$dt->alamat_poklahsar ?>" placeholder="Alamat " />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Jumlah Produk *</label>
                                            <input type="text" name="jumproduk_tahun" id="jumproduk_tahun" class="form-control" value="<?php echo @$dt->jumproduk_tahun ?>" placeholder="Jumlah Produk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Telpon *</label>
                                            <input type="text" name="hp_poklahsar" id="hp_poklahsar" class="form-control" value="<?php echo @$dt->hp_poklahsar ?>" placeholder="Telpon " />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="control-label">Pilih Inputan Lokasi </label>
                                              <div class="mt-radio-list">
                                                  <label class="mt-radio mt-radio-outline">Nama Lokasi
                                                      <input type="radio" value="1" name="nm_lokasi" id="nm_lokasi" checked>
                                                      <span></span>
                                                  </label>
                                                  <label class="mt-radio mt-radio-outline">Titik Kordinat
                                                      <input type="radio" value="2" name="nm_lokasi" id="nm_lokasi">
                                                      <span></span>
                                                  </label>
                                              </div>
                                        </div>
                                        <div class="lokasi_nama">
                                          <div class="form-group">
                                              <div class="gllpLatlonPicker">
                                                  <div class="titik_kordinat" id="titik_kordinat">
                                                		<div class="col-md-8">
                                                		    <div class="form-group">
                                                          <input type="text" class="gllpSearchField form-control" placeholder="Masukan Lokasi ">
                                                		    </div>
                                                		</div>
                                                    <div class="col-md-4">
                                                        <div class="form-group ">
                                                            <input type="button" class="gllpSearchButton btn green" value="search">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="gllpMap">Google Maps</div>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <div class="form-group">
                                                          <label class="control-label">Latitude</label>
                                                          <input type="text" class="gllpLatitude form-control" name="lat" value="<?php echo @$dt->lat ?>"/>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <div class="form-group">
                                                          <label class="control-label">Longitude</label>
                                                          <input type="text" class="gllpLongitude form-control" name="long" value="<?php echo @$dt->long ?>"/>
                                                      </div>
                                                  </div>
                                                          <input type="hidden" class="gllpZoom form-control" value="3"/>
                                          		<br/>
                                          	</div>
                                          </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-9">
                                        <?php
                                        if($mode=='add') {
                                            echo '<button type="submit" class="btn blue">Save</button>';
                                        }
                                        elseif($mode=='edit') {
                                            echo '<input type="hidden" name="id" value="'.@$dt->poklahsar_id.'">';
                                            echo '<button type="submit" class="btn green">Update</button>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<span id="mode" data-mode="<?php echo $mode ?>"></span>
<span id="site_url" data-site-url="<?php echo site_url() ?>"></span>
<script src="<?php echo base_url() ?>assets/custom/scripts/master/validation_poklahsar.js" type="text/javascript"></script>

<script type="text/javascript">
$.fn.select2.defaults.set( "theme", "bootstrap" );


$(function(){
  $('.titik_kordinat').show();
    $('[name="nm_lokasi"]').click(function(){
      var nm_lokasi = $(this).prop('value');
      if(nm_lokasi == 1){
					$('.titik_kordinat').show();
				}else if(nm_lokasi==2){
					$('.titik_kordinat').hide();
				}
        });
    });


$('.date-picker').datepicker({
    rtl: App.isRTL(),
    orientation: "left",
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    autoclose: true
});

$(document).ready( function() {
	if (!$.gMapsLatLonPickerNoAutoInit) {
		$(".gllpLatlonPicker").each(function () {
			$obj = $(document).gMapsLatLonPicker();
			$obj.init( $(this) );
		});
	}
});


</script>
