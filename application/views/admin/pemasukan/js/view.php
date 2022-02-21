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
    let tabelPemasukanDt = null;

    // untuk datatable
    var untukTabelPemasukan = function() {
        tabelPemasukanDt = $('#tabel-pemasukan').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>pemasukan/get_data_pemasukan_dt',
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Dana',
                    data: 'dana',
                    className: 'text-center',
                },
                {
                    title: 'Uraian',
                    data: 'uraian',
                    className: 'text-center',
                },
                {
                    title: 'Masuk (Debit)',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return autoSeparator(full.debit)
                    },
                },
                {
                    title: 'Tanggal',
                    data: 'tanggal',
                    className: 'text-center',
                },
                {
                    title: 'Keterangan',
                    data: 'keterangan',
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
                            <button type="button" id="btn-upd" data-id="` + full.id_keuangan_rincian + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>
                            <button type="button" id="btn-del" data-id="` + full.id_keuangan_rincian + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
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
            $('#idkeuanganrincian').val('');
            $('#inpiddana').val('');
            $('#inpidkeuangan').val('');
            $('#inpdebit').val('');
            $('#inpketerangan').val('');
            $('#inptgl').val('');
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#inpiddana').attr('required', 'required');
            $('#inpidkeuangan').attr('required', 'required');
            $('#inpdebit').attr('required', 'required');
            $('#inpketerangan').attr('required', 'required');
            $('#inptgl').attr('required', 'required');

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
                                tabelPemasukanDt.ajax.reload();
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
                url: "<?= admin_url() ?>pemasukan/get",
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
                    $('#idkeuanganrincian').val(response.id_keuangan_rincian);
                    $('#inpiddana').val(response.id_dana);
                    $('#inpidkeuangan').val(response.id_keuangan);
                    $('#inpdebit').val(autoSeparator(response.debit));
                    $('#inpketerangan').val(response.keterangan);
                    $('#inptgl').val(response.tanggal);

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
                            url: "<?= admin_url() ?>pemasukan/process_del",
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
                                        tabelPemasukanDt.ajax.reload();
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