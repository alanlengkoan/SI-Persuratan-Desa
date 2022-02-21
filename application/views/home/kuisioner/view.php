<!-- begin:: banner -->
<section class="about-banner relative" id="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?= $halaman ?>
                </h1>
                <p class="text-white link-nav"><a href="<?= base_url() ?>">Beranda </a> <span class="lnr lnr-arrow-right"></span> <a href="<?= base_url() ?>kontak"><?= $halaman ?></a></p>
            </div>
        </div>
    </div>
</section>
<!-- end:: banner -->

<!-- begin:: content -->
<section class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form id="form-kuisioner" action="<?= base_url() ?>kuisioner_simpan" method="post">
                    <div class="form-group">
                        <label>Nis&nbsp;*</label>
                        <input type="text" class="form-control form-control-sm" name="inpnis" id="inpnis" value="<?= $siswa->nis ?>" placeholder="Masukkan nis" />
                    </div>
                    <div class="form-group">
                        <label>Nama&nbsp;*</label>
                        <input type="text" class="form-control form-control-sm" name="inpnama" id="inpnama" value="<?= $siswa->nama ?>" placeholder="Masukkan nama" />
                    </div>
                    <div class="form-group">
                        <label>Agama&nbsp;*</label>
                        <select class="form-control form-control-sm" id="inpidagama" name="inpidagama">
                            <option value="">- Pilih -</option>
                            <?php foreach ($agama as $key => $value) { ?>
                                <option value="<?= $value->id_agama ?>" <?= ($siswa->id_agama === $value->id_agama ? 'selected' : '') ?>><?= $value->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin&nbsp;*</label>
                        <select class="form-control form-control-sm" name="inpkelamin" id="inpkelamin">
                            <option value="">- Pilih -</option>
                            <option value="L" <?= ($siswa->kelamin === 'L' ? 'selected' : '') ?>>Laki-Laki</option>
                            <option value="P" <?= ($siswa->kelamin === 'P' ? 'selected' : '') ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir&nbsp;*</label>
                        <input type="text" class="form-control form-control-sm" name="inptmplahir" id="inptmplahir" value="<?= $siswa->tmp_lahir ?>" placeholder="Masukkan tempat lahir" />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir&nbsp;*</label>
                        <input type="date" class="form-control form-control-sm" name="inptgllahir" id="inptgllahir" value="<?= $siswa->tgl_lahir ?>" />
                    </div>
                    <div class="form-group">
                        <label>Alamat&nbsp;*</label>
                        <textarea class="form-control form-control-sm" name="inpalamat" id="inpalamat" cols="30" rows="10" placeholder="Masukkan alamat"><?= $siswa->alamat ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Orang Tua Wali&nbsp;*</label>
                        <input type="text" class="form-control form-control-sm" name="inportuwali" id="inportuwali" value="<?= $siswa->ortu_wali ?>" placeholder="Masukkan orang tua wali" />
                    </div>
                    <div class="form-group">
                        <label>Status&nbsp;*</label>
                        <select class="form-control form-control-sm" name="inpstatus" id="inpstatus">
                            <option value="">- Pilih -</option>
                            <option value="0" <?= ($siswa->status === '0' ? 'selected' : '') ?>>Aktif</option>
                            <option value="1" <?= ($siswa->status === '1' ? 'selected' : '') ?>>Alumni</option>
                        </select>
                    </div>
                    <div class="form-group" id="tahun_lulus" <?= ($siswa->status === '1' ? '' : 'style="display: none"') ?>>
                        <label>Tahun Lulus&nbsp;*</label>
                        <input type="text" class="form-control form-control-sm" name="inptahunlulus" id="inptahunlulus" value="<?= $siswa->thn_lulus ?>" placeholder="Masukkan tahun lulus" />
                    </div>
                    <hr>
                    <!-- begin:: kuisioner -->
                    <?php foreach ($data->result() as $key => $row) { ?>
                        <input type="hidden" name="inpidkuisionersoal[]" id="inpidkuisionersoal" value="<?= $row->id_kuisioner_soal ?>">
                        <input type="hidden" name="inpidkuisionerhasil[]" id="inpidkuisionerhasil" value="<?= (empty($siswa_hasil[$row->id_kuisioner_soal]['id_kuisioner_hasil']) ? '' : $siswa_hasil[$row->id_kuisioner_soal]['id_kuisioner_hasil']) ?>">
                        <div class="form-group">
                            <label><?= $row->soal ?>&nbsp;*</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="<?= $key ?>_a" name="<?= $key ?>_inpjawaban" value="1" <?= (empty($siswa_hasil[$row->id_kuisioner_soal]['jawaban']) ? '' : ($siswa_hasil[$row->id_kuisioner_soal]['jawaban'] === '1' ? 'checked' : '')) ?> />
                                <label class="form-check-label" for="<?= $key ?>_a">
                                    A. <?= $row->pil_a ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="<?= $key ?>_b" name="<?= $key ?>_inpjawaban" value="2" <?= (empty($siswa_hasil[$row->id_kuisioner_soal]['jawaban']) ? '' : ($siswa_hasil[$row->id_kuisioner_soal]['jawaban'] === '2' ? 'checked' : '')) ?> />
                                <label class="form-check-label" for="<?= $key ?>_b">
                                    B. <?= $row->pil_b ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="<?= $key ?>_c" name="<?= $key ?>_inpjawaban" value="3" <?= (empty($siswa_hasil[$row->id_kuisioner_soal]['jawaban']) ? '' : ($siswa_hasil[$row->id_kuisioner_soal]['jawaban'] === '3' ? 'checked' : '')) ?> />
                                <label class="form-check-label" for="<?= $key ?>_c">
                                    C. <?= $row->pil_c ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="<?= $key ?>_d" name="<?= $key ?>_inpjawaban" value="4" <?= (empty($siswa_hasil[$row->id_kuisioner_soal]['jawaban']) ? '' : ($siswa_hasil[$row->id_kuisioner_soal]['jawaban'] === '4' ? 'checked' : '')) ?> />
                                <label class="form-check-label" for="<?= $key ?>_d">
                                    D. <?= $row->pil_d ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="<?= $key ?>_e" name="<?= $key ?>_inpjawaban" value="5" <?= (empty($siswa_hasil[$row->id_kuisioner_soal]['jawaban']) ? '' : ($siswa_hasil[$row->id_kuisioner_soal]['jawaban'] === '5' ? 'checked' : '')) ?> />
                                <label class="form-check-label" for="<?= $key ?>_e">
                                    E. <?= $row->pil_e ?>
                                </label>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- end:: kuisioner -->
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" id="save" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end:: content -->