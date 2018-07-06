

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
     plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        color: '#000',
                        style: {fontWeight: 'bolder'},
                        formatter: function() {return this.y},
                        inside: true
                    },
                    pointPadding: 0.1,
                    groupPadding: 0
                }
            },
    series: <?php echo json_encode($data_tape); ?>
});



</script>