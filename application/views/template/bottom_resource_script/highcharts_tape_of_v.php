

<script type = "text/javascript">


Highcharts.chart('show_of', {
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
        text : 'Avaibility Size Open System'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}% </b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% ({point.y} GB)',
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
            <?php foreach ($size_tape_of as $lp) { ?> {
                name: 'Used',
                y: <?php echo $lp->used/1024; ?>
            },
            {   
                name : 'Free',
                y : <?php echo ($lp->total-$lp->used)/1024;?>
            },
            <?php } ?>
        ]
    }]
});
</script>