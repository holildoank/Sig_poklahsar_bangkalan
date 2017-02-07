<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="javascript:;">Master Pembayaran</a>
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
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"><?php echo $judul ?></span>
                        </div>
                        <div class="tools">
                            <?php if (in_array('xcreate_bayar', $ar_haklistakses)): ?>
                                <div class="btn-group">
                                    <a class="btn blue" href="javascript:;" data-toggle="dropdown">
                                        <i class="fa fa-plus"></i> Tambah
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#" id="btn_add_rutin">
                                                <i class="fa fa-plus"></i> Rutin </a>
                                        </li>
                                        <li>
                                            <a href="#" id="btn_add_insidental">
                                                <i class="fa fa-plus"></i> Insidental </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php if ($this->session->flashdata('type_notif')): ?>
                            <div class="alert alert-<?php echo $this->session->flashdata('type_notif') ?> alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                <?php echo $this->session->flashdata('pesan_notif'); ?>
                            </div>
                        <?php endif; ?>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1_1" data-toggle="tab"> Rutin </a>
                            </li>
                            <li>
                                <a href="#tab_1_2" data-toggle="tab"> Insidental </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="tab_1_1">
                                <br><br><br>
                                <table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="tabel_rutin">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Angkatan</th>
                                            <th>Jurusan</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tab_1_2">
                                <br><br><br>
                                <table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="tabel_insidental">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Angkatan</th>
                                            <th>Jurusan</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Premi</th>
                                            <th>Cicil?</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

<div id="modal_form" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div>
<span id="site_url" data-site-url="<?php echo site_url() ?>"></span>
<!-- <div id="modal_view_kunjungan" class="modal fade bs-modal-lg" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div> -->
<script type="text/javascript">
tabel_rutin = $('#tabel_rutin').DataTable({
    buttons: [
        { extend: 'pdf', className: 'btn green ' },
        { extend: 'excel', className: 'btn yellow ' },
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('bayar/list_rutin')?>",
        "type": "POST",
        data: function (d) {
        }
    },

    "columns": [
        {"orderable": false},
        {"orderable": true},
        {"orderable": true},
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

tabel_insidental = $('#tabel_insidental').DataTable({
    buttons: [
        { extend: 'pdf', className: 'btn green ' },
        { extend: 'excel', className: 'btn yellow ' },
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('bayar/list_insidental')?>",
        "type": "POST",
        data: function (d) {
        }
    },

    "columns": [
        {"orderable": false},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
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

$('#btn_add_rutin').click(function(e) {
    e.preventDefault();
    $(".portlet").LoadingOverlay("show");
	$("#modal_form").load('<?php echo site_url(); ?>bayar/create_modal_rutin',function() {
		$(this).modal("show");
        $(".portlet").LoadingOverlay("hide");
	});
});

$("#btn_add_insidental").click(function(e) {
	e.preventDefault();
    $(".portlet").LoadingOverlay("show");
	$("#modal_form").load('<?php echo site_url(); ?>bayar/create_insidental',function() {
		$(this).modal("show");
        $(".portlet").LoadingOverlay("hide");
	});
});

function btn_update_insidental(id) {
    $(".portlet").LoadingOverlay("show");
	$("#modal_form").load('<?php echo site_url(); ?>bayar/update_insidental/'+id,function() {
		$(this).modal("show");
        $(".portlet").LoadingOverlay("hide");
	});
}

function btn_delete(id) {
    swal(
        {
            title: "Apakah Anda yakin?",
            text: "Data Master Pembayaran ini akan dihapus.",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-default",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Delete it!",
            closeOnConfirm: true
        },
        function(){
            $.post('<?php echo site_url() ?>bayar/delete/'+id, function(res) {
                if (res.stat) {
                    tabel_rutin.ajax.reload();
                    tabel_insidental.ajax.reload();
                    swal({
                        title: "Terhapus!",
                        text: "data master pembayaran berhasil dihapus.",
                        type: "success",
                        confirmButtonClass: "btn-success"
                    });
                } else {
                    NotifikasiToast({
                        positionClass: 'toast-top-full-width',
                        type : 'error',
                        msg : res.pesan,
                        title : 'Gagal',
                    });
                }
            });
        }
    );
}

</script>
