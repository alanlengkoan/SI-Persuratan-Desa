<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <!-- begin:: profil sidebar -->
        <div class="">
            <div class="main-menu-header">
                <img class="img-menu-user img-radius" src="<?= (get_users_detail($this->session->userdata('id'))->foto !== null ? upload_url('gambar') . '' . get_users_detail($this->session->userdata('id'))->foto : "//placehold.co/150") ?>" alt="User-Profile-Image">
                <div class="user-details">
                    <p id="more-details"><?= get_users_detail($this->session->userdata('id'))->nama ?></p>
                </div>
            </div>
        </div>
        <!-- end:: profil sidebar -->
        <!-- begin:: menu sidebar -->
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === null ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Master</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'tentang' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>tentang">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Profil</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'agama' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>agama">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Agama</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'pekerjaan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>pekerjaan">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Pekerjaan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'jenis_surat' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>jenis_surat">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Jenis Surat</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'sifat_surat' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>sifat_surat">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Sifat Surat</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'asal_surat' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>asal_surat">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Asal Surat</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'tujuan_surat' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>tujuan_surat">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Tujuan Surat</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Pustaka</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'keluarga' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>keluarga">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Keluarga</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'keluarga_anggota' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>keluarga_anggota">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Anggota Keluarga</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'surat_masuk' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>surat_masuk">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Surat Masuk</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'surat_keluar' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>surat_keluar">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Surat Keluar</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Laporan</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(3) === 'surat_masuk' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/surat_masuk">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Surat Masuk</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'surat_keluar' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/surat_keluar">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Surat Keluar</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'penduduk' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/penduduk">
                    <span class="pcoded-micon">
                        <i class="fa fa-circle"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Penduduk</span>
                </a>
            </li>
        </ul>
        <!-- end:: menu sidebar -->
    </div>
</nav>