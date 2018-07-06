<script type="text/javascript">




function init_SmartWizard() {
      
      if( typeof ($.fn.smartWizard) === 'undefined'){ return; }
      console.log('init_SmartWizard');
      
      $('#wizard').smartWizard({
        onLeaveStep: loadFitur,

        onFinish: FinishCall
      });

      $('#wizard_verticle').smartWizard({
        transitionEffect: 'slide',
      });

      $('.buttonNext').addClass('btn btn-success');
      $('.buttonPrevious').addClass('btn btn-primary');
      $('.buttonFinish').addClass('btn btn-default');
      
};

function loadFitur() {

if($('input[name=myRadios]:checked').val() == "new") {
  
  jQuery("#demo-form2 input:radio[id^=myRadios_2]:eq(1)").attr('disabled', true);
  jQuery("#demo-form2 input:radio[id^=myRadios_2]:eq(2)").attr('disabled', true);
}
else {
  jQuery("#demo-form2 input:radio[id^=myRadios_2]:eq(1)").attr('disabled', false);
  jQuery("#demo-form2 input:radio[id^=myRadios_2]:first").attr('disabled', false);
  jQuery("#demo-form2 input:radio[id^=myRadios_2]:eq(2)").attr('disabled', false);
}

  const id_app = $("#id_app").val();
  id_f = $("#id_fitur").val(); 
  
  //alert(id_app);
  $.ajax({
    url: "<?php echo base_url("pengajuan/getFiturBasedApp");?>",
    type: "POST",
    data: "id_app="+id_app,
    success: function(msg){
      $("#div-list-fitur").html(msg);
      //console.log(msg);

    }
  });

  
  
//-------- logic pemberian versi aplikasi ----------
  if(id_f != null) 
  {
    
//alert($('input[name=myRadios_2]:checked').val());
   if($('input[name=myRadios]:checked').val() == "existing") {
    //alert('ex 1');
      if($('input[name=myRadios_2]:checked').val() == "existing") {
      //alert('ex 2');     
        $.ajax({
        url: "<?php echo base_url("pengajuan/exis");?>",
        type: "POST",
        data: {id_app:id_app, id_fitur:id_f},
        //dataType: "json",
        success: function(msg){
         var obj = jQuery.parseJSON(msg);
          console.log(obj.versi_a);
          alert(obj.versi_a);
          $("#versi_a").val(parseInt(obj.versi_a));
            $("#versi_b").val(parseInt(obj.versi_b));
              $("#versi_c").val(parseInt(obj.versi_c)+1);
          }
        });
      }
      else if($('input[name=myRadios_2]:checked').val() == "versioning") {
        //alert('v 3');
          $.ajax({
          url: "<?php echo base_url("pengajuan/exis");?>",
          type: "POST",
          data: {id_app:id_app, id_fitur:id_f},
          //dataType: "json",
          success: function(msg){
           var obj = jQuery.parseJSON(msg);
            console.log(obj.versi_a);

            $("#versi_a").val(parseInt(obj.versi_a));
              $("#versi_b").val(parseInt(obj.versi_b)+1);
                $("#versi_c").val(0);
          }
        });
      }
      
        
      else if($('input[name=myRadios_2]:checked').val() == "new"){
       //alert('new 1');
          $.ajax({
          url: "<?php echo base_url("pengajuan/exis");?>",
          type: "POST",
          data: {id_app:id_app, id_fitur:id_f},
          //dataType: "json",
          success: function(msg){
           var obj = jQuery.parseJSON(msg);
          $("#versi_a").val(parseInt(obj.versi_a));
            $("#versi_b").val(parseInt(obj.versi_b)+1);
              $("#versi_c").val(0);
            }
          });
        }
      }
  else if($('input[name=myRadios]:checked').val() == "versioning") {
    //alert('v 1');
      if($('input[name=myRadios_2]:checked').val() == "existing") {
      //alert('ex 4');     
        $.ajax({
        url: "<?php echo base_url("pengajuan/exis");?>",
        type: "POST",
        data: {id_app:id_app, id_fitur:id_f},
        //dataType: "json",
        success: function(msg){
         var obj = jQuery.parseJSON(msg);
          console.log(obj.versi_a);

          $("#versi_a").val(parseInt(obj.versi_a)+1);
            $("#versi_b").val(0);
              $("#versi_c").val(0);
          }
        });
      }
      else if($('input[name=myRadios_2]:checked').val() == "versioning") {
       // alert('v 4');
          $.ajax({
          url: "<?php echo base_url("pengajuan/exis");?>",
          type: "POST",
          data: {id_app:id_app, id_fitur:id_f},
          //dataType: "json",
          success: function(msg){
           var obj = jQuery.parseJSON(msg);
            console.log(obj.versi_a);

            $("#versi_a").val(parseInt(obj.versi_a)+1);
              $("#versi_b").val(0);
                $("#versi_c").val(0);
          }
        });
      }
      
        
      else {
       //alert('new 4');
          $.ajax({
          url: "<?php echo base_url("pengajuan/newb");?>",
          type: "POST",
          data: {id_app:id_app},
          //dataType: "json",
          success: function(msg){
           var obj = jQuery.parseJSON(msg);
          $("#versi_a").val(parseInt(obj.versi_a)+1);
            $("#versi_b").val(0);
              $("#versi_c").val(0);
            }
          });
        }
  }
}

 

  return true;
}


//---- button submit -------
function FinishCall(objs, context){
    
        $('#demo-form2').submit();
    
}



//------ cek minimum input -----
function checkLength(el) {
  if (el.value.length <= 6) {
    alert("Minimum karakter 'No Surat' adalah 6 karakter")
  }
}

//---- end input angka saja --------

/*function validateAllSteps(){
  var isStepValid = true;
  // all step validation logic     
  return isStepValid;
} */

/*function getval(sel)
{
   // alert(sel.value)        ;
    $.ajax({
          url: "<?php echo base_url("pengajuan/konfit");?>",
          type: "POST",
          data: {id_app:sel.value},
          //dataType: "json",
          success: function(msg){
            $("#div-list-fitur2").html(msg);
            }
             
          });

}*/

//-------- logic Connect To -----        
/*  toggleFields();
    $("#tipe_fitur").change(function () {
          toggleFields();
      });

  function toggleFields() {
      if ($("#tipe_fitur").val() != "Database"){
          $("#connectTo").show();              
      }
      else{
          $("#connectTo").hide();
          $("#connectTo2").hide();
      }
    }

  toggleFields2();
      $("#connectTo_app").change(function () {
            toggleFields2();
        });

      function toggleFields2() {
        if ($("#connectTo_app").val() != 0)
            $("#connectTo2").show();
        else
            $("#connectTo2").hide();
    }
  function hello(){
    if ($("#connectTo_fitur").val() === "Other"){
      $("#connectTo3").show();
    }
    else {
      $("#connectTo3").hide();
    }
  }
    
function crot(){

$a = $('#ahuh').val();
if ($a == "1"){
  $.ajax({
          url: "<?php echo base_url("pengajuan/haha");?>",
          type: "POST",
          data: {},
          dataType: "json",
          success: function(data){
            //$("#div-list-fitur2").html(msg);
            //console.log(msg);
             for(let i = 0; i < data.length; i++){
              $('#connectTo_app-1').append('<option value="'+data[i]['id_app']+'">'+data[i]['nama_app']+'</option>');
              //text += '<option value="'+data[i]['id_app']+'">'+data[i]['nama_app']+'</option>';
            }
            }
             
          });
}
else
{
  //alert('2');
  $.ajax({
          url: "<?php echo base_url("pengajuan/haha");?>",
          type: "POST",
          data: {},
          dataType: "json",
          success: function(data){
            //$("#div-list-fitur2").html(msg);
            //console.log(msg);
             for(let i = 0; i < data.length; i++){
              ///$('#connectTo_app-1').append('<option value="'+data[i]['id_app']+'">'+data[i]['nama_app']+'</option>');
              //text += '<option value="'+data[i]['id_app']+'">'+data[i]['nama_app']+'</option>';
            }
            }
             
          });
}

  
}

function hemm(){
  //alert("hemm");
  $id = $('#connectTo_app-1').val();
  $.ajax({
          url: "<?php echo base_url("pengajuan/konfit");?>",
          type: "POST",
          data: {id_app:$id},
          dataType: "json",
          success: function(data){
            console.log(data);
            //$("#div-list-fitur2").html(msg);
            //console.log(msg);
            $('#njir').append('<div class="form-group" id="fiturkonek"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Konek ke Fitur <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select id="lemes1" type="text" name="connectTo_app-1" onchange="hemm();" required="required"  class="form-control col-md-7 col-xs-12 target"></select></div></div>');
             for(let i = 0; i < data.length; i++){
               $('#lemes1').append('<option value="'+data[i]['id_fitur']+'">'+data[i]['nama_fitur']+'</option>');
            }
            }
             
          })
}
*/

//--------- end logic Connect To ------------


$(document).ready(function() {
 
 // crot();
  //alert('aa');
/*  $( ".target" ).change(function() {
  alert( "Handler for .change() called." );

});*/


//--------- logic setting show form exis / versioning ---------

    init_SmartWizard();

    $(".myRadios").change(function(){
      if($(this).val() == "new") {
        console.log("baru");
        $("#versi_a").val(1);
         $("#versi_b").val(0);
          $("#versi_c").val(0);
        $.ajax({
           type: "POST",
           url: "<?php echo base_url("pengajuan/hai");?>",
           data: {}, // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });
        $("#div-new").css("display", "block");
        $("#div-existing").css("display", "none");
      }
      else if ($(this).val() == "existing") {
        console.log("exis");
        id_app = $("#id_app").val();
        //id_f
        $("#div-new").css("display", "none");
        $("#div-existing").css("display", "block");  
      }
      else if ($(this).val() == "versioning") {
        console.log("versi");
        $("#div-new").css("display", "none");
        $("#div-existing").css("display", "block");  
      }
    });

    if($(".myRadios").val() == "new") {
      $("#versi_a").val(1);
         $("#versi_b").val(0);
          $("#versi_c").val(0);

    }

    $(".myRadios_2").change(function(){
      if($(this).val() == "new") {
        $("#div-newx").css("display", "block");
        $("#div-exis").css("display", "none");
      }
      else if ($(this).val() == "existing") {
        console.log("exis");
        id_app = $("#id_app").val();
        //id_f
        $("#div-newx").css("display", "none");
        $("#div-exis").css("display", "block");  
      }
      else if ($(this).val() == "versioning") {
        console.log("versi");
        $("#div-newx").css("display", "none");
        $("#div-exis").css("display", "block");  
      }
    });
        
}); 

</script>