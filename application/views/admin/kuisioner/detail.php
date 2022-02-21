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
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2">Daftar <?= $halaman ?></h5>
                            </div>
                            <div class="col-lg-6 text-right">
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <table class="table table-striped table-bordered nowrap" id="tabel-hasil">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Soal</th>
                                    <th>Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data->result() as $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->soal ?></td>
                                        <td><?= $soal[$row->id_kuisioner_soal][$row->jawaban] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->