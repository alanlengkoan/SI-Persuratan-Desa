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
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
    let tabelFasilitasDt = null;

    // untuk datatable fasilitas
    var untukTabelFasilitas = function() {
        tabelFasilitasDt = $('#tabel-fasilitas').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>fasilitas/get_data_fasilitas_dt',
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    className: 'text-center',
                },
                {
                    title: 'Gambar',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return `<img src="<?= upload_url('gambar') ?>` + full.gambar + `" width="100" heigth="100" />`
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
                            <button type="button" id="btn-upd" data-id="` + full.id_fasilitas + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>
                            <button type="button" id="btn-del" data-id="` + full.id_fasilitas + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        </div>
                    `;
                    },
                },
            ],
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#inpnama').attr('required', 'required');
            $('#inpgambar').attr('required', 'required');
            $('#inpketerangan').attr('required', 'required');

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
                            })
                            .then((value) => {
                                $('#modal-add-upd').modal('hide');
                                tabelFasilitasDt.ajax.reload();
                            });
                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                })
            }
        });
    }();

    // untuk get id fasilitas
    var untukGetIdFasilitas = function() {
        $(document).on('click', '#btn-upd', function() {
            var ini = $(this);

            $.ajax({
                type: "POST",
                url: "<?= admin_url() ?>fasilitas/get_data_fasilitas",
                dataType: 'json',
                data: {
                    id: ini.data('id')
                },
                beforeSend: function() {
                    $('#judul-add-upd').html('Ubah');
                    ini.attr('disabled', 'disabled');
                    ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                },
                success: function(response) {
                    $('#lihat_gambar').html(`<img src="<?= upload_url('gambar') ?>` + response.gambar + `" width="100" heigth="100" />`);
                    $('#lihat_gambar').attr('style', 'padding-bottom: 10px');

                    $('#centang_gambar').html(`<div class="checkbox-fade fade-in-default"><label><input type="checkbox" name="ubah_gambar_fasilitas" id="ubah_gambar_fasilitas" /><span class="cr"><i class="cr-icon icofont icofont-ui-check txt-default"></i></span><span>Ubah Gambar!</span></label></div>`);
                    $('#centang_gambar').attr('style', 'padding-top: 10px');

                    $('#inpidrumah').val(response.id_rumah);
                    $('#inpidfasilitas').val(response.id_fasilitas);
                    $('#inpnama').val(response.nama);
                    $('#inpketerangan').val(response.keterangan);
                    $('#inpgambar').attr('disabled', 'disabled');
                    $('#inpgambar').removeAttr('id');

                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-pencil"></i>&nbsp;Ubah');
                }
            });
        });
    }();

    // untuk reset form fasilitas
    var untukResetFormFasilitas = function() {
        $(document).on('click', '#btn-add', function() {
            $('#judul-add-upd').html('Tambah');
            $('#inpidfasilitas').val('');
            $('#inpnama').val('');
            $('#inpketerangan').val('');
            $("input[name*='inpgambar']").removeAttr('disabled');
            $("input[name*='inpgambar']").attr('id', 'inpgambar');
            $('#inpgambar').val('');
            $('#lihat_gambar').empty();
            $('#lihat_gambar').removeAttr('style');
            $('#centang_gambar').empty();
            $('#centang_gambar').removeAttr('style');
        });
    }();

    // untuk ubah gambar
    var untukUbahGambarFasilitas = function() {
        $(document).on('click', '#ubah_gambar_fasilitas', function() {
            var ini = $(this);
            if (ini.is(':checked')) {
                $("input[name*='inpgambar']").removeAttr('disabled');
                $("input[name*='inpgambar']").attr('id', 'inpgambar');
            } else {
                $("input[name*='inpgambar']").attr('disabled', 'disabled');
                $("input[name*='inpgambar']").removeAttr('id');
                $("input[name*='inpgambar']").removeAttr('required');
            }
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
                })
                .then((del) => {
                    if (del) {
                        $.ajax({
                            type: "post",
                            url: "<?= admin_url() ?>fasilitas/process_del",
                            dataType: 'json',
                            data: {
                                id: ini.data('id')
                            },
                            beforeSend: function() {
                                ini.attr('disabled', 'disabled');
                                ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                            },
                            success: function(data) {
                                swal({
                                        title: data.title,
                                        text: data.text,
                                        icon: data.type,
                                        button: data.button,
                                    })
                                    .then((value) => {
                                        tabelFasilitasDt.ajax.reload();
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