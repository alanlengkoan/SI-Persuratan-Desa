<script src="<?= assets_url() ?>admin/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/jszip.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/pdfmake.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/vfs_fonts.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/extensions/key-table/js/dataTables.keyTable.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script>
    let tabelDataDt = null;

    // untuk datatable
    var untukTabel = function() {
        tabelDataDt = $('#tabel-surat-keluar').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>laporan/get_data_surat_keluar_dt',
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini"
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-info',
                    text: '<i class="fa fa-copy"></i>&nbsp;Copy',
                     title: function() {
                        return 'Sistem Informasi Desa Bonto Tangnga - Laporan Surat Keluar';
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel-o"></i>&nbsp;Excel',
                     title: function() {
                        return 'Sistem Informasi Desa Bonto Tangnga - Laporan Surat Keluar';
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf-o"></i>&nbsp;Pdf',
                     title: function() {
                        return 'Sistem Informasi Desa Bonto Tangnga - Laporan Surat Keluar';
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-file-o"></i>&nbsp;CSV',
                     title: function() {
                        return 'Sistem Informasi Desa Bonto Tangnga - Laporan Surat Keluar';
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa fa-print"></i>&nbsp;Print',
                     title: function() {
                        return 'Sistem Informasi Desa Bonto Tangnga - Laporan Surat Keluar';
                    }
                }
            ],
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Nomor Surat',
                    data: 'no_surat',
                    className: 'text-center',
                },
                {
                    title: 'Tanggal Surat',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return tglIndo(full.tgl_surat);
                    },
                },
                {
                    title: 'Tanggal Keluar',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return tglIndo(full.tgl_keluar);
                    },
                },
                {
                    title: 'Jenis Surat',
                    data: 'jenis_surat',
                    className: 'text-center',
                },
                {
                    title: 'Tujuan Surat',
                    data: 'tujuan_surat',
                    className: 'text-center',
                },
                {
                    title: 'Sifat Surat',
                    data: 'sifat_surat',
                    className: 'text-center',
                },
            ],
        });
    }();
</script>