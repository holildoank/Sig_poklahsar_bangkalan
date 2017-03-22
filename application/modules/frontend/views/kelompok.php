<div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <div class="page-container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="portlet light bordered">
                          <div class="portlet-title">
                              <div class="caption font-dark">
                                  <span class="caption-subject bold uppercase">Data kelompok Poklahsar </span>
                              </div>
                          </div>
                          <div class="portlet-body">
                              <table class="table table-striped  table-checkable table-hover dt-responsive" width="100%" id="tabel_poklahsar">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama</th>
                                          <th>Pemilik</th>
                                          <th>Alamat</th>
                                          <th>Olahan</th>
                                          <th>Opsi</th>
                                      </tr>
                                  </thead>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
</div>
<script type="text/javascript">
tabel_poklahsar = $('#tabel_poklahsar').DataTable({
  buttons: [

  ],
  "processing": true,
  "serverSide": true,
  "ajax": {
      "url": "<?php echo site_url() ?>kelompokPk/list_pk",
      "type": "post",
      data: function (d) {
      }
  },
  "columns": [
      {"orderable": false},
      {"orderable": true},
      {"orderable": true},
      {"orderable": true},
      {"orderable": false},
      {"orderable": false}
  ],
  "order": [
      [1, "asc"]
  ],
  "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
});
</script>
