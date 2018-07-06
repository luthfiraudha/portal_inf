
<script type="text/javascript">
        var data_pms_lan;
        $(document).ready(function () {
            

                //data record
                data_pms_lan  = $('#data-pmslan').DataTable({ 
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
                        "url": "<?php echo site_url('pms_lan/ajax_list_pmslan')?>",
                        "data": function (data) {
                             data.tanggal = $('#tgl_pmslan').val();
                             data.nmr_surat = $('#nmr_surat').val();
                            
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


                console.log(data_pms_lan);

               
                $('#btn-filter').click(function(){ //button filter event click
                    data_pms_lan.ajax.reload(null,false);  //just reload table
                });

                $('#btn-reset').click(function(){ //button reset event click
                    $('#form-filter')[0].reset();
                    data_pms_lan.ajax.reload(null,false);  //just reload table
                });

                $('#tgl_pmslan').daterangepicker({
                
                singleDatePicker: true,
                calender_style: "picker_2",

                 });
                $('#tgl_pmslan').val('');
              
        });
    </script>


