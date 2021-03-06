

<script type = "text/javascript">
    $(function () {
        $('#show').highcharts({
            chart: {
                type : 'line',
            zoomType: 'x'
            },
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
                type: 'datetime', //y-axis will be in milliseconds
                dateTimeLabelFormats: { //force all formats to be hour:minute:second
                    second: '%H:%M:%S',
                    minute: '%H:%M:%S',
                    hour: '%H:%M:%S',
                    day: '%H:%M:%S',
                    week: '%H:%M:%S',
                    month: '%H:%M:%S',
                    year: '%H:%M:%S'
                }
            },
            tooltip: {
                backgroundColor: '#FFFFFF',
                borderColor: 'black',
                borderRadius: 10,
                borderWidth: 3,
                formatter:function(){
                    var date = new Date(this.y);
                    date.setHours(date.getHours() - 7);
                    var str = date.toString();
                    var time = str.split(" ");

                    return this.point.name+' : '+ time[4];
                }

            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [
            {
                name : "After",
                data : [
                <?php foreach ($data_after as $key) { ?>
                {
                    name : <?php echo "'".$key->tanggal."'";?>,
                    <?php if($key->jam > date("H:i", strtotime("12:00")) ){ ?>
                         y : Date.parse("1970-01-03 "+<?php echo "'".$key->jam.":00'"; ?>+" GMT+0000")
                    <?php }else{?>
                        y : Date.parse("1970-01-03 "+<?php echo "'".$key->jam.":00'"; ?>+" GMT+0000")
                    <?php } ?>
                   
                },
                <?php } ?>]
            },
            {
                name : "Before",
                data : [
                <?php foreach ($data_be4 as $key2) { ?>
                {
                    name : <?php echo "'".$key2->tanggal."'";?>,
                    <?php if($key2->jam < date("h:i", strtotime("12:00")) ){ ?>
                         y : Date.parse("1970-01-03 "+<?php echo "'".$key2->jam.":00'"; ?>+" GMT+0000")
                    <?php }else{?>
                        y : Date.parse("1970-01-02 "+<?php echo "'".$key2->jam.":00'"; ?>+" GMT+0000")
                    <?php } ?>
                },
                <?php } ?>
                ]
            }
            ]
        });
    });



</script>