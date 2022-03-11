<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<title>Selamat Datang | <?= $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Sistem Informasi Persuratan Desa" />
	<meta name="keywords" content="Sistem Informasi Persuratan Desa" />
	<meta name="author" content="Sistem Informasi Persuratan Desa" />

	<link rel="shortcut icon" type="image/x-icon" href="<?= assets_url() ?>admin/images/favicon.ico" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link rel="stylesheet" href="<?= assets_url() ?>page/vendor/aos/aos.css" />
	<link rel="stylesheet" href="<?= assets_url() ?>page/vendor/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= assets_url() ?>page/vendor/bootstrap-icons/bootstrap-icons.css" />
	<link rel="stylesheet" href="<?= assets_url() ?>page/vendor/boxicons/css/boxicons.min.css" />
	<link rel="stylesheet" href="<?= assets_url() ?>page/vendor/glightbox/css/glightbox.min.css" />
	<link rel="stylesheet" href="<?= assets_url() ?>page/vendor/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="<?= assets_url() ?>page/css/style.css" />

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

	<!-- jquery -->

</head>

<body>
	<!-- begin:: content -->
	<?php $this->load->view($content); ?>
	<!-- end:: content -->

	<!-- begin:: footer -->
	<footer id="footer">
		<div class="container">
			<h3>Desa Bontotangnga</h3>
			<div class="social-links">
				<?= (empty(get_sistem_detail()->facebook) ? '-' : '<a href="' . get_sistem_detail()->facebook . '"><i class="bx bxl-facebook"></i></a>') ?>
				<?= (empty(get_sistem_detail()->instagram) ? '-' : '<a href="' . get_sistem_detail()->instagram . '"><i class="bx bxl-instagram"></i></a>') ?>
				<?= (empty(get_sistem_detail()->twitter) ? '-' : '<a href="' . get_sistem_detail()->twitter . '"><i class="bx bxl-twitter"></i></a>') ?>
				<?= (empty(get_sistem_detail()->youtube) ? '-' : '<a href="' . get_sistem_detail()->youtube . '"><i class="bx bxl-youtube"></i></a>') ?>
			</div>
			<div class="copyright">
				Copyright &copy;
				<script>
					document.write(new Date().getFullYear());
				</script>&nbsp;
				<a href="https://alanlengkoan.com" target="_blank">AL</a> - Sistem Informasi Persuratan Desa.
			</div>
			<div class="credits">
				Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
			</div>
		</div>
	</footer>
	<!-- end:: footer -->

	<div id="preloader"></div>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<script src="<?= assets_url() ?>page/vendor/purecounter/purecounter.js"></script>
	<script src="<?= assets_url() ?>page/vendor/aos/aos.js"></script>
	<script src="<?= assets_url() ?>page/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= assets_url() ?>page/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="<?= assets_url() ?>page/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="<?= assets_url() ?>page/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="<?= assets_url() ?>page/vendor/typed.js/typed.min.js"></script>
	<script src="<?= assets_url() ?>page/vendor/waypoints/noframework.waypoints.js"></script>
	<script src="<?= assets_url() ?>page/vendor/php-email-form/validate.js"></script>
	<script src="<?= assets_url() ?>page/js/main.js"></script>

	<!-- begin:: js local -->
	<?php empty($js) ? '' : $this->load->view($js); ?>
	<!-- end:: js local -->
</body>

</html>