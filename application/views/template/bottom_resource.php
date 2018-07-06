<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- NProgress -->
<script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>


<script src="<?php echo base_url(); ?>assets/vendors/jquery-ui/jquery-ui.js"></script>



<?php
foreach ($plugins as $key => $value) {
    if (file_exists(APPPATH."views/template/bottom_resource/{$value}.php"))
        $this->load->view('template/bottom_resource/'.$value);
}
?>


<!-- Custom Theme Scripts -->
<script src="<?php echo base_url(); ?>assets/build/js/custom.js"></script>

<script type="text/javascript">
  function cekfitur(){
    console.log($('#namaapp').val());
    $( "#namafitur" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('Data_sop/get_fitur'); ?>",
                        data: { kode: $("#namafitur").val(),
                                nama_app : $('#namaapp').val()},
                        chache: false,
                        dataType: "json",
                        type: "POST",
                        success: function(data){
                            response(data);
                        }    
                    });
                },


            });
  }
      
    jQuery.fn.preventDoubleSubmission = function () {
        $(this).on('submit', function (e) {
            var $form = $(this);

            if ($form.data('submitted') === true) {
                // Previously submitted - don't submit again
                e.preventDefault();
            } else {
                // Mark it so that the next submit can be ignored
                $form.data('submitted', true);
            }
        });

        // Keep chainability
        return this;
    };

        inactivityTimeout = false
        resetTimeout()
        function onUserInactivity() {
           window.location.href = "<?php echo base_url('auth/logout');?>"
        }
        function resetTimeout() {
           clearTimeout(inactivityTimeout)
           inactivityTimeout = setTimeout(onUserInactivity, 10000 * 900)
        }
        window.onmousemove = resetTimeout

    $(document).ready(function () {
   

        var base_url = $('#base_url').val();
        //-----------------Modal Delete----------------------------------------
        $('#delete-modal').on('show.bs.modal', function (e) {
            $(this).find('.btn-delete').attr('href', $(e.relatedTarget).data('href'));
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-delete').attr('href') + '</strong>');
        });
        //-----------------Modal Dismiss----------------------------------------
        $('#dismiss-modal').on('show.bs.modal', function (e) {
            $(this).find('.btn-dismiss').attr('href', $(e.relatedTarget).data('href'));
            $('.debug-url').html('Dismiss URL: <strong>' + $(this).find('.btn-dismiss').attr('href') + '</strong>');
        });
            //-----------------confrim Modal----------------------------------------
        $('#confrim-modal').on('show.bs.modal', function (e) {
            $(this).find('.btn-confrim').attr('href', $(e.relatedTarget).data('href'));
            $('.debug-url').html('Confrim URL: <strong>' + $(this).find('.btn-confrim').attr('href') + '</strong>');
        });

         //-----------------Modal Correct----------------------------------------
        $('#correct-modal').on('show.bs.modal', function (e) {
            $(this).find('.form-ok').attr('action', $(e.relatedTarget).data('href'));
            var id = $(e.relatedTarget).data('id');
            

            var a = $(this).find('#modal-body-reminder-issue');

            $.ajax({
              url: "/portalosd/reminder_issue/ajax_answer/",
              type: "POST",
              data: {id : id},
              cache: false,
              success: function(html){
                a.html(html);
                console.log(a);
              }
            });
           

            $('.debug-url').html('Correct URL: <strong>' + $(this).find('.btn-correct').attr('href') + '</strong>');
        });


           //-----------------Modal Add Answer----------------------------------------
        $('#add-answer-modal').on('show.bs.modal', function (e) {
            $(this).find('.add-answer').attr('action', $(e.relatedTarget).data('href'));
            var fitur = $(e.relatedTarget).data('fitur');

            var a = $(this).find('#modal-body-add-answer');

            $.ajax({
              url: "<?php echo site_url('Data_issue/add_answer_modal'); ?>",
              type: "POST",
              data: 'fitur='+fitur,
              cache: false,
              success: function(html){
                a.html(html);
                console.log(a);
                 $('#tglIssue').daterangepicker({
                
                singleDatePicker: true,
                calender_style: "picker_2",

                  });

                  if($('body').length){
                      console.log('aaaa');
                  }

                  $('#jamIssue').datetimepicker({

                       format: 'HH:mm'
                  });
                  $('#tglIssue').val('');
              }
            });
           

            $('.debug-url').html('Correct URL: <strong>' + $(this).find('.btn-correct').attr('href') + '</strong>');
        });

           //-----------------Modal data chechlist----------------------------------------
        $('#add-data-modal').on('show.bs.modal', function (e) {
            $(this).find('.add-data').attr('action', $(e.relatedTarget).data('href'));
           
            var a = $(this).find('#modal-body-add-data');

            $.ajax({
              url: "<?php echo site_url('checklist/add_data_modal'); ?>",
              type: "POST",
              cache: false,
              success: function(html){
                a.html(html);
                console.log(a);
              }
            });
           

            $('.debug-url').html('Correct URL: <strong>' + $(this).find('.btn-correct').attr('href') + '</strong>');
        });



           //-----------------Modal edit Answer----------------------------------------
        $('#edit-answer-modal').on('show.bs.modal', function (e) {
            $(this).find('.edit-answer').attr('action', $(e.relatedTarget).data('href'));
           
            var id = $(e.relatedTarget).data('id');

            var a = $(this).find('#modal-body-edit-answer');

            $.ajax({
              url: "<?php echo site_url('Data_issue/edit_answer_modal'); ?>",
              type: "POST",
              data: 'id='+id,
              cache: false,
              success: function(html){
                a.html(html);
                console.log(a);

                 $('#tglIssue').daterangepicker({
                
                singleDatePicker: true,
                calender_style: "picker_2",

                  });

                  if($('body').length){
                      console.log('aaaa');
                  }

                  $('#jamIssue').datetimepicker({

                       format: 'HH:mm'
                  });
                  $('#tglIssue').val('');

                



              }
            });
           

            $('.debug-url').html('Correct URL: <strong>' + $(this).find('.btn-correct').attr('href') + '</strong>');
        });




        $(function () {
            $( "#namaprojek" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('Data_vendor/get_allprojek'); ?>",
                        data: { kode: $("#namaprojek").val()},
                        chache: false,
                        dataType: "json",
                        type: "POST",
                        success: function(data){
                            response(data);
                        }    
                    });
                },


            });
        });


//////////////////////////////// autocomplete aplikasi /////////////////////////////////
        $(function () {
           $( "#namaapp" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('Data_sop/get_app'); ?>",
                        data: { kode: $("#namaapp").val()},
                        dataType: "json",
                        chache: false,
                        type: "POST",
                        success: function(data){
                            response(data);
                        }    
                    });
                },


            });
        });

        $(function () {
           $( "#namajob" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('job/get_job'); ?>",
                        data: { kode: $("#namajob").val()},
                        dataType: "json",
                        chache: false,
                        type: "POST",
                        success: function(data){
                            response(data);
                        }    
                    });
                },


            });
        });


        // $(function () {
        //      $( "#namafitur" ).autocomplete({
        //         source: function(request, response) {
        //             $.ajax({ 
        //                 url: "<?php echo site_url('Data_sop/get_allfitur'); ?>",
        //                 data: { kode: $("#namafitur").val()},
        //                 chache: false,
        //                 dataType: "json",
        //                 type: "POST",
        //                 success: function(data){
        //                     response(data);
        //                 }    
        //             });
        //         },


        //     });
        // });

/////////////////////////////////////////////////////////////////////////////////////////////////////////

        $(function () {
            $( "#namavendor" ).autocomplete({
                source: function(request, response) {
                    $.ajax({ 
                        url: "<?php echo site_url('Data_vendor/get_allvendor'); ?>",
                        data: { kode: $("#namavendor").val()},
                        chache: false,
                        dataType: "json",
                        type: "POST",
                        success: function(data){
                            response(data);
                        }    
                    });
                },


            });
        });
                
        $('#kategori').change(function(){
         selection = $(this).val();    
         switch(selection)
         { 
             case 'other':
                 $('#otherType').show();
                 break;
             default:
                 $('#otherType').hide();
                 break;
                 }
        });

       

          $('#jabatan').change(function(){
         selection = $(this).val();    
         switch(selection)
         { 
             case 'otherjabatan':
                 $('#OtherJabatan').show();
                 break;
             default:
                 $('#OtherJabatan').hide();
                 break;
                 }
              });
        


        $('body').on('keydown', '.numeric', function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 13]) !== -1 ||
                // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                        // Allow: home, end, left, right
                                (e.keyCode >= 35 && e.keyCode <= 39) ||
                                // Allow : numelock number
                                        (e.keyCode >= 96 && e.keyCode <= 105)) {
                            // let it happen, don't do anything
                            return;
                        }
                        if (e.which < 48 || e.which > 57)
                            return false;
                        return true;
                    });

            $('body').on('keydown', '.numericDot', function (e) {
                // alert(e.keyCode);
                if ($.inArray(e.keyCode, [46, 8, 9, 13, 190]) !== -1 ||
                        // Allow: Ctrl+A
                                (e.keyCode == 65 && e.ctrlKey === true) ||
                                // Allow: home, end, left, right
                                        (e.keyCode >= 35 && e.keyCode <= 39) ||
                                        // Allow : numelock number
                                                (e.keyCode >= 96 && e.keyCode <= 105)) {
                                    // let it happen, don't do anything
                                    return;
                                }
                                if (e.which < 48 || e.which > 57)
                                    return false;
                                return true;
                            });
            
                    //Change hash for page-reload
                    $('.nav-tabs a').on('shown.bs.tab', function (e) {
                        if (history.pushState) {
                            history.pushState(null, null, e.target.hash);
                        } else {
                            window.location.hash = e.target.hash; //Polyfill for old browsers
                        }
                    });
                    });
</script>
<?php
foreach ($plugins as $key => $value) {
    if (file_exists(APPPATH."views/template/bottom_resource_script/{$value}.php"))
        $this->load->view('template/bottom_resource_script/'.$value);
}
?>