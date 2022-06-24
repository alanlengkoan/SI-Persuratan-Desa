<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Selamat Datang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Informasi Pemesanan" />
    <meta name="keywords" content="Sistem Informasi Pemesanan" />
    <meta name="author" content="Sistem Informasi Pemesanan" />

    <link rel="shortcut icon" href="<?= assets_url() ?>admin/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/pages/waves/css/waves.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/pages.css" />

    <style>
        #validasi {
            font-style: italic;
            font-size: 10px;
        }
    </style>
</head>

<body themebg-pattern="theme1">
    <!-- begin:: Pre-loader -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Pre-loader -->

    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?= form_open('auth/process_save', array('id' => 'form-register', 'class' => 'md-float-material form-material', 'method' => 'post')) ?>
                    <div class="text-center">
                        <img src="<?= assets_url() ?>admin/images/logo.png" alt="logo" width="100" />
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Register</h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <?= form_input(array('name' => 'nik', 'id' => 'nik', 'class' => 'form-control')) ?>
                                <span class="form-bar"></span>
                                <label class="float-label">NIK</label>
                                <span id="validasi">Masukkan Nomor KTP yang berbeda!</span>
                            </div>
                            <div class="form-group form-primary">
                                <?= form_input(array('type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control')) ?>
                                <span class="form-bar"></span>
                                <label class="float-label">E-mail</label>
                            </div>
                            <div class="form-group form-primary">
                                <?= form_input(array('type' => 'telepon', 'name' => 'telepon', 'id' => 'telepon', 'class' => 'form-control')) ?>
                                <span class="form-bar"></span>
                                <label class="float-label">No HP</label>
                            </div>
                            <div class="form-group form-primary">
                                <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => 'form-control')) ?>
                                <span class="form-bar"></span>
                                <label class="float-label">Username</label>
                            </div>
                            <div class="form-group form-primary">
                                <?= form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control')) ?>
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="forgot-phone text-left float-left">
                                        <a href="<?= login_url() ?>" class="text-left f-w-600">Telah Memilik Akun?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <?= form_input(array('type' => 'submit', 'name' => 'register', 'value' => 'Daftar', 'id' => 'register', 'class' => 'btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20')) ?>
                                    <a href="<?= base_url() ?>" class="btn btn-danger btn-md btn-block waves-effect waves-light text-center m-b-20">Batal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/waves/js/waves.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/common-pages.js"></script>
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    <script>
        let csrf = $("input[name='<?= $this->security->get_csrf_token_name() ?>']");

        var untukSubmit = function() {
            $('#form-register').parsley();

            $('#form-register').submit(function(e) {
                e.preventDefault();
                $('#nik').attr('required', 'required');
                $('#email').attr('required', 'required');
                $('#telepon').attr('required', 'required');
                $('#username').attr('required', 'required');
                $('#password').attr('required', 'required');

                if ($('#form-register').parsley().isValid() == true) {
                    $.ajax({
                        method: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: 'json',
                        beforeSend: function() {
                            $('#register').val('Wait');
                        },
                        success: function(response) {
                            $('#register').val('Register');

                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            }).then((value) => {
                                location.href = "<?= login_url() ?>";
                            });
                        }
                    })
                }
            });
        }();

        // untuk validasi nomor nik
        var untukValidasiNomorNIK = function() {
            $('#nik').on('keyup', function() {
                let no_kk = $(this).val();

                $.ajax({
                    url: '<?= base_url() ?>auth/check_no_ktp',
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
                                $('#validasi').css('color', 'green').html('Nomor KTP sudah terdaftar!');
                                $('#register').attr('disabled', false);
                            } else {
                                $('#validasi').css('color', 'red').html('Nomor KTP belum terdaftar!');
                                $('#register').attr('disabled', true);
                            }
                        } else {
                            $('#validasi').css('color', 'black').html('Masukkan Nomor KTP yang berbeda!');
                            $('#register').attr('disabled', false);
                        }
                    }
                });
            });
        }();
    </script>
</body>

</html>