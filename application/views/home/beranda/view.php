<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

<header id="header" class="d-flex flex-column justify-content-center">
    <nav id="navbar" class="navbar nav-menu">
        <ul>
            <li>
                <a href="#hero" class="nav-link scrollto active"><i class="bx bx-circle"></i> <span>Home</span></a>
            </li>
            <?php foreach ($profil->result() as $row) { ?>
                <li>
                    <a href="#<?= strtolower($row->nama) ?>" class="nav-link scrollto"><i class="bx bx-circle"></i> <span><?= ucfirst($row->nama) ?></span></a>
                </li>
            <?php } ?>
            <li>
                <a href="#statistik" class="nav-link scrollto"><i class="bx bx-circle"></i> <span>Statistik</span></a>
            </li>
            <li>
                <a href="#tentang" class="nav-link scrollto"><i class="bx bx-circle"></i> <span>Tentang</span></a>
            </li>
            <li>
                <a href="<?= login_url() ?>" class="nav-link scrollto"><i class="bx bx-log-in"></i> <span>Login</span></a>
            </li>
        </ul>
    </nav>
</header>

<section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container" data-aos="zoom-in" data-aos-delay="100">
        <h1>Selamat Datang di Sistem Informasi Desa Bonto Tangnga</h1>
        <p>
            Sistem Informasi Desa Bonto Tangnga adalah suatu bentuk perwujudan dari kemajuan teknologi yang semakin canggih dan berkembang. Kecanggihan teknologi yang terus berkembang dan bergerak maju menjadikan manusia harus mampu beradaptasi dengan teknologi. Bentuk adaptasi yang dapat diwujudkan oleh manusia adalah menciptakan penciptaan yang dapat membantu urusan manusia. Sehingga teknologi yang ada mampu dimanfaatkan dan digunakan dengan maksimal dan pekerjaan manusia dapat diselesaikan.
        </p>
    </div>
</section>

<!-- begin:: main -->
<main id="main">
    <?php foreach ($profil->result() as $row) { ?>
        <section id="<?= strtolower($row->nama) ?>" class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2><?= $row->nama ?></h2>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <a href="<?= upload_url() ?>gambar/<?= $row->gambar ?>">
                            <img src="<?= upload_url() ?>gambar/<?= $row->gambar ?>" class="img-fluid" alt="<?= $row->nama ?>">
                        </a>
                    </div>
                    <div class="col-lg-8 pt-4 pt-lg-0 content">
                        <?= $row->isi ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <section id="statistik" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Statistik</h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <figure class="highcharts-figure">
                        <div id="grafik-penduduk"></div>
                    </figure>
                </div>
                <div class="col-lg-12">
                    <figure class="highcharts-figure">
                        <div id="grafik-pekerjaan"></div>
                    </figure>
                </div>
                <div class="col-lg-12">
                    <figure class="highcharts-figure">
                        <div id="grafik-umur"></div>
                    </figure>
                </div>
                <div class="col-lg-12">
                    <figure class="highcharts-figure">
                        <div id="grafik-kategori-umur"></div>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <section id="tentang" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Tentang</h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15887.286552468307!2d120.3551952368343!3d-5.444032075864519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbc0f404c79f7ff%3A0xa81d3feba23fba04!2sBonto%20Tangnga%2C%20Bontotiro%2C%20Kabupaten%20Bulukumba%2C%20Sulawesi%20Selatan!5e0!3m2!1sid!2sid!4v1647012685675!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-lg-6">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos perferendis modi pariatur itaque blanditiis consectetur sint quidem nam perspiciatis, minus obcaecati doloribus aliquid ipsum labore eos minima expedita, nemo tempore.
                </div>
            </div>
        </div>
    </section>
</main>
<!-- end:: main -->