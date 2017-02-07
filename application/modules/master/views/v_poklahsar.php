<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="javascript:;">Data Poklahsar</a>
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
                              <?php if (in_array('xcreate_poklahsar', $ar_haklistakses)): ?>
                                      <a class="btn btn-success btn-sm" href="<?php echo site_url('poklahsar/create') ?>"><i class="fa fa-plus"></i> Tambah Baru </a>
                              <?php endif; ?>
                          </span>
                      </div>
                  </div>
                    <div class="portlet-body">
                        <?php if ($this->session->flashdata('not_found')): ?>
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                <strong>Warning!</strong> Data tidak ditemukan.
                            </div>
                        <?php endif; ?>
                        <table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="tabel_poklahsar">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Poklahsar</th>
                                    <th>Alamat </th>
                                    <th>Hp </th>
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

<div id="modal_form_poklahsar" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div>
<span id="site_url" data-site-url="<?php echo site_url() ?>"></span>
<!-- <div id="modal_view_kunjungan" class="modal fade bs-modal-lg" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div> -->
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
tabel_poklahsar = $('#tabel_poklahsar').DataTable({
    buttons: [
        // { extend: 'pdf', className: 'btn green ' },
        // { extend: 'excel', className: 'btn yellow ' },
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('poklahsar/list')?>",
        "type": "POST",
        data: function (d) {
        }
    },

    "columns": [
        {"orderable": false},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
        {"orderable": false}
    ],
    "order": [
        [1, "asc"]
    ],
    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

});

function btn_olahan(id) {
    $(".portlet").LoadingOverlay("show");
	$("#modal_form_poklahsar").load('<?php echo site_url(); ?>/poklahsar/olahan/'+id,function() {
		$(this).modal("show");
        $(".portlet").LoadingOverlay("hide");
	});
}

function btn_delete_poklahsar(id) {
            swal(
                {
                    title: "Apakah Anda yakin?",
                    text: "Data poklahsar ini akan dihapus.",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: "btn-default",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Delete it!",
                    closeOnConfirm: false
                },
                function(){
                    $.post('<?php echo site_url() ?>poklahsar/delete/'+id, {}, function(res) {
                        tabel_poklahsar.ajax.reload();
                        swal({
                            title: "Terhapus!",
                            text: "dara poklahsar  berhasil dihapus.",
                            type: "success",
                            confirmButtonClass: "btn-success"
                        });
                    });
                }
            );
}

</script>
