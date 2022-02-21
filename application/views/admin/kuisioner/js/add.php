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
    let tabelKuisionerSoalDt = null;

    // untuk datatable
    var untukTabelKuisionerSoal = function() {
        tabelKuisionerSoalDt = $('#tabel-kuisioner-soal').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>kuisioner/get_data_kuisioner_soal_dt/<?= base64url_encode($kuisioner->id_kuisioner) ?>',
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Soal',
                    data: 'soal',
                    className: 'text-center',
                },
                {
                    title: 'Pilihan A',
                    data: 'pil_a',
                    className: 'text-center',
                },
                {
                    title: 'Pilihan B',
                    data: 'pil_b',
                    className: 'text-center',
                },
                {
                    title: 'Pilihan C',
                    data: 'pil_c',
                    className: 'text-center',
                },
                {
                    title: 'Pilihan E',
                    data: 'pil_d',
                    className: 'text-center',
                },
                {
                    title: 'Pilihan E',
                    data: 'pil_e',
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
                                <button type="button" id="btn-upd" data-id="` + full.id_kuisioner_soal + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>
                                <button type="button" id="btn-del" data-id="` + full.id_kuisioner_soal + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
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
            $('#inpidkuisionersoal').val('');
            $('#inpsoal').val('');
            $('#inppila').val('');
            $('#inppilb').val('');
            $('#inppilc').val('');
            $('#inppild').val('');
            $('#inppile').val('');
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#inpsoal').attr('required', 'required');
            $('#inppila').attr('required', 'required');
            $('#inppilb').attr('required', 'required');
            $('#inppilc').attr('required', 'required');
            $('#inppild').attr('required', 'required');
            $('#inppile').attr('required', 'required');

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
                                tabelKuisionerSoalDt.ajax.reload();
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
                url: "<?= admin_url() ?>kuisioner/get_soal",
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
                    $('#inpidkuisionersoal').val(response.id_kuisioner_soal);
                    $('#inpsoal').val(response.soal);
                    $('#inppila').val(response.pil_a);
                    $('#inppilb').val(response.pil_b);
                    $('#inppilc').val(response.pil_c);
                    $('#inppild').val(response.pil_d);
                    $('#inppile').val(response.pil_e);

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
                })
                .then((del) => {
                    if (del) {
                        $.ajax({
                            type: "post",
                            url: "<?= admin_url() ?>kuisioner/process_del_soal",
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
                                        tabelKuisionerSoalDt.ajax.reload();
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