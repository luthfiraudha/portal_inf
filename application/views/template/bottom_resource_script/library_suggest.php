<script type="text/javascript">
$(document).ready(function () {
     $(function () {

            $( "#libraryapp" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('Data_tape_pf/getall_library'); ?>",
                        data: { kode: $("#libraryapp").val()},
                        dataType: "json",
                        type: "POST",
                        success: function(data){
                            response(data);
                            console.log('a');
                            console.log(data);
                        }    
                    });
                },


            });
        });

   
});
    

</script>