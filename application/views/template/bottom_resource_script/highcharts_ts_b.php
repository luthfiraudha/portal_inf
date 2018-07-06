

<script type = "text/javascript">
   

Highcharts.chart('show', {
    chart: {
        renderTo: 'container',
        type: 'column'
    },
    title: {
        text: 'Troubleshoot Perform'
    },
    xAxis: {
        title: false,
        categories: ['week 1','week 2','week 3','week 4']

    },
    tooltip: {
        formatter: function () {
            return '' +
                this.series.name + ': ' + this.y + ' Task';
        }
    },
    yAxis: {
        title: false,
    },
    series: [
    <?php foreach ($report_problem_notsuccess as $lp2) { ?> {

            name: 'task belum selesai',
            data: [<?php echo $lp2->week1; ?>,<?php echo $lp2->week2; ?>,<?php echo $lp2->week3; ?>,<?php echo $lp2->week4; ?>]


        },
        <?php } ?>
    <?php foreach ($report_problem_success as $lp1) { ?> {

            name: 'task selesai',
            data: [<?php echo $lp1->week1; ?>,<?php echo $lp1->week2; ?>,<?php echo $lp1->week3; ?>,<?php echo $lp1->week4; ?>]


        }
        <?php  } ?>
    ]
});



</script>