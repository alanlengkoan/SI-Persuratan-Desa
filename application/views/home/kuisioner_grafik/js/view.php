<script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/modules/export-data.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    var untukSubmit = function() {
        $('#form-login').parsley();
        $('#form-login').submit(function(e) {
            e.preventDefault();
            $('#username').attr('required', 'required');
            $('#password').attr('required', 'required');
            if ($('#form-login').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#login').val('Wait');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            window.location = response.link;
                        } else {
                            $('#login').val('Login');

                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            });
                        }
                    }
                })
            }
        });
    }();

    // Radialize the colors
    Highcharts.setOptions({
        colors: Highcharts.map(Highcharts.getOptions().colors, function(color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        })
    });

    // untuk get data peta
    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>kuisioner_chart/<?= $id_kuisioner ?>',
            dataType: 'json',
            success: function(response) {
                $.each(response, function(key, value) {
                    Highcharts.chart(value.id_kuisioner_soal, {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: value.soal
                        },
                        tooltip: {
                            pointFormat: '<b>{point.x:1f} Orang Memilih</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.y:1f} %',
                                    connectorColor: 'silver'
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Share',
                            data: value.data
                        }]
                    });
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                var errorMsg = 'Request Ajax Gagal : ' + xhr.responseText;
                alert(errorMsg);
            }
        });
    });
</script>