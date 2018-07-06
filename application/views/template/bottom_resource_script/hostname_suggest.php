<script type="text/javascript">
$(document).ready(function () {
     $(function () {

            $( "#hostnameapp" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('Data_tape_of/getall_hostname'); ?>",
                        data: { kode: $("#hostnameapp").val()},
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

            $( "#ipapp" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('Data_tape_of/getall_ip'); ?>",
                        data: { 
                            hostname: $("#hostnameapp").val(), ip : $("#ipapp").val()
                        },
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