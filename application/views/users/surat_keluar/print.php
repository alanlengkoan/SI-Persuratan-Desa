<title><?= $title ?></title>

<!-- CSS -->
<style media="screen">
    .kop_surat {
        padding: 4mm;
        text-align: center;
    }

    .nama {
        text-decoration: underline;
        font-weight: bold;
    }

    .jenis_surat_head {
        text-align: center;
    }

    .jenis_surat {
        text-decoration: underline;
        text-transform: uppercase;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    h3 {
        font-family: times;
    }

    p {
        margin: 0;
    }

    .text {
        text-align: justify;
    }
</style>
<!-- CSS -->

<div class="kop_surat">
    <table align="center">
        <td>
            <img src="<?= assets_path() ?>admin/images/logo.png" alt="logo" title="logo" width="70px" />
        </td>
        <td align="center">
            <h3>PEMERINTAH KABUPATEN BULUKUMBA</h3>
            <h3>KECAMATAN BONTOTIRO</h3>
            <h3>DESA BONTO TANGNGA</h3>
            <p><i><?= (empty($data->alamat) ? null : $data->alamat) ?></i></p>
        </td>
        <td>
        </td>
    </table>
    <hr>
</div>

<!-- begin:: body -->
<div class="jenis_surat_head">
    <h3 class="jenis_surat"><?= $detail->jenis_surat ?></h3>
    <p>Nomor : <?= $detail->no_surat ?></p>
</div>
<br /><br />
<p class="text">
    Yang bertanda tangan dibawah ini kepala desa bonto tangnga, kecamatan bontotiro menerangkan dengan sebenarnya, bahwa:
</p>
<br /><br />
<table>
    <tr>
        <td width="150">Nama</td>
        <td width="5">:</td>
        <td><?= $penduduk->nama ?></td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td><?= $penduduk->no_ktp ?></td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td><?= ($penduduk->kelamin === 'L' ? 'Laki-laki' : 'Perempuan') ?></td>
    </tr>
    <tr>
        <td>Tempat, Tanggal Lahir</td>
        <td>:</td>
        <td><?= $penduduk->tmp_lahir ?>, <?= tgl_indo($penduduk->tgl_lahir) ?></td>
    </tr>
    <tr>
        <td>Warganegara/Agama</td>
        <td>:</td>
        <td><?= $penduduk->kewarganegaraan ?></td>
    </tr>
    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td><?= $penduduk->pekerjaan ?></td>
    </tr>
    <tr>
        <td>Status Pernikahan</td>
        <td>:</td>
        <td><?= ($penduduk->status_nikah === 'y' ? 'Iya' : 'Tidak') ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?= $penduduk->alamat ?></td>
    </tr>
</table>
<br /><br />
<p class="text">
    Nama tersebut diatas adalah benar warga desa bonto tangnga, kecamatan bontotiro, kabupaten bulukumba. Berdasarkan keterangan yang bersangkutan tanggal 30 Januari 2021 dengan ini menerangkan ada perbedaan data identitas yang disebabkan kesalahan penulisan pada administrasi pendataan yang dijelaskan pada lampiran surat ini. Surat keterangan ini dipergunakan untuk pernikahan.
</p>
<br /><br />
<p class="text">
    Demikian surat keterangan ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
</p>
<br /><br />
<!-- end:: body -->

<table align="right">
    <tr>
        <td align="center">
            <p>Bulukumba, <?= tgl_indo($detail->tgl_surat) ?></p>
            <p>Kepala Desa Bonto Tangnga</p>
            <img src="<?= assets_path() ?>admin/images/tanda-tangan.jpg" height="100" />
            <p class="nama"><?= (empty($data->nama) ? null : $data->nama) ?></p>
        </td>
    </tr>
</table>