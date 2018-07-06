
<script type="text/javascript">
        var data_tape_PF;
        var data_tape_OF;
        var data_tape_OF_available;
        var data_tape_ZF;
        var request_tape;
        $(document).ready(function () {
            
        
               //var data_prob=$('#data-prob');

                //data tape PF


                data_tape_PF = $('#data-tape-pf').DataTable({ 

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('manajemen_tape/ajax_list_tape_PF')?>",
                        "data": function (data) {
                             data.start_date = $('#single_cal1').val();
                             data.status = $('#status').val();
                             data.library = $('#libraryapp').val();
                             data.state = $('#state').val();
                            
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

                //console.log(data_tape_PF);

                $('#btn-filter').click(function(){ //button filter event click
                    data_tape_PF.ajax.reload(null,false);  //just reload table
                });

                $('#btn-reset').click(function(){ //button reset event click
                    $('#form-filter')[0].reset();
                    data_tape_PF.ajax.reload(null,false);  //just reload table
                });


                request_tape= $('#request-tape').DataTable({ 

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('manajemen_tape/ajax_list_request_tape')?>",
                        "data": function (data) {
                             data.vol_id = $('#vol_id').val();
                             data.no_surat = $('#no_surat').val();
                             data.status = $('#status').val();
                            
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


                $('#btn-filter').click(function(){ //button filter event click
                    request_tape.ajax.reload(null,false);  //just reload table
                });

                $('#btn-reset').click(function(){ //button reset event click
                    $('#form-filter')[0].reset();
                    request_tape.ajax.reload(null,false);  //just reload table
                });



                //Ajax Data Tape OF
                if($("#data-tape-of").length){
                    data_tape_OF = $('#data-tape-of').DataTable({ 

                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.

                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "<?php echo site_url('manajemen_tape/ajax_list_tape_OF')?>",
                            "data": function (data) {
                                 data.tanggal = $('#single_cal1').val();
                                 data.jenis = $('#jenis').val();
                                 data.hostname = $('#hostnameapp').val();
                                 data.ip = $('#ipapp').val();
                                
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

                    //console.log(data_tape_OF);

                    $('#btn-filter').click(function(){ //button filter event click
                        data_tape_OF.ajax.reload(null,false);  //just reload table
                    });

                    $('#btn-reset').click(function(){ //button reset event click
                        $('#form-filter')[0].reset();
                        data_tape_OF.ajax.reload(null,false);  //just reload table
                    });
                }

                //Ajax Data Tape OF
                data_tape_OF_available = $('#data-tape-of-a').DataTable({ 

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('manajemen_tape/ajax_list_tape_OF_available')?>",
                        "data": function (data) {
                             data.hostname = $('#hostnameapp').val();
                             data.ip = $('#ipapp').val();
                             data.size = $('#size').val();
                             data.ukuran = $('#ukuran').val();
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

                //console.log(data_tape_OF_available);

                $('#btn-filter').click(function(){ //button filter event click
                    data_tape_OF_available.ajax.reload(null,false);  //just reload table
                });

                $('#btn-reset').click(function(){ //button reset event click
                    $('#form-filter')[0].reset();
                    data_tape_OF_available.ajax.reload(null,false);  //just reload table
                });


                data_tape_ZF = $('#data-tape-zf').DataTable({ 

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('manajemen_tape/ajax_list_tape_ZF')?>",
                        "data": function (data) {
                             data.start_date = $('#single_cal1').val();
                             data.status = $('#status').val();
                             data.library = $('#library').val();
                             data.state = $('#state').val();
                            
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

                //console.log(data_tape_ZF);

                $('#btn-filter').click(function(){ //button filter event click
                    data_tape_ZF.ajax.reload(null,false);  //just reload table
                });

                $('#btn-reset').click(function(){ //button reset event click
                    $('#form-filter')[0].reset();
                    data_tape_ZF.ajax.reload(null,false);  //just reload table
                });

        });
    </script>


