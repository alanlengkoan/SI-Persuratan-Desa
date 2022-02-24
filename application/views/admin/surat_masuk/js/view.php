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

<script>
    let csrf = $('#<?= $this->security->get_csrf_token_name() ?>');
    let tabelSuratMasukDt = null;

    // untuk datatable
    var untukTabelSuratMasuk = function() {
        tabelSuratMasukDt = $('#tabel-surat-masuk').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>surat_masuk/get_data_surat_masuk_dt',
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
                    title: 'Tanggal Masuk',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return tglIndo(full.tgl_masuk);
                    },
                },
                {
                    title: 'Jenis Surat',
                    data: 'jenis_surat',
                    className: 'text-center',
                },
                {
                    title: 'Asal Surat',
                    data: 'asal_surat',
                    className: 'text-center',
                },
                {
                    title: 'Sifat Surat',
                    data: 'sifat_surat',
                    className: 'text-center',
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
                            <a href="<?= admin_url() ?>surat_masuk/detail/` + btoa(full.id_surat_masuk) + `" class="btn btn-primary btn-sm waves-effect"><i class="fa fa-info"></i>&nbsp;Detail</a>&nbsp;
                            <button type="button" id="btn-upd" data-id="` + full.id_surat_masuk + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>&nbsp;
                            <button type="button" id="btn-del" data-id="` + full.id_surat_masuk + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        </div>
                    `;
                    },
                },
            ],
        });
    }();

    // untuk reset form
    var untukResetForm = function() {
        $(document).on('click', '#btn-add', function() {
            $('#judul-add-upd').html('Tambah');
            $('#inpidsuratmasuk').val('');
            $('#inpnosurat').val('');
            $('#inptglsurat').val('');
            $('#inptglmasuk').val('');
            $('#inpidsuratjenis').val('');
            $('#inpidsuratasal').val('');
            $('#inpidsuratsifat').val('');
            $('#inpperihal').val('');
            $('#inparsiptipe').val('');
            $('#inparsip').val('');
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#inpnosurat').attr('required', 'required');
            $('#inptglsurat').attr('required', 'required');
            $('#inptglmasuk').attr('required', 'required');
            $('#inpidsuratjenis').attr('required', 'required');
            $('#inpidsuratasal').attr('required', 'required');
            $('#inpidsuratsifat').attr('required', 'required');
            $('#inpperihal').attr('required', 'required');
            $('#inparsiptipe').attr('required', 'required');
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
                            tabelSuratMasukDt.ajax.reload();
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
                url: "<?= admin_url() ?>surat_masuk/get",
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
                    $('#inpidsuratmasuk').val(response.id_surat_masuk);
                    $('#inpnosurat').val(response.no_surat);
                    $('#inptglsurat').val(response.tgl_surat);
                    $('#inptglmasuk').val(response.tgl_masuk);
                    $('#inpidsuratjenis').val(response.id_surat_jenis);
                    $('#inpidsuratasal').val(response.id_surat_asal);
                    $('#inpidsuratsifat').val(response.id_surat_sifat);
                    $('#inpperihal').val(response.perihal);
                    $('#inparsiptipe').val(response.arsip_tipe);

                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-pencil"></i>&nbsp;Ubah');
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
                        url: "<?= admin_url() ?>surat_masuk/process_del",
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
                                tabelSuratMasukDt.ajax.reload();
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