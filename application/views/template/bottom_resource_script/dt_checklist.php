
<script type="text/javascript">
        var data_checklist;
       
        $(document).ready(function () {
            
        
              

                //data record
                data_checklist  = $('#data-checklist').dataTable({ 

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('Dt_checklist/ajax_list_ck')?>",
                        "type": "POST"
                    },

                    //Set column definition initialisation properties.
                    "columnDefs": [
                    { 
                        "targets": [ -1 ], //first column / numbering column
                        "orderable": false, //set not orderable
                    },
                    ],
                });

           
        });
    </script>


