<script type="text/javascript">
$(document).ready(function () {
    $('#sortable').sortable();


    $('#post_sort').click(function(e){

        var data = $('#sortable').sortable('serialize');
         $.ajax({
            data: data,
            type: 'POST',
            url: '<?php echo site_url('Master_menu/ordermenu'); ?>'
        });
         location.reload();
        //$('#hasil').text(data);

    });

   
});
    

</script>