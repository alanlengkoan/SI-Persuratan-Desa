<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script>
    // untuk grafik penduduk
    var untukGrafikPenduduk = function() {
        $.ajax({
            url: '<?= base_url() ?>get_penduduk',
            dataType: 'json',
            success: function(response) {
                Highcharts.chart('grafik-penduduk', {
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

    // untuk grafik pekerjaan
    var untukGrafikPekerjaan = function() {
        $.ajax({
            url: '<?= base_url() ?>get_pekerjaan',
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
            url: '<?= base_url() ?>get_umur',
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
</script>