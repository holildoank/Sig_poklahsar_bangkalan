<!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyAEiG71d_YngHRJxYJyauz0q6Ko3eog97o" type="text/javascript"></script> -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAEiG71d_YngHRJxYJyauz0q6Ko3eog97o&amp;libraries=places&amp;language=id"></script>

<div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">

            <!-- BEGIN CONTAINER -->
            <div class="page-container">

                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                  <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                              <i class="fa fa-gift"></i>Form Pencarian
                             </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="#" class="form-horizontal">
                                <div class="form-body">
                                  <div class="form-group">
                                      <div class="col-md-6">
                                          <label class="control-label">Pilih Pencarian Asal</label>
                                              <div class="mt-radio-list">
                                                  <label class="mt-radio mt-radio-outline">Dari Database
                                                      <input type="radio" value="1" name="from_asal" id="from_asal" checked>
                                                      <span></span>
                                                  </label>
                                                  <label class="mt-radio mt-radio-outline">Manual
                                                      <input type="radio" value="2" name="from_asal" id="from_asal">
                                                      <span></span>
                                                  </label>
                                              </div>

                                              <div class="database_asal" id="database_asal">
                                                <select class="form-control" name="asal" id="asal">
                                                  <option value="">Pilih Lokasi Asal Anda</option>
                                                  <?php foreach ($get_data->result() as $r): ?>
                            												<?php echo '<option value="'.$r->lat.','.$r->long.'">'.$r->poklahsar_nama.' - '.$r->pemilik.'</option>' ?>
                            											<?php endforeach; ?>
                                                </select>
                                              </div>
                                              <div class="manual_asal" id="manual_asal">
                                                <input type="text" name='asal' id="asal" class="form-control input-circle" placeholder="Masukan Asal Tujuan">
                                                <span class="help-block"> Contoh : Gelora Bangkalan </span>
                                              </div>
                                      </div>
                                      <div class="col-md-6">
                                        <label class="control-label">Pilih Pencarian Tujuan</label>
                                            <div class="mt-radio-list">
                                                <label class="mt-radio mt-radio-outline">Dari Database
                                                    <input type="radio" value="1" name="tujuan_from" id="tujuan_from" checked>
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio mt-radio-outline">Manual
                                                    <input type="radio" value="2" name="tujuan_from" id="tujuan_from">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="database_tujuan" id="database_tujuan">
                                                <select class="form-control" name="tujuan" id="tujuan">
                                                  <option value="">Pilih Tujuan Anda</option>
                                                  <?php foreach ($get_data->result() as $r): ?>
                            												<?php echo '<option value="'.$r->lat.','.$r->long.'">'.$r->poklahsar_nama.' - '.$r->pemilik.'</option>' ?>
                            											<?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="manual_tujuan" id="manual_tujuan">
                                              <input type="text" name='tujuan' id="tujuan" class="form-control input-circle" placeholder="Masukan Tujuan Anda">
                                              <span class="help-block"> Contoh : UTM</span>
                                            </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" id="btn_cari" class="btn btn-circle green">Cari Route</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                  <div class="page-content">

                      <div class="c-content-contact-1 c-opt-1">
                            <!-- <div class="page-content-inner"> -->
                              <!-- <div class="c-content-contact-1 c-opt-1"> -->
                                    <div class="col-md-9">
                                        <div class="caption">
                                            <i class=" icon-layers font-blue"></i>
                                            <span class="caption-subject font-blue bold uppercase">Markers</span>
                                        </div>
                                      <div id="map" class="c-content-contact" style="height: 615px;">Loding......</div>
                                    </div>
                              <!-- </div> -->
                            <!-- </div> -->
                              <div class="col-md-3">
                                <div class="portlet light ">
                                      <div class="portlet-title">
                                          <div class="caption font-red-sunglo">
                                              <i class="icon-settings font-red-sunglo"></i>
                                              <span class="caption-subject bold uppercase "> Route Jalan</span>
                                          </div>
                                          <div id="panel"   style="width: 300px; float:left;"></div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <!-- END PAGE CONTENT INNER -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTAINER -->
        </div>
    </div>
    <script type="text/javascript">

    $(function(){
      $('.database_asal').show();
      $('.manual_asal').hide();
        $('[name="from_asal"]').click(function(){
          var from_asal = $(this).prop('value');
          if(from_asal == 1){
    					$('.database_asal').show();
              $('.manual_asal').hide();
    				}else if(from_asal==2){
    					$('.manual_asal').show();
              $('.database_asal').hide();
    				}
            });
        });

    $(function(){
      $('.database_tujuan').show();
      $('.manual_tujuan').hide();
        $('[name="tujuan_from"]').click(function(){
          var tujuan_from = $(this).prop('value');
          if(tujuan_from == 1){
    					$('.database_tujuan').show();
              $('.manual_tujuan').hide();
    				}else if(tujuan_from==2){
    					$('.manual_tujuan').show();
              $('.database_tujuan').hide();
    				}
            });
        });

      var directionsService = new google.maps.DirectionsService();
      var directionsDisplay = new google.maps.DirectionsRenderer();
      var latlng = new google.maps.LatLng(-7.036497864427332, 112.8573989868164);
      var markers=new Array();
      var infowindows=new Array();
      // var refreshId2 = setInterval(function(){navigator.geolocation.getCurrentPosition(foundLocation, noLocation);}, 10000);

       var myOptions = {
       zoom: 11,
       center: latlng,
       mapTypeId: google.maps.MapTypeId.ROADMAP
       };
      var map = new google.maps.Map(document.getElementById('map'),myOptions); {
       //  zoom:10,
        mapTypeId: google.maps.MapTypeId.ROADMAP

        <?php foreach ($get_data->result() as $a): ?>
            var marker= new google.maps.Marker({
                 position:new google.maps.LatLng(<?php echo $a->lat ?>, <?php echo $a->long; ?>),
                 map:map,
                 title:"Saya disini"
             });
             marker.setIcon({ url: "<?php echo base_url() ?>/assets/custom/scripts/master/logo.png", scaledSize: new google.maps.Size(30, 24) , anchor: new google.maps.Point(15, 12)});
             markers.push(marker);
             var infowindow= new google.maps.InfoWindow({
                 content:"Kelompok Poklahsar :<?php echo $a->poklahsar_nama; ?><br>Pemilik :<?php echo $a->pemilik; ?><br>Alamat :<?php echo $a->alamat_poklahsar;?><br> Telpon :<?php echo $a->hp_poklahsar;?>",
                 size: new google.maps.Size(20,20),
                 position:new google.maps.LatLng(<?php echo $a->lat; ?>, <?php echo $a->long; ?>)
             });
             infowindow.open(map);
             infowindows.push(infowindow);
        <?php endforeach; ?>
      }
      $('#btn_cari').click(function(e) {
      	e.preventDefault();
      	var rom = $('#asal').val();
      	var to = $('#tujuan').val();
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('panel'));
          var request = {
            origin: rom,
            destination: to,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
          };
          directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
            }
          });

      });
      //ma

    </script>
