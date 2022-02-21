<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-kuisioner', function(e) {
            e.preventDefault();
            $('#inpnis').attr('required', 'required');
            $('#inpnama').attr('required', 'required');
            $('#inpidagama').attr('required', 'required');
            $('#inpkelamin').attr('required', 'required');
            $('#inptmplahir').attr('required', 'required');
            $('#inptgllahir').attr('required', 'required');
            $('#inpalamat').attr('required', 'required');
            $('#inportuwali').attr('required', 'required');
            $('#inpstatus').attr('required', 'required');
            $("[name='1_inpjawaban']").attr('required', 'required');

            // untuk validasi kusioner
            $("input[id='inpidkusionersoal']").each(function(i) {
                $("[name='" + i + "_inpjawaban']").attr('required', 'required');
            });

            if ($('#inpstatus').val() === '1') {
                $('#inptahunlulus').attr('required', 'required');
            }

            if ($('#form-kuisioner').parsley().isValid() == true) {
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
                        $('#save').html('Menunggu...');
                    },
                    success: function(response) {
                        swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            })
                            .then((value) => {
                                location.reload();
                            });
                        $('#save').removeAttr('disabled');
                        $('#save').html('Simpan');
                    }
                })
            }
        });
    }();

    // untuk status
    var untukMetodePembayaran = function() {
        $(document).on('change', '#inpstatus', function() {
            var ini = $(this);
            var val = ini.val();
            if (val == '1') {
                $('#tahun_lulus').attr('style', 'width: 100%');
            } else {
                $('#tahun_lulus').attr('style', 'display: none');
            }
        });
    }();
</script>