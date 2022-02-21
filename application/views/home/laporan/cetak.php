<title><?= $halaman ?></title>

<!-- CSS -->
<style media="screen">
    .judul {
        padding: 4mm;
        text-align: center;
    }

    .nama {
        text-decoration: underline;
        font-weight: bold;
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

<div class="judul">
    <table align="center">
        <td>
            <img src="<?= assets_path() ?>admin/images/sulsel.png" alt="logo" title="logo" width="70px" />
        </td>
        <td align="center">
            <h3>PEMERINTAH SULAWESI SELATAN</h3>
            <h4>DINAS PENDIDIKAN</h4>
            <h5>CABANG DINAS PENDIDIKAN WILAYAH X</h5>
            <h3>UPT SMA NEGERI 12 TANA TORAJA</h3>
            <p><i>Kondodewata, Kec. Mappak, Kab. Tana Toraja, Sulawesi Selatan, Indonesia.</i></p>
        </td>
        <td>
            <img src="<?= assets_path() ?>admin/images/logo.png" alt="logo" title="logo" width="70px" />
        </td>
    </table>
    <hr>
    <br>
    <h2>Laporan Pertanggung Jawaban Dana <?= $jenis['nama'] ?> <br> Triwulan <?= number_to_roman($triwulan) ?> Tahun Anggaran <?= date('Y') ?></h2>
    <br>

    <table align="center" border="1" cellpadding="4" cellspacing="0">
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Uraian</th>
                <th rowspan="2">Masuk (Debit)</th>
                <th colspan="<?= count($jarak_bulan) ?>">Bulan</th>
                <th rowspan="2">Keluar (Kredit)</th>
                <th rowspan="2">Sisa</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <?php foreach ($jarak_bulan as $key => $value) { ?>
                    <th><?= $bulan[$key] ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $saldo_m = 0;
            $saldo_k = 0;
            $debit   = 0;
            $kredit  = 0;
            $sisa    = 0;
            foreach ($keuangan as $row) {
                $debit  = $debit + $row['debit'];
                $kredit = $kredit + $row['kredit'];
                $sisa   = $sisa + $row['sisa'];
            ?>
                <tr>
                    <td><?= $row['no'] ?></td>
                    <td><?= $row['uraian'] ?></td>
                    <td><?= create_separator($row['debit']) ?></td>
                    <?php foreach ($row['bulan'] as $key => $value) { ?>
                        <td><?= ($value === null ? 0 : create_separator($value)) ?></td>
                    <?php } ?>
                    <td><?= create_separator($row['kredit']) ?></td>
                    <td><?= create_separator($row['sisa']) ?></td>
                    <td><?= $row['keterangan'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" align="center">Total</td>
                <td><?= create_separator($debit) ?></td>
                <td colspan="<?= count($jarak_bulan) ?>" align="center">-</td>
                <td><?= create_separator($kredit) ?></td>
                <td><?= create_separator($sisa) ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <br /><br />
    <br /><br />
    <table>
        <tr>
            <td align="center">
                <p>TANA TORAJA, <?= tgl_indo(date('Y-m-d')) ?></p>
                <p>Kepala Sekolah</p>
                <br />
                <br />
                <br />
                <br />
                <p class="nama">Drs. Sinai</p>
                <p>NIP : 196401081989031019</p>
            </td>
        </tr>
    </table>
</div>