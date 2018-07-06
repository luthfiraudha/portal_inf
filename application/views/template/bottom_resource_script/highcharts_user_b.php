

<script type = "text/javascript">
  

Highcharts.chart('show', {
    chart: {
        renderTo: 'container',
        type: 'column'
    },
    title: {
        text: 'Top User Perform'
    },
    xAxis: {
        title: false,
        categories: ['User']

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
    series: [

    <?php foreach ($user_perform as $lp) { ?> {

            name: '<?php echo  $lp->nama2; ?>',
            data: [<?php echo $lp->total; ?>]


        },
        <?php 
    } ?>
    ]
});


</script>