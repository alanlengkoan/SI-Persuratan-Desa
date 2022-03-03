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

    // untuk textarea editor
    CKEDITOR.replace('inpisi', {
        language: 'en',
    });

    // untuk datatable
    var untukTabelSuratKeluar = function() {
        tabelSuratKeluarDt = $('#tabel-surat-keluar').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= users_url() ?>surat_keluar/get_data_surat_keluar_dt',
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
                        return `<span class="badge badge-` + status[full.approve][1] + `">` + status[full.approve][0] + `</span>`;
                    },
                },
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        if (full.approve === '0') {
                            return `
                                <div class="button-icon-btn button-icon-btn-cl">
                                    <button type="button" id="btn-upd" data-id="` + full.id_surat_keluar + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>&nbsp;
                                </div>
                            `;
                        } else {
                            return `
                                <div class="button-icon-btn button-icon-btn-cl">
                                    <a href="<?= users_url() ?>surat_keluar/detail/` + btoa(full.id_surat_keluar) + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-info"></i>&nbsp;Detail</a>&nbsp;
                                    <a href="<?= users_url() ?>surat_keluar/print/` + btoa(full.id_surat_keluar) + `" target="_blank" class="btn btn-primary btn-sm waves-effect"><i class="fa fa-print"></i>&nbsp;Cetak</a>&nbsp;
                                    <button type="button" id="btn-upd" data-id="` + full.id_surat_keluar + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>&nbsp;
                                </div>
                            `;
                        }
                    },
                },
            ],
        });
    }();

    // untuk reset form
    var untukResetForm = function() {
        $(document).on('click', '#btn-add', function() {
            $('#judul-add-upd').html('Tambah');
            $('#inpidsuratkeluar').val('');
            $('#inpnosurat').val('');
            $('#inptglsurat').val('');
            $('#inptglkeluar').val('');
            $('#inpidsuratjenis').val('');
            $('#inpidsurattujuan').val('');
            $('#inpidsuratsifat').val('');
            $('#inpperihal').val('');
            CKEDITOR.instances.inpisi.setData('');
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#inpnosurat').attr('required', 'required');
            $('#inptglsurat').attr('required', 'required');
            $('#inptglkeluar').attr('required', 'required');
            $('#inpidsuratjenis').attr('required', 'required');
            $('#inpidsurattujuan').attr('required', 'required');
            $('#inpidsuratsifat').attr('required', 'required');
            $('#inpperihal').attr('required', 'required');
            $('#inparsip').attr('required', 'required');

            if ($('#form-add-upd').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save').attr('disabled', 'disabled');
                        $('#save').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        swal({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            button: response.button,
                        }).then((value) => {
                            $('#modal-add-upd').modal('hide');
                            csrf.val(response.csrf);
                            tabelSuratKeluarDt.ajax.reload();
                        });

                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                })
            }
        });
    }();

    // untuk get id
    var untukGetIdData = function() {
        $(document).on('click', '#btn-upd', function() {
            var ini = $(this);

            $.ajax({
                type: "POST",
                url: "<?= users_url() ?>surat_keluar/get",
                dataType: 'json',
                data: {
                    id: ini.data('id'),
                    my_csrf_token: csrf.val(),
                },
                beforeSend: function() {
                    $('#judul-add-upd').html('Ubah');

                    ini.attr('disabled', 'disabled');
                    ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                },
                success: function(response) {
                    csrf.val(response.csrf);

                    $('#inpidsuratkeluar').val(response.id_surat_keluar);
                    $('#inpnosurat').val(response.no_surat);
                    $('#inptglsurat').val(response.tgl_surat);
                    $('#inptglkeluar').val(response.tgl_keluar);
                    $('#inpidsuratjenis').val(response.id_surat_jenis);
                    $('#inpidsurattujuan').val(response.id_surat_tujuan);
                    $('#inpidsuratsifat').val(response.id_surat_sifat);
                    $('#inpperihal').val(response.perihal);
                    CKEDITOR.instances.inpisi.setData(response.isi);

                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-pencil"></i>&nbsp;Ubah');
                }
            });
        });
    }();
</script>