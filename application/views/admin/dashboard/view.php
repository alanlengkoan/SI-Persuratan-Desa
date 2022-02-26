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
                    <div class="col-lg-12">
                        <!-- begin:: tab header -->
                        <div class="tab-header card">
                            <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#tabel" role="tab" aria-selected="true">Tabel</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#grafik" role="tab" aria-selected="false">Grafik</a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                        </div>
                        <!-- end:: tab header -->
                        <!-- begin:: tab content -->
                        <div class="tab-content">
                            <!-- begin:: tabel -->
                            <div class="tab-pane active show" id="tabel" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Jumlah Penduduk</h5>
                                    </div>
                                    <div class="card-block">
                                        <table class="table table-striped table-bordered nowrap" id="tabel-penduduk" style="width: 100%;">
                                        </table>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Jumlah Pekerjaan</h5>
                                    </div>
                                    <div class="card-block">
                                        <table class="table table-striped table-bordered nowrap" id="tabel-pekerjaan" style="width: 100%;">
                                        </table>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Jumlah Umur</h5>
                                    </div>
                                    <div class="card-block">
                                        <table class="table table-striped table-bordered nowrap" id="tabel-umur" style="width: 100%;">
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: tabel -->
                            <!-- begin:: grafik -->
                            <div class="tab-pane" id="grafik" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Grafik</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-header-text">Jumlah Penduduk</h5>
                                            </div>
                                            <div class="card-block">
                                                <div id="grafik-penduduk"></div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-header-text">Jumlah Pekerjaan</h5>
                                            </div>
                                            <div class="card-block">
                                                <div id="grafik-pekerjaan"></div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-header-text">Jumlah Umur</h5>
                                            </div>
                                            <div class="card-block">
                                                <div id="grafik-umur"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: grafik -->
                        </div>
                        <!-- end:: tab content -->
                    </div>
                    <!-- end:: body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->