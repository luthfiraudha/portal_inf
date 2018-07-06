
<script type="text/javascript">
       
        var data_inven;
        var data_dok;
        var data_app;
        var data_trans;
        var data_fit;
        var data_konfirm;

        $(document).ready(function () {
            
                data_app = $('#data-app').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables2' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables2/ajax_list_app')?>",
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

                data_fit = $('#data-fit').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables2' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables2/ajax_list_fit')?>",
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
                
               //var data_prob=$('#data-prob');

                data_dok = $('#data-dok').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables2' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables2/ajax_list_dok')?>",
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

                data_inven = $('#data-inven').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables2' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables2/ajax_list_inven')?>",
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

                data_inven = $('#data-trans').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables2' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables2/ajax_list_trans')?>",
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

                data_konfirm = $('#data-konfirm').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables2' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables2/ajax_list_konfirm')?>",
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
/*
              data_proj = $('#data-vend').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables2' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables2/ajax_list_proj')?>",
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

              
                data_code  = $('#data-code').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables2' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables2/ajax_list_code')?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                ],
            });*/

                 
        });
    </script>


