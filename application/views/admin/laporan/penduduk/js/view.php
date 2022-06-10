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
        tabelDataDt = $('#tabel-penduduk').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>laporan/get_data_penduduk_dt',
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini"
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-info',
                    text: '<i class="fa fa-copy"></i>&nbsp;Copy',
                    title: function() {
                        return ' Sistem Informasi Desa Bonto Tangnga - Laporan Penduduk';
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel-o"></i>&nbsp;Excel',
                    title: function() {
                        return ' Sistem Informasi Desa Bonto Tangnga - Laporan Penduduk';
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf-o"></i>&nbsp;Pdf',
                    title: function() {
                        return ' Sistem Informasi Desa Bonto Tangnga - Laporan Penduduk';
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-file-o"></i>&nbsp;CSV',
                    title: function() {
                        return ' Sistem Informasi Desa Bonto Tangnga - Laporan Penduduk';
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa fa-print"></i>&nbsp;Print',
                    title: function() {
                        return ' Sistem Informasi Desa Bonto Tangnga - Laporan Penduduk';
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
                    title: 'No. KK',
                    data: 'no_kk',
                    className: 'text-center',
                },
                {
                    title: 'Nama KK',
                    data: 'nama_kk',
                    className: 'text-center',
                },
                {
                    title: 'No. KTP',
                    data: 'no_ktp',
                    className: 'text-center',
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    className: 'text-center',
                },
                {
                    title: 'Tanggal Lahir',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return tglIndo(full.tgl_lahir);
                    },
                },
                {
                    title: 'Umur',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return countAge(full.tgl_lahir);
                    },
                },
                {
                    title: 'Jenis Kelamin',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        let jenis_kelamin = {
                            'L': 'Laki - laki',
                            'P': 'Perempuan',
                        };
                        return (full.kelamin === null ? '-' : jenis_kelamin[full.kelamin]);
                    },
                },
                {
                    title: 'Status Nikah',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        let status_nikah = {
                            'y': 'Iya',
                            'n': 'Tidak',
                        };
                        return (full.status_nikah === null ? '-' : status_nikah[full.status_nikah]);
                    },
                },
            ],
        });
    }();
</script>