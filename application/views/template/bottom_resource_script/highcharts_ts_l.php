

<script type = "text/javascript">
    $(function () {
        $('#show').highcharts({
            title: false,
            subtitle: false,
            credits: {
                enabled: false
            },
            exporting: {
                enabled: true
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Jumlah Tickets'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                backgroundColor: '#FFFFFF',
                borderColor: 'black',
                borderRadius: 10,
                borderWidth: 3
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{

                name: "Task Belum Selesai",
                data: [
                    <?php foreach ($report_problem_notsuccess as $lp) { ?> 
                        {
                        name: 'week 1',
                        y: <?php echo $lp->week1; ?>
                        },
                         {
                        name: 'week 2',
                        y: <?php echo $lp->week2; ?>
                        },
                         {
                        name: 'week 3',
                        y: <?php echo $lp->week3; ?>
                        },
                         {
                        name: 'week 4',
                        y: <?php echo $lp->week4; ?>
                        },
                    <?php } ?>


                ]
            }, {
                name: "Task Selesai",
                data: [
                    <?php foreach ($report_problem_success as $lp2) { ?> 
                         {
                        name: 'week 1',
                        y: <?php echo $lp2->week1; ?>
                        },
                         {
                        name: 'week 2',
                        y: <?php echo $lp2->week2; ?>
                        },
                         {
                        name: 'week 3',
                        y: <?php echo $lp2->week3; ?>
                        },
                         {
                        name: 'week 4',
                        y: <?php echo $lp2->week4; ?>
                        },                    <?php } ?>


                ]
            }]
        });
    });



</script>