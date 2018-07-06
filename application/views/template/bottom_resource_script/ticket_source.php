
<script type="text/javascript">
        $(document).ready(function () {
          
            $('#tglIssue').daterangepicker({
                
                singleDatePicker: true,
                calender_style: "picker_2",

            });

             $('#tglIssue2').daterangepicker({
                
                singleDatePicker: true,
                calender_style: "picker_2",

            });

            if($('body').length){
                console.log('aaaa');
            }

            $('#jamIssue').datetimepicker({

                 format: 'HH:mm'
            });

             $('#jamIssue2').datetimepicker({

                 format: 'HH:mm'
            });


            $('#tglIssue').val('');
            
            $('#dailyActi').change(function(){
             selection = $(this).val();    
             switch(selection)
             { 
                 case 'Daily Activity':
                     $('#dailyAct').hide();
                     $('#tglIssueA').hide();
                     $('#jamIssueA').hide();  
                     break;
                 default:
                     $('#dailyAct').show();
                     $('#tglIssueA').show();
                     $('#jamIssueA').show();  
                     break;
                     }
                  });


        
            
        });

    </script>


