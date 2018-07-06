

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
                    text: 'Jumlah Tape PF'
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
            zoomType : "x",
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series : <?php echo json_encode($data_tape); ?>
            
        });
    });

</script>