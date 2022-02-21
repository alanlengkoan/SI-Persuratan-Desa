<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<title>Selamat Datang | <?= $halaman ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Sistem Informasi Akademik Sekolah" />
	<meta name="keywords" content="Sistem Informasi Akademik Sekolah" />
	<meta name="author" content="Sistem Informasi Akademik Sekolah" />

	<link rel="shortcut icon" type="image/x-icon" href="<?= assets_url() ?>admin/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" />
	<link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/linearicons.css" />
	<link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/magnific-popup.css" />
	<link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/nice-select.css" />
	<link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/animate.min.css" />
	<link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/owl.carousel.css" />
	<link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/main.css" />

	<!-- begin:: css local -->
	<?php empty($css) ? '' : $this->load->view($css); ?>
	<!-- end:: css local -->

	<style>
		.parsley-errors-list {
			color: red;
			list-style-type: none;
			padding: 0;
		}
	</style>

	<script src="<?= assets_url() ?>page/js/vendor/jquery-2.2.4.min.js"></script>
</head>

<body>
	<!-- begin:: header -->
	<header id="header" id="home">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">
						<ul>
							<li><?= (empty(get_sistem_detail()->facebook) ? '-' : '<a href="' . get_sistem_detail()->facebook . '"><i class="fa fa-facebook"></i></a>') ?></li>
							<li><?= (empty(get_sistem_detail()->instagram) ? '-' : '<a href="' . get_sistem_detail()->instagram . '"><i class="fa fa-instagram"></i></a>') ?></li>
							<li><?= (empty(get_sistem_detail()->twitter) ? '-' : '<a href="' . get_sistem_detail()->twitter . '"><i class="fa fa-twitter"></i></a>') ?></li>
							<li><?= (empty(get_sistem_detail()->youtube) ? '-' : '<a href="' . get_sistem_detail()->youtube . '"><i class="fa fa-youtube"></i></a>') ?></li>
						</ul>
					</div>
					<div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
						<a href="tel:+953 012 3654 896"><span class="lnr lnr-phone-handset"></span> <span class="text"><?= (empty(get_sistem_detail()->telepon) ? '-' : get_sistem_detail()->telepon) ?></span></a>
						<a href="mailto:smansatumappak@yahoo.com"><span class="lnr lnr-envelope"></span> <span class="text"><?= (empty(get_sistem_detail()->email) ? '-' : get_sistem_detail()->email) ?></span></a>
					</div>
				</div>
			</div>
		</div>
		<div class="container main-menu">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
					<a href="<?= base_url() ?>"><img src="<?= assets_url() ?>admin/images/logo.png" alt="logo" title="logo" width="70px" /></a>
				</div>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<li>
							<a href="<?= base_url() ?>">Beranda</a>
						</li>
						<li>
							<a href="<?= base_url() ?>berita">Berita</a>
						</li>
						<li>
							<a href="<?= base_url() ?>galeri">Galeri</a>
						</li>
						<li>
							<a href="<?= base_url() ?>tentang">Tentang</a>
						</li>
						<li>
							<a href="<?= base_url() ?>kontak">Kontak</a>
						</li>
						<?php if ($dana->num_rows() !== 0) { ?>
							<li class="menu-has-children"><a href="">Laporan</a>
								<ul>
									<?php foreach ($dana->result() as $row) { ?>
										<li><a href="<?= base_url() ?>laporan/<?= base64url_encode($row->id_dana) ?>"><?= $row->nama ?></a></li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>
						<li class="menu-has-children"><a href="">Profil</a>
							<ul>
								<li><a href="<?= base_url() ?>guru">Guru</a></li>
								<li><a href="<?= base_url() ?>fasilitas">Fasilitas</a></li>
								<li><a href="<?= base_url() ?>organisasi">Organisasi</a></li>
								<?php if ($profil->num_rows() !== 0) { ?>
									<?php foreach ($profil->result() as $row) { ?>
										<li><a href="<?= base_url() ?>profil/<?= base64url_encode($row->id_profil) ?>"><?= $row->profil ?></a></li>
									<?php } ?>
								<?php } ?>
							</ul>
						</li>
						<li class="menu-has-children"><a href="">Siswa</a>
							<ul>
								<li><a href="<?= base_url() ?>siswa/aktif">Aktif</a></li>
								<li><a href="<?= base_url() ?>siswa/alumni">Alumni</a></li>
							</ul>
						</li>
						<?php if ($kuisioner->num_rows() !== 0) { ?>
							<li class="menu-has-children"><a href="">Kuisioner</a>
								<ul>
									<?php foreach ($kuisioner->result() as $row) { ?>
										<li><a href="<?= base_url() ?>kuisioner/<?= base64url_encode($row->id_kuisioner) ?>"><?= $row->nama ?></a></li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>
						<?php if ($this->session->userdata('id_users')) { ?>
							<li class="menu-has-children"><a href=""><?= get_users_detail($this->session->userdata('id'))->nama ?></a>
								<ul>
									<?php foreach ($kuisioner->result() as $row) { ?>
										<li><a href="<?= base_url() ?>akun">Profil</a></li>
										<li><a href="<?= logout_url() ?>">Keluar</a></li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>
					</ul>
				</nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header>
	<!-- end:: header -->

	<!-- begin:: content -->
	<?php $this->load->view($content); ?>
	<!-- end:: content -->

	<!-- begin:: footer -->
	<footer class="footer-area">
		<div class="container">
			<div class="footer-bottom row align-items-center justify-content-between">
				<p class="footer-text m-0 col-lg-6 col-md-12">
					Copyright &copy;
					<script>
						document.write(new Date().getFullYear());
					</script>
					<a href="https://alanlengkoan.netlify.app/" target="_blank">AL</a> - Sistem Informasi Akademik Sekolah.
				</p>
				<div class="col-lg-6 col-sm-12 footer-social">
					<?= (empty(get_sistem_detail()->facebook) ? '-' : '<a href="' . get_sistem_detail()->facebook . '"><i class="fa fa-facebook"></i></a>') ?>
					<?= (empty(get_sistem_detail()->instagram) ? '-' : '<a href="' . get_sistem_detail()->instagram . '"><i class="fa fa-instagram"></i></a>') ?>
					<?= (empty(get_sistem_detail()->twitter) ? '-' : '<a href="' . get_sistem_detail()->twitter . '"><i class="fa fa-twitter"></i></a>') ?>
					<?= (empty(get_sistem_detail()->youtube) ? '-' : '<a href="' . get_sistem_detail()->youtube . '"><i class="fa fa-youtube"></i></a>') ?>
				</div>
			</div>
		</div>
	</footer>
	<!-- end:: footer -->

	<!-- begin:: modal buku tamu -->
	<div class="modal fade" id="modal-buku-tamu" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Silahkan Isi Buku Tamu kami.</h4>
				</div>
				<form id="form-buku-tamu" action="<?= base_url() ?>access_session/save" method="POST">
					<div class="modal-body">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">Nama *</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">Jenis kelamin *</label>
							<div class="col-sm-12">
								<select class="form-control" name="kelamin" id="kelamin">
									<option value="">- Pilih -</option>
									<option value="L">Laki - laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">Telepon *</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="telepon" id="telepon" placeholder="Masukkan telepon" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">Email *</label>
							<div class="col-sm-12">
								<input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">Alamat *</label>
							<div class="col-sm-12">
								<textarea class="form-control" name="alamat" id="alamat" placeholder="Masukkan alamat" rows="5" cols="5"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">Keperluan *</label>
							<div class="col-sm-12">
								<textarea class="form-control" name="keperluan" id="keperluan" placeholder="Masukkan keperluan" rows="5" cols="5"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-sm" id="save"><i class="fa fa-save"></i>&nbsp;Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end:: modal buku tamu -->

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/easing.min.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/hoverIntent.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/superfish.min.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.ajaxchimp.min.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.tabs.min.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/jquery.nice-select.min.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/mail-script.js"></script>
	<script type="text/javascript" src="<?= assets_url() ?>page/js/main.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<script>
		loadBukuTamu()

		function loadBukuTamu() {
			$.ajax({
				type: 'GET',
				url: '<?= base_url() ?>access_session',
				dataType: 'json',
				success: function(response) {
					if (response.check === 0) {
						$('#modal-buku-tamu').modal({
							backdrop: 'static',
							keyboard: false
						});
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					var errorMsg = 'Request Ajax Gagal : ' + xhr.responseText;
					console.log(errorMsg);
				}
			});
		}

		setInterval(function() {
			loadBukuTamu()
		}, 5000);

		// untuk submit
		var untukSubmit = function() {
			$('#form-buku-tamu').submit(function(e) {
				e.preventDefault();

				$('#nama').attr('required', 'required');
				$('#kelamin').attr('required', 'required');
				$('#telepon').attr('required', 'required');
				$('#email').attr('required', 'required');
				$('#alamat').attr('required', 'required');
				$('#keperluan').attr('required', 'required');

				if ($('#form-buku-tamu').parsley().isValid() == true) {
					$.ajax({
						method: $(this).attr('method'),
						url: $(this).attr('action'),
						data: new FormData(this),
						contentType: false,
						processData: false,
						dataType: 'json',
						beforeSend: function() {
							$('#save').attr('disabled', 'disabled');
							$('#save').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
						},
						success: function(data) {
							swal({
								title: data.title,
								text: data.text,
								icon: data.type,
								button: data.button,
							}).then((value) => {
								location.reload();
							});
						}
					})
				}
			});
		}();
	</script>

	<!-- begin:: js local -->
	<?php empty($js) ? '' : $this->load->view($js); ?>
	<!-- end:: js local -->
</body>

</html>