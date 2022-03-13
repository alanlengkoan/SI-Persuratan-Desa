<script src="<?= assets_url() ?>admin/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/jszip.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/pdfmake.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/vfs_fonts.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/extensions/key-table/js/dataTables.keyTable.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="<?= assets_url() ?>admin/parsley-2.9.2/parsley.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script>
    let tabelPendudukDt = null;
    let tabelPekerjaanDt = null;
    let tabelUmurDt = null;

    // untuk datatable penduduk
    var untukTabelPenduduk = function() {
        tabelPendudukDt = $('#tabel-penduduk').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>dashboard/get_penduduk',
            columns: [{
                    title: 'Jenis Kelamin',
                    data: 'name',
                    className: 'text-center',
                },
                {
                    title: 'Jumlah',
                    data: 'y',
                    className: 'text-center',
                },
            ],
        });
    }();

    // untuk datatable pekerjaan
    var untukTabelPekerjaan = function() {
        tabelPekerjaanDt = $('#tabel-pekerjaan').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>dashboard/get_pekerjaan',
            columns: [{
                    title: 'Pekerjaan',
                    data: 'name',
                    className: 'text-center',
                },
                {
                    title: 'Jumlah',
                    data: 'y',
                    className: 'text-center',
                },
            ],
        });
    }();

    // untuk datatable umur
    var untukTabelUmur = function() {
        tabelUmurDt = $('#tabel-umur').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>dashboard/get_umur',
            columns: [{
                    title: 'Umur',
                    data: 'name',
                    className: 'text-center',
                },
                {
                    title: 'Jumlah',
                    data: 'y',
                    className: 'text-center',
                },
            ],
        });
    }();

    // untuk grafik penduduk
    var untukGrafikPenduduk = function() {
        $.ajax({
            url: '<?= admin_url() ?>dashboard/get_penduduk',
            dataType: 'json',
            success: function(response) {
                Highcharts.chart('grafik-penduduk', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Jumlah Penduduk'
                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jenis Kelamin'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Jumlah {series.name}: <b>{point.y:f} orang</b>'
                    },
                    series: [{
                        name: 'Jenis Kelamin',
                        colorByPoint: true,
                        data: response.data,
                        dataLabels: {
                            enabled: true,
                            rotation: -50,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y:.1f}',
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
            }
        })
    }();

    // untuk grafik pekerjaan
    var untukGrafikPekerjaan = function() {
        $.ajax({
            url: '<?= admin_url() ?>dashboard/get_pekerjaan',
            dataType: 'json',
            success: function(response) {
                Highcharts.chart('grafik-pekerjaan', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Jumlah Penduduk'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.y:f} orang</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Total',
                        colorByPoint: true,
                        data: response.data
                    }]
                });
            }
        })
    }();

    // untuk grafik umur
    var untukGrafikUmur = function() {
        $.ajax({
            url: '<?= admin_url() ?>dashboard/get_umur',
            dataType: 'json',
            success: function(response) {
                Highcharts.chart('grafik-umur', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Jumlah Umur'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.y:f} orang</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Total',
                        colorByPoint: true,
                        data: response.data
                    }]
                });
            }
        })
    }();

    // untuk grafik katgori umur
    var untukGrafikKategoriUmur = function() {
        $.ajax({
            url: '<?= admin_url() ?>dashboard/get_umur_kategori',
            dataType: 'json',
            success: function(response) {
                Highcharts.chart('grafik-kategori-umur', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Jenis Kategori Umur'
                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jenis Kelamin'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Jumlah {series.name}: <b>{point.y:f} orang</b>'
                    },
                    series: [{
                        name: 'Jenis Kelamin',
                        colorByPoint: true,
                        data: response.data,
                        dataLabels: {
                            enabled: true,
                            rotation: -50,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y:.1f}',
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
            }
        })
    }();
</script>