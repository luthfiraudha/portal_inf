<script type="text/javascript">
$(document).ready(function () {
     $(function () {

            $( "#kategoriapp" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('data_issue/getallkategori'); ?>",
                        data: { kode: $("#kategoriapp").val()},
                        dataType: "json",
                        chache: false,
                        type: "POST",
                        success: function(data){
                            response(data);
                            console.log('a');
                        }    
                    });
                },


            });

            $( "#kategoriapp1" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('data_issue/getallkategori'); ?>",
                        data: { kode: $("#kategoriapp1").val()},
                        dataType: "json",
                        type: "POST",
                        chache: false,
                        success: function(data){
                            response(data);
                            console.log('a');
                        }    
                    });
                },


            });

            $( "#kategoriapp2" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('data_issue/getallkategori'); ?>",
                        data: { kode: $("#kategoriapp2").val()},
                        dataType: "json",
                        chache: false,
                        type: "POST",
                        success: function(data){
                            response(data);
                            console.log('a');
                        }    
                    });
                },


            });
        });

   
});
    

</script>