

<script type = "text/javascript">
                 

Highcharts.chart('show', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    exporting: {
        enabled: true
    },
    title: false,
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Task Completed Persentase',
        colorByPoint: true,
        data: [

            <?php foreach ($report_problem as $lp3) { ?> {

                name: '<?php echo  $lp3->status; ?>',
                y: <?php echo $lp3->jumlah_problem; ?>


            },
            <?php } ?>
        ]
    }]
});





</script>