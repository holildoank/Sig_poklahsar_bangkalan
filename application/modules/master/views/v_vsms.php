<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="javascript:;">Data Visi Misi</a>
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
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="fa fa-c "></i>
                            <span class="caption-subject bold uppercase"><?php echo $judul ?>
                                <?php if (in_array('xcreate_vsms', $ar_haklistakses)): ?>
                                        <button type="button" class="btn btn-success btn-sm" name="button" id="btn_add_vsms"><i class="fa fa-plus"></i> Tambah</button>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <br><br><br>
                        <table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="tabel_vsms">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Isi </th>
                                    <th>Jenis</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

</div>
<div id="modal_vsms" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div>
<span id="site_url" data-site-url="<?php echo site_url() ?>"></span>
<script type="text/javascript">
var flash_notif_type = <?php echo json_encode($this->session->flashdata('notif_type')) ?>;
if (flash_notif_type == 'success') {
    var flash_notif_pesan = <?php echo json_encode($this->session->flashdata('notif_pesan')) ?>;
    NotifikasiToast({
        type : 'success', // success,warning,info,error
        msg : flash_notif_pesan,
        title : 'Sukses',
    });
}
$('.fancybox').fancybox({
    openEffect  : 'elastic',
        closeEffect : 'elastic',

        helpers : {
            title : {
                type : 'inside'
            }
        }
});

tabel_vsms = $('#tabel_vsms').DataTable({
    buttons: [
        { extend: 'pdf', className: 'btn green ' },
        { extend: 'excel', className: 'btn yellow ' },
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('master_visi_misi/list')?>",
        "type": "POST",
        data: function (d) {
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
    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

});
  $("#btn_add_vsms").click(function(e) {
  	e.preventDefault();
      $(".portlet").LoadingOverlay("show");
  	$("#modal_vsms").load('<?php echo site_url(); ?>master_visi_misi/create/',function() {
  		$(this).modal("show");
          $(".portlet").LoadingOverlay("hide");
  	});
  });

  function btn_edit_vsms(id) {
      $(".portlet").LoadingOverlay("show");
  	$("#modal_vsms").load('<?php echo site_url(); ?>master_visi_misi/update/'+id,function() {
  		$(this).modal("show");
          $(".portlet").LoadingOverlay("hide");
  	});
  }
function btn_delete_vsms(id) {
            swal(
                {
                    title: "Apakah Anda yakin?",
                    text: "Data Visi Misi  ini akan dihapus.",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: "btn-default",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Delete it!",
                    closeOnConfirm: false
                },
                function(){
                    $.post('<?php echo site_url() ?>/master_visi_misi/delete/'+id, {}, function(res) {
                        tabel_vsms.ajax.reload();
                        swal({
                            title: "Terhapus!",
                            text: "data Visi / Misi  berhasil dihapus.",
                            type: "success",
                            confirmButtonClass: "btn-success"
                        });
                    });
                }
            );
}

</script>
