<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="javascript:;">Setting User</a>
                    <i class="fa fa-circle"></i>
                </li>
				<li>
                    <a href="javascript:;">Menu</a>
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
                            <?php if (in_array('xcreate_menu', $ar_haklistakses)): ?>
                                <button type="button" class="btn btn-primary btn-sm" name="button" id="btn_add"><i class="fa fa-plus"></i> Tambah</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <br><br><br>
                        <table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Url</th>
                                    <th>Icon</th>
                                    <th>Parent</th>
                                    <th>Fitur</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
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

<div id="modal_form" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div>
<span id="site_url" data-site-url="<?php echo site_url() ?>"></span>
<!-- <div id="modal_view_kunjungan" class="modal fade bs-modal-lg" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div> -->
<script type="text/javascript">
table = $('#example').DataTable({
    buttons: [
        { extend: 'print', className: 'btn dark btn-outline' },
        { extend: 'copy', className: 'btn red btn-outline' },
        { extend: 'pdf', className: 'btn green btn-outline' },
        { extend: 'excel', className: 'btn yellow btn-outline ' },
        { extend: 'csv', className: 'btn purple btn-outline ' },
        { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('menu/list')?>",
        "type": "POST",
        data: function (d) {
        }
    },

    "columns": [
        {"orderable": false},
        {"orderable": true},
        {"orderable": true},
        {"orderable": false},
        {"orderable": true},
        {"orderable": false},
        {"orderable": true},
        {"orderable": false}
    ],
    "order": [
        [1, "asc"]
    ],
    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

});

$("#btn_add").click(function(e) {
	e.preventDefault();
    $(".portlet").LoadingOverlay("show");
	$("#modal_form").load('<?php echo site_url(); ?>/menu/create',function() {
		$(this).modal("show");
        $(".portlet").LoadingOverlay("hide");
	});

});

function btn_edit(id) {
    $(".portlet").LoadingOverlay("show");
	$("#modal_form").load('<?php echo site_url(); ?>/menu/update/'+id,function() {
		$(this).modal("show");
        $(".portlet").LoadingOverlay("hide");
	});
}

function btn_fitur(id) {
    $(".portlet").LoadingOverlay("show");
	$("#modal_form").load('<?php echo site_url(); ?>/menu/fitur/'+id,function() {
		$(this).modal("show");
        $(".portlet").LoadingOverlay("hide");
	});
}

function btn_delete(id) {
    $.post('<?php echo site_url() ?>menu/cek_paten', {id:id}, function(res) {
        if (res.stat) {
            $(".portlet").LoadingOverlay("hide");
            swal(
                {
                    title: "Dilarang!",
                    text: "Menu telah dipatenkan!",
                    type: "warning",
                    confirmButtonClass: "btn-default",
                    confirmButtonText: "Close",
                    closeOnConfirm: true
                }
            );
        } else {
            swal(
                {
                    title: "Apakah Anda yakin?",
                    text: "Menu akan dihapus.",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: "btn-default",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Delete it!",
                    closeOnConfirm: false
                },
                function(){
                    $.post('<?php echo site_url() ?>/menu/delete/'+id, {}, function(res) {
                        table.ajax.reload();
                        swal({
                            title: "Terhapus!",
                            text: "Menu berhasil dihapus.",
                            type: "success",
                            confirmButtonClass: "btn-success"
                        });
                    });
                }
            );
        }
    });

}

function btn_view(id) {
    $(".portlet").LoadingOverlay("show");
	$("#modal_form").load('<?php echo site_url(); ?>/menu/read/'+id,function() {
		$(this).modal("show");
        $(".portlet").LoadingOverlay("hide");
	});
}

</script>
