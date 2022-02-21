<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    // untuk ubah akun
    var untukUbahAkun = function() {
        $('#form-akun').submit(function(e) {
            e.preventDefault();
            $('#inpnama').attr('required', 'required');
            $('#inpemail').attr('required', 'required');
            $('#inpusername').attr('required', 'required');

            if ($('#form-akun').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save-akun').attr('disabled', 'disabled');
                        $('#save-akun').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
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
                    }
                })
            }
        });
    }();

    // untuk ubah keamanan
    var untukUbahKeamanan = function() {
        $('#form-keamanan').submit(function(e) {
            e.preventDefault();
            $('#inppasswordlama').attr('required', 'required');
            $('#inppasswordbaru').attr('required', 'required');
            $('#inpkonfirmasipassword').attr('required', 'required');

            if ($('#form-keamanan').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save-keamanan').attr('disabled', 'disabled');
                        $('#save-keamanan').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
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
                    }
                })
            }
        });
    }();
</script>