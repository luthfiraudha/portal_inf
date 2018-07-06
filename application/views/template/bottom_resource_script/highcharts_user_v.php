

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
        name: 'Persentase by user',
        colorByPoint: true,
        data: [

            <?php foreach ($user_perform as $lp) { ?> {

                name: '<?php echo  $lp->nama2; ?>',
                y: <?php echo $lp->total; ?>


            },
            <?php } ?>
        ]
    }]
});




</script>