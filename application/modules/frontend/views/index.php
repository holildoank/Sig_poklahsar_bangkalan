<!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyAEiG71d_YngHRJxYJyauz0q6Ko3eog97o" type="text/javascript"></script> -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAEiG71d_YngHRJxYJyauz0q6Ko3eog97o&amp;libraries=places&amp;language=id"></script>

<div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                  <div class="page-content">
                      <div class="c-content-contact-1 c-opt-1">
                                <div class="col-md-12">
                                    <div class="caption">
                                        <i class=" icon-layers font-blue"></i>
                                        <span class="caption-subject font-blue bold uppercase">Peta</span>
                                    </div>
                                  <div id="map" class="c-content-contact" style="height: 615px;">Loding......</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
       var myOptions = {
       zoom: 13,
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
             marker.setIcon({ url: "<?php echo base_url() ?>/assets/custom/scripts/master/index.jpg", scaledSize: new google.maps.Size(30, 24) , anchor: new google.maps.Point(15, 12)});
             markers.push(marker);
             var infowindow= new google.maps.InfoWindow({
                 content:"Kelompok Poklahsar :<?php echo $a->poklahsar_nama; ?><br>Pemilik :<?php echo $a->pemilik; ?><br>Alamat :<?php echo $a->alamat_poklahsar;?><br> Telpon :<?php echo $a->hp_poklahsar;?>  :",
                 size: new google.maps.Size(18,18),
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
