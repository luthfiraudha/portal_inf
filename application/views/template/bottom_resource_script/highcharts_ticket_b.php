

<script type = "text/javascript">
    

Highcharts.chart('show', {
    chart: {
        renderTo: 'container',
        type: 'column'
    },
    title: {
        text: 'Top Category tickets'
    },
    xAxis: {
        title: false,
        categories: ['Type Problem']

    },
    tooltip: {
        formatter: function () {
            return '' +
                this.series.name + ': ' + this.y + ' tickets';
        }
    },
    yAxis: {
        title: false,
    },
    series: [<?php foreach ($report_problem_kategori as $lp3) { ?> {

            name: '<?php echo  $lp3->nama; ?>',
            data: [<?php echo $lp3->jumlah_problem; ?>]


        },
        <?php } ?>
    ]
});



</script>