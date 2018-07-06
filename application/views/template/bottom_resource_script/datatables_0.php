
<script type="text/javascript">
        var data_prob;
        var data_record;
        var data_dai;
        var data_sop;
        var data_vend;
        var data_reminis;
        var data_report_ticket;
        var data_daily;
        $(document).ready(function () {
            
        
               //var data_prob=$('#data-prob');

                //data record
                data_record  = $('#data-record').DataTable({ 
                      "dom": "Bfrtip",
                      "buttons": [
                        {
                          extend: "copy",
                          className: "btn-sm"
                        },
                        {
                          extend: "csv",
                          className: "btn-sm"
                        },
                        {
                          extend: "excel",
                          className: "btn-sm"
                        },
                        {
                          extend: "pdfHtml5",
                          className: "btn-sm"
                        },
                        {
                          extend: "print",
                          className: "btn-sm"
                        },
                      ],

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    "scrollX": true,

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('datatables/ajax_list_ticket')?>",
                        "data": function (data) {
                             data.shift = $('#shift1').val();
                             data.tglIssue = $('#tglIssue').val();
                             data.tglIssue2 = $('#tglIssue2').val();
                             data.kategori = $('#kategoriapp1').val();
                             data.namaapp = $('#namaapp').val();
                             data.namafitur = $('#namafitur').val();
                             data.jenistik = $('#jenistik').val();
                             data.status = $('#status').val();
                             console.log(data);
                            
                        },
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


                console.log(data_record);

                $('#btn-filtertik').click(function(){ //button filter event click
                    data_record.ajax.reload(null,false);  //just reload table
                });

                $('#btn-resettik').click(function(){ //button reset event click
                    $('#form-filtertik')[0].reset();
                    data_record.ajax.reload(null,false);  //just reload table
                });


                  //dataprob
                data_prob = $('#data-prob').DataTable({ 
                    "dom": "Bfrtip",
                      "buttons": [
                        {
                          extend: "copy",
                          className: "btn-sm"
                        },
                        {
                          extend: "csv",
                          className: "btn-sm"
                        },
                        {
                          extend: "excel",
                          className: "btn-sm"
                        },
                        {
                          extend: "pdfHtml5",
                          className: "btn-sm"
                        },
                        {
                          extend: "print",
                          className: "btn-sm"
                        },
                      ],


                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('datatables/ajax_list_prob')?>",
                        "data": function (data) {
                             data.shift = $('#shift').val();
                              data.tglIssue = $('#tglIssue').val();
                             data.tglIssue2 = $('#tglIssue2').val();
                             
                             data.jenistik = $('#jenistik').val();
                             data.kategori = $('#kategoriapp').val();
                            
                        },
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

                console.log(data_prob);

                $('#btn-filter').click(function(){ //button filter event click
                    data_prob.ajax.reload(null,false);  //just reload table
                });

                $('#btn-reset').click(function(){ //button reset event click
                    $('#form-filter')[0].reset();
                    data_prob.ajax.reload(null,false);  //just reload table
                });



             data_dai  = $('#data-dai').DataTable({ 
                "dom": "Bfrtip",
                      "buttons": [
                        {
                          extend: "copy",
                          className: "btn-sm"
                        },
                        {
                          extend: "csv",
                          className: "btn-sm"
                        },
                        {
                          extend: "excel",
                          className: "btn-sm"
                        },
                        {
                          extend: "pdfHtml5",
                          className: "btn-sm"
                        },
                        {
                          extend: "print",
                          className: "btn-sm"
                        },
                      ],


                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                 "scrollX": true,
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables/ajax_list_dai')?>",
                    "data": function (data) {
                             data.shift = $('#shift2').val();
                             data.tglIssue = $('#tglIssue').val();
                             data.kategori = $('#kategoriapp2').val();
                             console.log(data);
                         },
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

               console.log(data_dai);

                $('#btn-filterdai').click(function(){ //button filter event click
                    data_dai.ajax.reload(null,false);  //just reload table
                });

                $('#btn-resetdai').click(function(){ //button reset event click
                    $('#form-filterdai')[0].reset();
                    data_dai.ajax.reload(null,false);  //just reload table
                });



            data_daily  = $('#data-daily').DataTable({ 
                "dom": "Bfrtip",
                      "buttons": [
                        {
                          extend: "copy",
                          className: "btn-sm"
                        },
                        {
                          extend: "csv",
                          className: "btn-sm"
                        },
                        {
                          extend: "excel",
                          className: "btn-sm"
                        },
                        {
                          extend: "pdfHtml5",
                          className: "btn-sm"
                        },
                        {
                          extend: "print",
                          className: "btn-sm"
                        },
                      ],


                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                 "scrollX": true,

                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('Daily_issue/ajax_list_daily')?>",
                    "data": function (data) {
                             data.shift = $('#shift2').val();
                             data.tglIssue = $('#tglIssue').val();
                             data.kategori = $('#kategoriapp2').val();
                             data.job = $('#namajob').val();
                             console.log(data);
                         },
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

               console.log(data_daily);

                $('#btn-filterdaily').click(function(){ //button filter event click
                    data_daily.ajax.reload(null,false);  //just reload table
                });

                $('#btn-resetdaily').click(function(){ //button reset event click
                    $('#form-filterdaily')[0].reset();
                    data_daily.ajax.reload(null,false);  //just reload table
                });




             //data reeminder answer
                data_reminis  = $('#data-reminis').DataTable({ 
                      "dom": "Bfrtip",
                      "buttons": [
                        {
                          extend: "copy",
                          className: "btn-sm"
                        },
                        {
                          extend: "csv",
                          className: "btn-sm"
                        },
                        {
                          extend: "excel",
                          className: "btn-sm"
                        },
                        {
                          extend: "pdfHtml5",
                          className: "btn-sm"
                        },
                        {
                          extend: "print",
                          className: "btn-sm"
                        },
                      ],

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    "scrollX": true,

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('datatables/ajax_list_reminis')?>",
                        "data": function (data) {
                            
                             data.tglIssue = $('#tglIssue').val();
                             data.tglIssue2 = $('#tglIssue2').val();
                             data.status = $('#status').val();
                             console.log(data);
                            
                        },
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


                console.log(data_reminis);

                $('#btn-filterrem').click(function(){ //button filter event click
                    data_reminis.ajax.reload(null,false);  //just reload table
                });

                $('#btn-resetrem').click(function(){ //button reset event click
                    $('#form-filterrem')[0].reset();
                    data_reminis.ajax.reload(null,false);  //just reload table
                });



                ////data sop//////////////

              data_sop  = $('#data-sop').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables/ajax_list_sop')?>",
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

              data_vend  = $('#data-vend').dataTable({ 

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('datatables/ajax_list_vend')?>",
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


