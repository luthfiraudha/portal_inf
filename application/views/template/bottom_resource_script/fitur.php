<script type="text/javascript">
function first()
{
	//alert("s");
  $dt = $('#hidden').val();

    $('#body').append('<div class="form-group"><div id="loop-'+$dt+'"><input type="hidden" name="hid" id="hid-1" value="1"/><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Fitur <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input  type="text" name="nama_fitur[]" required="required" class="form-control col-md-7 col-xs-12"></div><button type="button" class="btn btn-round btn-primary" id="tambahfitur" onclick="submitx()">Tambah Fitur</button><button type="button" class="btn btn-round btn-danger" id="kurangfitur" onclick="submitkuranga()">Kurangi Fitur</button></div>'+

      '<div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Deskripsi Fitur <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><textarea type="text" name="des_fitur[]" required="required" class="form-control col-md-7 col-xs-12"></textarea></div></div><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Bagian Pengembang <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input  type="text" name="pengembang[]" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Programmer <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input  type="text" name="programmer[]" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >platform <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select class="form-control" type="text" name="platform[]" required="required" class="form-control col-md-7 col-xs-12" ><option></option><option value="Apache">Apache</option><option value="Tomcat">Tomcat</option><option value="Nginx">Nginx</option><option value="Iis">Iis</option></select></div></div>'+

      //---dropdown database / web / WS / Sch ---
    	'<div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12">Tipe Fitur <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select id="tipe_fiturs[]" onchange="getname('+$dt+',this)" type="text" name="tipe_fiturs[]" required="required" class="form-control col-md-7 col-xs-12"><option></option><option value="Database">Database</option><option value="Web">Web</option><option value="Web Service">Web Service</option><option value="Scheduler">Scheduler</option><option value="Lain-lain">Lain-lain</option></select></div></div><div id="tambah-'+$dt+'"></div>'+

      '<div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Upload Dokumen Source Code (.rar) <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input type="file" name="dok_link[]" required="required" class="form-control col-md-7 col-xs-12" ?></div></div><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Upload Dokumen How To (.pdf)</label><div class="col-md-5 col-sm-6 col-xs-12"><input type="file" name="dok_HowTo[]" class="form-control col-md-7 col-xs-12" ?></div></div></div>');

}

function submitx(){
    $dt = parseInt($('#hidden').val()) + 1;
    $('#hidden').val($dt);
    $('#body').append('<div class="form-group"><div id="loop-'+$dt+'"><input type="hidden" name="hid" id="hid-'+$dt+'" value="1"/><hr><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Fitur '+$dt+' <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input  type="text" name="nama_fitur[]" required="required" class="form-control col-md-7 col-xs-12"></div></div>'+

      '<div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Deskripsi Fitur <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><textarea type="text" name="des_fitur[]" required="required" class="form-control col-md-7 col-xs-12"></textarea></div></div><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Bagian Pengembang <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input  type="text" name="pengembang[]" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Programmer <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input  type="text" name="programmer[]" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >platform <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select class="form-control" type="text" name="platform[]" required="required" class="form-control col-md-7 col-xs-12" ><option></option><option value="Apache">Apache</option><option value="Tomcat">Tomcat</option><option value="Nginx">Nginx</option><option value="Iis">Iis</option></select></div></div>'+

      
      '<div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Tipe Fitur <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select id="tipe_fiturs[]" onchange="getname('+$dt+', this)" type="text" name="tipe_fiturs[]" required="required" class="form-control col-md-7 col-xs-12"><option></option><option value="Database">Database</option><option value="Web">Web</option><option value="Web Service">Web Service</option><option value="Scheduler">Scheduler</option><option value="Lain-lain">Lain-lain</option></select></div></div><div id="tambah-'+$dt+'"></div>'+
      
      '<div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Upload Dokumen (.rar) <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input type="file" name="dok_link[]" required="required" class="form-control col-md-7 col-xs-12" ?></div></div><div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Upload Dokumen How To (.pdf)</label><div class="col-md-5 col-sm-6 col-xs-12"><input type="file" name="dok_HowTo[]" class="form-control col-md-7 col-xs-12" ?></div></div></div>');

 }

function getname($a,$b){ // --- get nama aplikasi ---
 
  if (($b.value == 'Database') || ($b.value == '')){
    $('#hid-'+$a+'').val(1);
    $('#tambah-'+$a+'').empty();
  }
  else
  {
   // alert($a+','+$b.value);
    $.ajax({
      url: "<?php echo base_url("pengajuan/getapp");?>",
      type: "POST",
      data: {id_app:$b.value},
      dataType: "json",
      success: function(data){
        $('#hid-'+$a+'').val(1);
        $dt = $('#hid-'+$a+'').val();
        $('#tambah-'+$a+'').empty();
        $x= parseInt($a)-1;
        $y= parseInt($dt)-1;
        //console.log(data);
        var text = '<div class="form-group" id="rmv-1"><div><label class="control-label col-md-4 col-sm-3 col-xs-12" >Konek ke Aplikasi <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select name="nama_app_to['+$x+']['+$y+'][]" id="nama_app_to[][][]" onchange="getfitur('+$a+','+$dt+',this)" class="form-control col-md-7 col-xs-12"><option></option>';
        for(let i = 0; i < data.length; i++){
          text += '<option value="'+data[i]['id_app']+'">'+data[i]['nama_app']+'</option>';
        }
        text += '</select></div><div class="col-md-3 col-sm-3 col-xs-6"><button class="btn btn-round btn-primary" type="button" onclick="submittambah('+$a+','+$dt+',this)">+</button><button type="button" class="btn btn-round btn-danger" onclick="submitkurangb('+$a+','+$dt+')">-</button></div></div><div id="parent-'+$a+'"><div id="child-'+$dt+'"></div></div></div>';

       // console.log(text);
        

        $('#tambah-'+$a+'').append(text);
        }
         
    });

   

		/*$('#tambah-'+$a+'').append('<div class="form-group" id="rmv-1"><div><label class="control-label col-md-4 col-sm-3 col-xs-12" >Konek ke Aplikasi <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select name="nama_app[]" id="nama_app[]" onchange="getfitur('+$a+','+$dt+')" class="form-control col-md-7 col-xs-12"><option value="0">-</option><option value="1">'+$a+','+$dt+'</option></select></div><div class="col-md-3 col-sm-3 col-xs-6"><button class="btn btn-round btn-primary" type="button" onclick="submittambah('+$a+','+$dt+')">+</button><button type="button" class="btn btn-round btn-danger" onclick="submitkurangb('+$a+','+$dt+')">-</button></div></div><div id="parent-'+$a+'"><div id="child-'+$dt+'"></div></div></div>');*/

  }
}

function opsi($a,$b,$z)
  {
    $('#tambah-'+$a+'').children('#rmv-'+$b+'').children('#parent-'+$a+'').children('#child-'+$b+'').children('.form-group').children('#opsi-'+$b+'').empty();
    if (($z.value == 'Pihak Ketiga') || ($z.value == 'FTP'))
    {
     $x= parseInt($a)-1;
     $y= parseInt($b)-1;
     $('#tambah-'+$a+'').children('#rmv-'+$b+'').children('#parent-'+$a+'').children('#child-'+$b+'').children('.form-group').children('#opsi-'+$b+'').append('<label class="control-label col-md-4 col-sm-3 col-xs-12" >Alamat IP <span>*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input type="text" name="ip_koneksi['+$x+']['+$y+'][]" required="required" onkeyup="validAngka(this)" class="form-control col-md-7 col-xs-12" ?></div>');
      /*$('#Tambah-'+$a+'').children('#rmv-'+$b+'').children('#opsi-'+$b+'').append('<div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Alamat IP <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><input type="text" name="ip_koneksi[]" required="required" onkeyup="validAngka(this)" class="form-control col-md-7 col-xs-12" ?></div></div>');   */   
    }
  }

function getfitur($a,$b,$x){ //--- get nama fitur ---
if ($x.value == ''){
    $('#tambah-'+$a+'').children('#rmv-'+$b+'').children('#parent-'+$a+'').children('#child-'+$b+'').empty();
  }
  else
  {
    $.ajax({
        url: "<?php echo base_url("pengajuan/getfit");?>",
        type: "POST",
        data: {id_app:$x.value},
        dataType: "json",
        success: function(data){
          $x= parseInt($a)-1;
          $y= parseInt($b)-1;
          var text ='<div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Konek ke Fitur <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select name="nama_fitur_to['+$x+']['+$y+'][]" id="nama_fitur_to[]" class="form-control col-md-7 col-xs-12" onchange="opsi('+$a+','+$b+',this)"><option></option><option value="FTP">FTP</option><option value="Pihak Ketiga">Pihak Ketiga</option>';
          for(let i = 0; i < data.length; i++){
            text += '<option value="'+data[i]['nama_fitur']+'">'+data[i]['nama_fitur']+'</option>';
          }
          text += '</select></div><div id="opsi-'+$b+'"></div></div>';

          $('#tambah-'+$a+'').children('#rmv-'+$b+'').children('#parent-'+$a+'').children('#child-'+$b+'').empty();
          $('#tambah-'+$a+'').children('#rmv-'+$b+'').children('#parent-'+$a+'').children('#child-'+$b+'').append(text);
        }

      });
  }
    /*$('#tambah-'+$a+'').children('#rmv-'+$b+'').children('#parent-'+$a+'').children('#child-'+$b+'').empty();
    $('#tambah-'+$a+'').children('#rmv-'+$b+'').children('#parent-'+$a+'').children('#child-'+$b+'').append('<div class="form-group"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Konek ke Fitur <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select name="nama_fitur[]" id="nama_fitur[]" class="form-control col-md-7 col-xs-12"><option value="0">Fitur A</option><option value="1">fitur B</option></select></div></div>');*/
  }

function submittambah($a,$b,$y){

  $.ajax({
      url: "<?php echo base_url("pengajuan/getapp");?>",
      type: "POST",
      data: {id_app:$y.value},
      dataType: "json",
      success: function(data){

    $dt = $('#loop-'+$a+'').children('#hid-'+$a+'').val();
    $c = parseInt($dt) + 1;
    $x= parseInt($a)-1;
    $y= parseInt($b)-1;
        var text = '<div class="form-group" id="rmv-'+$c+'"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Konek ke Aplikasi <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select name="nama_app_to['+$x+']['+$y+'][]" id="nama_app_to[][][]" onchange="getfitur('+$a+','+$c+',this)" class="form-control col-md-7 col-xs-12"><option></option>';
        for(let i = 0; i < data.length; i++){
          text += '<option value="'+data[i]['id_app']+'">'+data[i]['nama_app']+'</option>';
        }
        text += '</select></div><div id="parent-'+$a+'"><div id="child-'+$c+'"></div></div></div>';

    
    $('#tambah-'+$a+'').append(text);
    $('#loop-'+$a+'').children('#hid-'+$a+'').val($c);

    }

  });
    
    /*$dt = $('#loop-'+$a+'').children('#hid-'+$a+'').val();
    $c = parseInt($dt) + 1;
    
    $('#tambah-'+$a+'').append('<div class="form-group" id="rmv-'+$c+'"><label class="control-label col-md-4 col-sm-3 col-xs-12" >Konek ke Aplikasi <span class="required">*</span></label><div class="col-md-5 col-sm-6 col-xs-12"><select name="nama_app[]" id="nama_app[]" onchange="getfitur('+$a+','+$c+',this)" class="form-control col-md-7 col-xs-12"><option value="0">-</option><option value="1">'+$a+','+$c+'</option></select></div><div id="parent-'+$a+'"><div id="child-'+$c+'"></div></div></div>');
    
    $('#loop-'+$a+'').children('#hid-'+$a+'').val($c);*/

}

function submitkuranga(){ //--- submit kurang fitur ---
    $dt = $('#hidden').val();
    if ($dt == '1'){
      alert('tidak ada data yang terhapus');
    }
    else
    {
      $x = parseInt($dt) - 1;
      $('#loop-'+$dt+'').remove();
      $('#hidden').val($x);
    }
    
  }
  function submitkurangb($a,$b){ // --- submit kurang koneksi ---
    $dt = $('#loop-'+$a+'').children('#hid-'+$a+'').val();
    if ($dt == '1'){
      alert('tidak ada data yang terhapus');
    }
    else
    {
      $x = parseInt($dt) - 1;
      $('#tambah-'+$a+'').children('#rmv-'+$dt+'').remove();
      $('#loop-'+$a+'').children('#hid-'+$a+'').val($x);
    }
  }

  

  //-------- input angka saja -----------
  function validAngka(a)
  {
    if(!/^[0-9.]+$/.test(a.value))
    {
    a.value = a.value.substring(0,a.value.length-1000);
    }
  }



$(document).ready(function() {
  //alert('ddd');
  first();

});
</script>
 