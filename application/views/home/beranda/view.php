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
        </ul>
    </nav>
</header>

<section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container" data-aos="zoom-in" data-aos-delay="100">
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum voluptatibus, similique quod esse, labore illum consequatur perspiciatis blanditiis commodi officiis nobis incidunt ratione, dolore maiores! Labore odio cumque animi nemo!
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
                        <img src="<?= upload_url() ?>gambar/<?= $row->gambar ?>" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-8 pt-4 pt-lg-0 content">
                        <?= $row->isi ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</main>
<!-- end:: main -->