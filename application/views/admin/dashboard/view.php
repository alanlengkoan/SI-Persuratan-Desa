<!-- begin:: breadcumb -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h4 class="m-b-10"><?= $halaman ?></h4>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="feather icon-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#!">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end:: breadcumb -->

<!-- begin:: content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <!-- begin:: subscribe -->
                    <div class="col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-block text-center">
                                <i class="feather icon-users text-c-blue d-block f-40"></i>
                                <h4 class="m-t-20"><span class="text-c-blue"><?= count($guru) ?></span>&nbsp;Guru</h4>
                                <p class="m-b-20">Jumlah Guru.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-block text-center">
                                <i class="feather icon-users text-c-blue d-block f-40"></i>
                                <h4 class="m-t-20"><span class="text-c-blue"><?= count($aktif) ?></span>&nbsp;Siswa Aktif</h4>
                                <p class="m-b-20">Jumlah Siswa Akif.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-block text-center">
                                <i class="feather icon-users text-c-blue d-block f-40"></i>
                                <h4 class="m-t-20"><span class="text-c-blue"><?= count($alumni) ?></span>&nbsp;Siswa Alumni</h4>
                                <p class="m-b-20">Jumlah Alumni.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end:: subscribe -->

                    <!-- begin:: tentang -->
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Selamat Datang</h5>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-lg-6 text-justify">
                                        <p>
                                            Salam Sejahtera Bagi Kita Semua.
                                        </p>
                                        <p>
                                            Puji syukur kami panjatkan kepada Tuhan Yang maha Esa atas limpahan rahmat dan karunia-Nya sehingga SMA 12 TANA TORAJA berhasil membangun website, Kehadiran Website SMA 12 TANA TORAJA diharapkan dapat memudahkan penyampaian informasi secara terbuka kepada warga sekolah, alumni dan masyarakat serta instansi lain yang terkait.
                                        </p>
                                        <p>
                                            Semoga dengan kehadiran Website ini akan terjalin informasi, komunikasi antar alumni khususnya sebagai salah satu upaya sekolah mendapatkan informasi akan penelusuran tamatan/ alumni dimana saja berada. Dapat memperoleh informasi dengan cepat sehingga dapat mengikuti perkembangan dalam pengetahuan yang berkembang dengan cepat pula.
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <img class="img-fluid" src="http://localhost/si/SI-Akademik-Sekolah/public/assets/page/img/banner-bg.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: tentang -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->