    <!-- begin:: breadcumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h4 class="m-b-10"><?= $title ?></h4>
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
                        <!-- begin:: body -->
                        <div class="col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-block text-center">
                                    <i class="feather icon-box text-c-blue d-block f-40"></i>
                                    <h4 class="m-t-20"><span class="text-c-blue"><?= $surat_sudah_approve ?></span>&nbsp;Surat</h4>
                                    <p class="m-b-20">Surat telah disetujui.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-block text-center">
                                    <i class="feather icon-users text-c-green d-block f-40"></i>
                                    <h4 class="m-t-20"><span class="text-c-green"><?= $surat_belum_approve ?></span>&nbsp;Surat</h4>
                                    <p class="m-b-20">Surat belum disetujui.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end:: body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: content -->