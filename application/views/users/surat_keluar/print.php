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
</style>
<!-- CSS -->

<div class="kop_surat">
    <table align="center">
        <td>
            <img src="<?= assets_path() ?>admin/images/sulsel.png" alt="logo" title="logo" width="70px" />
        </td>
        <td align="center">
            <h3>PEMERINTAH KABUPATEN BULUKUMBA</h3>
            <h3>KECAMATAN BONTOTIRO</h3>
            <h3>DESA BONTO TANGNGA</h3>
            <p><i><?= (empty($data->alamat) ? null : $data->alamat) ?></i></p>
        </td>
        <td>
            <img src="<?= assets_path() ?>admin/images/logo.png" alt="logo" title="logo" width="70px" />
        </td>
    </table>
    <hr>
</div>

<!-- begin:: body -->
<div class="jenis_surat_head">
    <h3 class="jenis_surat"><?= $detail->jenis_surat ?></h3>
    <p>Nomor : <?= $detail->no_surat ?></p>
</div>
<br />
<br />
<?= $detail->isi ?>
<br />
<br />
<!-- end:: body -->

<table align="right">
    <tr>
        <td align="center">
            <p>Bulukumba, <?= tgl_indo($detail->tgl_surat) ?></p>
            <p>Kepala Desa</p>
            <br />
            <br />
            <br />
            <br />
            <p class="nama"><?= (empty($data->nama) ? null : $data->nama) ?></p>
        </td>
    </tr>
</table>