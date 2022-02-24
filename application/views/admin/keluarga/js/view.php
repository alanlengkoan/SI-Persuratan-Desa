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
    let tabelKeluargaDt = null;

    // untuk datatable
    var untukTabelKeluarga = function() {
        tabelKeluargaDt = $('#tabel-keluarga').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>keluarga/get_data_keluarga_dt',
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
                    title: 'Alamat',
                    data: 'alamat',
                    className: 'text-center',
                },
                {
                    title: 'RT/RW',
                    data: 'rt_rw',
                    className: 'text-center',
                },
                {
                    title: 'Kode Pos',
                    data: 'kd_pos',
                    className: 'text-center',
                },
                {
                    title: 'Desa/Kelurahan',
                    data: 'desa_kelurahan',
                    className: 'text-center',
                },
                {
                    title: 'Kecamatan',
                    data: 'kecamatan',
                    className: 'text-center',
                },
                {
                    title: 'Kabupaten/Kota',
                    data: 'kabupaten_kota',
                    className: 'text-center',
                },
                {
                    title: 'Provinsi',
                    data: 'provinsi',
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
                            <button type="button" id="btn-upd" data-id="` + full.id_keluarga + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>&nbsp;
                            <button type="button" id="btn-del" data-id="` + full.id_keluarga + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        </div>
                    `;
                    },
                },
            ],
        });
    }();

    // untuk validasi nomor kk
    var untukValidasiNomorKK = function() {
        $('#inpnokk').on('keyup', function() {
            let no_kk = $(this).val();

            $.ajax({
                url: '<?= admin_url() ?>keluarga/check_no_kk',
                type: 'POST',
                typeData: 'JSON',
                data: {
                    q: no_kk,
                    my_csrf_token: csrf.val()
                },
                success: function(response) {
                    csrf.val(response.csrf);
                    if (no_kk.length > 0) {
                        if (response.status === true) {
                            $('#validasi').css('color', 'red').html('Nomor KK sudah ada!');
                            $('#save').attr('disabled', true);
                        } else {
                            $('#validasi').css('color', 'green').html('Nomor KK belum ada!');
                            $('#save').attr('disabled', false);
                        }
                    } else {
                        $('#validasi').css('color', 'black').html('Masukkan Nomor KK yang berbeda!');
                        $('#save').attr('disabled', true);
                    }
                }
            });
        });
    }();

    // untuk reset form
    var untukResetForm = function() {
        $(document).on('click', '#btn-add', function() {
            $('#judul-add-upd').html('Tambah');
            $('#inpnokk').val('');
            $('#inpnmkk').val('');
            $('#inpalamat').val('');
            $('#inprtrw').val('');
            $('#inpkdpos').val('');
            $('#inpdesakel').val('');
            $('#inpkec').val('');
            $('#inpkabkot').val('');
            $('#inpprovinsi').val('');
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#inpnokk').attr('required', 'required');
            $('#inpnmkk').attr('required', 'required');
            $('#inpalamat').attr('required', 'required');
            $('#inprtrw').attr('required', 'required');
            $('#inpkdpos').attr('required', 'required');
            $('#inpdesakel').attr('required', 'required');
            $('#inpkec').attr('required', 'required');
            $('#inpkabkot').attr('required', 'required');
            $('#inpprovinsi').attr('required', 'required');

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
                            tabelKeluargaDt.ajax.reload();
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
                url: "<?= admin_url() ?>keluarga/get",
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
                    $('#inpidkeluarga').val(response.id_keluarga);
                    $('#inpnokk').val(response.no_kk);
                    $('#inpnmkk').val(response.nama_kk);
                    $('#inpalamat').val(response.alamat);
                    $('#inprtrw').val(response.rt_rw);
                    $('#inpkdpos').val(response.kd_pos);
                    $('#inpdesakel').val(response.desa_kelurahan);
                    $('#inpkec').val(response.kecamatan);
                    $('#inpkabkot').val(response.kabupaten_kota);
                    $('#inpprovinsi').val(response.provinsi);

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
                        url: "<?= admin_url() ?>keluarga/process_del",
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
                                tabelKeluargaDt.ajax.reload();
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