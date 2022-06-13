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
    let tabelKeluargaAnggotaDt = null;

    // untuk datatable
    var untukTabelKeluargaAnggota = function() {
        tabelKeluargaAnggotaDt = $('#tabel-keluarga-anggota').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>keluarga_anggota/get_data_keluarga_anggota_dt',
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
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <div class="button-icon-btn button-icon-btn-cl">
                            <button type="button" id="btn-upd" data-id="` + full.id_keluarga_anggota + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>&nbsp;
                            <button type="button" id="btn-del" data-id="` + full.id_keluarga_anggota + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        </div>
                    `;
                    },
                },
            ],
        });
    }();

    // untuk validasi nomor ktp
    var untukValidasiNomorKTP = function() {
        $('#inpnoktp').on('keyup', function() {
            let no_kk = $(this).val();

            $.ajax({
                url: '<?= admin_url() ?>keluarga_anggota/check_no_ktp',
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
                            $('#validasi').css('color', 'red').html('Nomor NIK sudah ada!');
                            $('#save').attr('disabled', true);
                        } else {
                            $('#validasi').css('color', 'green').html('Nomor NIK belum ada!');
                            $('#save').attr('disabled', false);
                        }
                    } else {
                        $('#validasi').css('color', 'black').html('Masukkan Nomor NIK yang berbeda!');
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
            $('#validasi').css('color', 'black').html('Masukkan Nomor NIK yang berbeda!');
            $('#inpidkeluargaanggota').val('');
            $('#inpnokk').val('');
            $('#inpnoktp').val('');
            $('#inpnama').val('');
            $('#inpkelamin').val('');
            $('#inptmplahir').val('');
            $('#inptgllahir').val('');
            $('#inpidagama').val('');
            $('#inpidpekerjaan').val('');
            $('#inpkewarganegaraan').val('');
            $('#inpalamat').val('');
            $('#inppendidikan').val('');
            $('#inpstatusnikah').val('');
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#inpnokk').attr('required', 'required');
            $('#inpnoktp').attr('required', 'required');
            $('#inpnama').attr('required', 'required');
            $('#inpkelamin').attr('required', 'required');
            $('#inptmplahir').attr('required', 'required');
            $('#inptgllahir').attr('required', 'required');
            $('#inpidagama').attr('required', 'required');
            $('#inpidpekerjaan').attr('required', 'required');
            $('#inpkewarganegaraan').attr('required', 'required');
            $('#inpalamat').attr('required', 'required');
            $('#inppendidikan').attr('required', 'required');
            $('#inpstatusnikah').attr('required', 'required');

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
                            tabelKeluargaAnggotaDt.ajax.reload();
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
                url: "<?= admin_url() ?>keluarga_anggota/get",
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
                    $('#inpidkeluargaanggota').val(response.id_keluarga_anggota);
                    $('#inpnokk').val(response.no_kk);
                    $('#inpnoktp').val(response.no_ktp);
                    $('#inpnama').val(response.nama);
                    $('#inpkelamin').val(response.kelamin);
                    $('#inptmplahir').val(response.tmp_lahir);
                    $('#inptgllahir').val(response.tgl_lahir);
                    $('#inpidagama').val(response.id_agama);
                    $('#inpidpekerjaan').val(response.id_pekerjaan);
                    $('#inpkewarganegaraan').val(response.kewarganegaraan);
                    $('#inpalamat').val(response.alamat);
                    $('#inppendidikan').val(response.pendidikan);
                    $('#inpstatusnikah').val(response.status_nikah);

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
                        url: "<?= admin_url() ?>keluarga_anggota/process_del",
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
                                tabelKeluargaAnggotaDt.ajax.reload();
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