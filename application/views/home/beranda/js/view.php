<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script>
    var tahun = $('#tahun').find(":selected").val();
    _grafikPenduduk(tahun);
    _grafikPekerjaan(tahun);
    _grafikUmur(tahun);
    _grafikKategoriUmur(tahun);
    
    // untuk filter tahun
    var untukFilterTahun = function() {
        $("#tahun").change(function() {
            _grafikPenduduk(this.value);
            _grafikPekerjaan(this.value);
            _grafikUmur(this.value);
            _grafikKategoriUmur(this.value);
        });
    }();

    // untuk grafik penduduk
    function _grafikPenduduk(year) {
        $.ajax({
            url: '<?= base_url() ?>get_penduduk',
            dataType: 'json',
            data: {
                year: year
            },
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
        });
    }

    // untuk grafik pekerjaan
    function _grafikPekerjaan(year) {
        $.ajax({
            url: '<?= base_url() ?>get_pekerjaan',
            dataType: 'json',
            data: {
                year: year
            },
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
        });
    }

    // untuk grafik umur
    function _grafikUmur(year) {
        $.ajax({
            url: '<?= base_url() ?>get_umur',
            dataType: 'json',
            data: {
                year: year
            },
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
    }

    // untuk grafik katgori umur
    function _grafikKategoriUmur(year) {
        $.ajax({
            url: '<?= base_url() ?>get_umur_kategori',
            dataType: 'json',
            data: {
                year: year
            },
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
        });
    }
</script>