<script type = "text/javascript">

Highcharts.chart('show_pf', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    exporting: {
        enabled: true
    },
    title: {
        text : 'Avaibility iSeries'
    },

    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            depth : 25,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} % ({point.y} Tape)',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Persentase by Avaibility',
        colorByPoint: true,
        data: [
            <?php foreach ($data_tape_day as $lp) { ?> {
                name: '<?php echo  $lp->klasifikasi; ?>',
                y: <?php echo $lp->total; ?>
            },
            <?php } ?>
        ]
    }]
});
</script>