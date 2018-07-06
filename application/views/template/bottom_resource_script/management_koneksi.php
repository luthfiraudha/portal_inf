
<script type="text/javascript">
        var data_koneksi;
        $(document).ready(function () {
            
        
               //var data_prob=$('#data-prob');

                //data tape PF

                data_koneksi = $('#data-koneksi').DataTable({ 

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('data_koneksi/ajax_list_data_koneksi')?>",
                        "data": function (data) {
                             data.namaapp = $('#namaapp').val();
                             data.namafitur = $('#namafitur').val();
                             data.ip = $('#ip').val();
                            
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
                    data_koneksi.ajax.reload(null,false);  //just reload table
                });

                $('#btn-reset').click(function(){ //button reset event click
                    $('#form-filter')[0].reset();
                    data_koneksi.ajax.reload(null,false);  //just reload table
                });

        });
    </script>


