

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
                    text: 'Jumlah solusi tepat'
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
            series: [
            <?php for($i=0;$i<$total_data;$i++){?>

            <?php foreach ($user_perform[$i] as $lp[$i]){?>
            {
                
                name: <?php echo "'".$user_nama[$i]."'"; ?>,
                data: [
                    
                        {
                        name: 'week 1',
                        y: <?php echo $lp[$i]->week1; ?>
                        },
                         {
                        name: 'week 2',
                        y: <?php echo $lp[$i]->week2; ?>
                        },
                         {
                        name: 'week 3',
                        y: <?php echo $lp[$i]->week3; ?>
                        },
                         {
                        name: 'week 4',
                        y: <?php echo $lp[$i]->week4; ?>
                        },
                ]
            },
            <?php } ?> 
            <?php } ?> 
            
            ]
        });
    });



</script>