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
</style>
<!-- CSS -->

<div class="kop_surat">
    <table align="center">
        <td width="100">
            <img src="<?= assets_path() ?>admin/images/logo.png" alt="logo" title="logo" width="100px" />
        </td>
        <td align="center">
            <h3>PEMERINTAH KABUPATEN BULUKUMBA</h3>
            <h3>KECAMATAN BONTOTIRO</h3>
            <h3>DESA BONTO TANGNGA</h3>
            <p><i><?= (empty($data->alamat) ? null : $data->alamat) ?></i></p>
        </td>
        <td width="100">
        </td>
    </table>
    <hr>
</div>

<div class="jenis_surat_head">
    <h3>Laporan Surat Keluar</h3>
</div>

<table align="center" border="1" cellpadding="4" cellspacing="0" style="width: 100%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>No. Surat</th>
            <th>Tanggal Surat</th>
            <th>Tanggal Keluar</th>
            <th>Perihal</th>
            <th>Jenis Surat</th>
            <th>Tujuan Surat</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($surat_keluar as $key => $value) {
        ?>
            <tr>
                <td align="center"><?= $no++ ?></td>
                <td align="center"><?= $value->no_surat ?></td>
                <td align="center"><?= $value->tgl_surat ?></td>
                <td align="center"><?= $value->tgl_keluar ?></td>
                <td align="center"><?= $value->perihal ?></td>
                <td align="center"><?= $value->jenis_surat ?></td>
                <td align="center"><?= $value->tujuan_surat ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<br /><br />
<table>
    <tr>
        <td align="center">
            <p>MAKASSAR, <?= tgl_indo(date('Y-m-d')) ?></p>
            <br />
            <br />
            <br />
            <br />
            <p>Penanggung Jawab</p>
        </td>
    </tr>
</table>