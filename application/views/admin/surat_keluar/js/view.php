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
<script src="<?= assets_url() ?>admin/parsley-2.9.2/parsley.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
    let csrf = $('#<?= $this->security->get_csrf_token_name() ?>');
    let tabelSuratKeluarDt = null;

    // untuk datatable
    var untukTabelSuratKeluar = function() {
        tabelSuratKeluarDt = $('#tabel-surat-keluar').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>surat_keluar/get_data_surat_keluar_dt',
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini"
            },
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
                {
                    title: 'Approve',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        var status = [
                            [
                                'Belum disetujui',
                                'warning',
                            ],
                            [
                                'Telah disetujui',
                                'primary',
                            ],
                        ];
                        return `<button type="button" id="btn-approve" data-id="` + full.id_surat_keluar + `" data-value="` + full.approve + `" class="btn btn-` + status[full.approve][1] + ` btn-sm waves-effect"><i class="fa fa-toggle-on"></i>&nbsp;` + status[full.approve][0] + `</button>`;
                    },
                },
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <div class="button-icon-btn button-icon-btn-cl">
                            <a href="<?= admin_url() ?>surat_keluar/detail/` + btoa(full.id_surat_keluar) + `" target="_blank" class="btn btn-success btn-sm waves-effect"><i class="fa fa-info"></i>&nbsp;Detail</a>&nbsp;
                            <a href="<?= admin_url() ?>surat_keluar/print/` + btoa(full.id_surat_keluar) + `" target="_blank" class="btn btn-primary btn-sm waves-effect"><i class="fa fa-print"></i>&nbsp;Cetak</a>&nbsp;
                            <button type="button" id="btn-del" data-id="` + full.id_surat_keluar + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        </div>
                    `;
                    },
                },
            ],
        });
    }();

    // untuk ubah approve
    var untukUbahApprove = function() {
        $(document).on('click', '#btn-approve', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin ingin mengubah status?",
                text: "Berita tersebut akan berubah!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= admin_url() ?>surat_keluar/upd_approve",
                        dataType: 'json',
                        data: {
                            id: ini.data('id'),
                            value: ini.data('value'),
                            my_csrf_token: csrf.val(),
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                        },
                        success: function(response) {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            }).then((value) => {
                                csrf.val(response.csrf);
                                tabelSuratKeluarDt.ajax.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();

    // untuk hapus data
    var untukHapusData = function() {
        $(document).on('click', '#btn-del', function() {
            var ini = $(this);

            swal({
                title: "Apakah Anda yakin ingin menghapusnya?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= admin_url() ?>surat_keluar/process_del",
                        dataType: 'json',
                        data: {
                            id: ini.data('id'),
                            my_csrf_token: csrf.val(),
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                        },
                        success: function(response) {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            }).then((value) => {
                                csrf.val(response.csrf);
                                tabelSuratKeluarDt.ajax.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();
</script>