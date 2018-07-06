<script type="text/javascript">

//--- tampil awal -----
function awal(){ // --- get nama aplikasi ---
//alert('xx');
$angka = $('#angka').val();
//alert($angka);
  $.ajax({
    url: "<?php echo base_url("data_koneksi/get_app");?>",
    type: "POST",
    data: {},
    dataType: "json",
    success: function(data){
      //$("#div-list-app").html(msg);
      //console.log(msg);
      var text= '<div id="hps-'+$angka+'"><div class="form-group" id="ulang-'+$angka+'"><label class="control-label col-md-3 col-sm-2 col-xs-12" id="span" >Koneksi Ke Aplikasi : <span>*</span></label><div class="col-md-4 col-sm-8 col-xs-12"><select id="koneksi_app" name="koneksi_apps[]" onchange="koneksi_fitur('+$angka+',this)" required="required"  class="form-control col-md-7 col-xs-12 target"><option></option>';

        for(let i = 0; i < data.length; i++){
        text += '<option value="'+data[i]['id_app']+'">'+data[i]['nama_app']+'</option>';
        }

        text += '</select></div><button type="button" class="btn btn-round btn-primary" id="tambahyax" onclick="tambahya()">+</button><button type="button" class="btn btn-round btn-danger" id="kurangyaw" onclick="kurangya()">x</button></div><div class="form-group" id="tampil_fitur-'+$angka+'"></div></div>';

        $('#koneksi_app').append(text);
      }
       
    });
}

function tambahya(){ // --- get nama aplikasi ---
//alert('xx');
  $angka = parseInt($('#angka').val()) + 1;
  $('#angka').val($angka);
  $.ajax({
    url: "<?php echo base_url("data_koneksi/get_app");?>",
    type: "POST",
    data: {},
    dataType: "json",
    success: function(data){
      //$("#div-list-app").html(msg);
      //console.log(msg);
      var text= '<div id="hps-'+$angka+'"><div class="form-group" id="ulang-'+$angka+'"><label class="control-label col-md-3 col-sm-2 col-xs-12" id="span" >Koneksi Ke Aplikasi : <span>*</span></label><div class="col-md-4 col-sm-8 col-xs-12"><select id="koneksi_app" name="koneksi_apps[]" onchange="koneksi_fitur('+$angka+',this)" required="required"  class="form-control col-md-7 col-xs-12 target"><option></option>';

        for(let i = 0; i < data.length; i++){
        text += '<option value="'+data[i]['id_app']+'">'+data[i]['nama_app']+'</option>';
        }

        text += '</select></div></div><div class="form-group" id="tampil_fitur-'+$angka+'"></div></div>';

        $('#koneksi_app').append(text);
      }
       
    });
}

function koneksi_fitur($a,$b){
 // alert($a +'|'+ $b.value);
  
  $('#tampil_fitur-'+$a+'').empty();
  if ($b.value != '')
  {
  $id = $b.value;
  //alert($id);
  $.ajax({
      url: "<?php echo base_url("data_koneksi/get_fiturr");?>",
      type: "POST",
      data: {id_app:$id},
      dataType: "json",
      success: function(data){
        //alert('aa');
        console.log(data);

        //$("#div-list-fitur2").html(msg);
        //console.log(msg);
        //var text = '<select id="koneksi_fiturx" name="koneksi_fitur[]" onchange="koneksi_ip(this)" ></select>';
        var text = '<div class="form-group"><label class="control-label col-md-3 col-sm-2 col-xs-12" id="span" >Koneksi Ke Fitur : <span>*</span></label><div class="col-md-4 col-sm-8 col-xs-12"><select id="koneksi_fiturx" name="koneksi_fiturs[]" onchange="koneksi_ip('+$a+', this)" required="required"  class="form-control col-md-7 col-xs-12 target"><option></option><option value="FTP">FTP</option><option value="Pihak Ketiga">Pihak Ketiga</option>';

         for(let i = 0; i < data.length; i++){
           text+= '<option value="'+data[i]['nama_fitur']+'">'+data[i]['nama_fitur']+'</option>';
          }
          text += '</select></div></div><div class="form-group" id="tampil_ip-'+$a+'"></div>';

      $('#tampil_fitur-'+$a+'').append(text);
    }
  });
}
}

function koneksi_ip($y, $z)
  {
    //alert($z.value);
    $('#tampil_ip-'+$y+'').empty();
    if (($z.value == 'Pihak Ketiga') || ($z.value == 'FTP'))
    {
      //alert('xx');
     $('#tampil_ip-'+$y+'').append('<label class="control-label col-md-3 col-sm-2 col-xs-12" >Alamat IP <span>*</span></label><div class="col-md-4 col-sm-8 col-xs-12"><input type="text" name="koneksi_ips[]" required="required" onkeyup="validAngka(this)" class="form-control col-md-7 col-xs-12"></div>'); 
    }

    else
    {
      $('#tampil_ip-'+$y+'').append('<input type="hidden" name="koneksi_ips[]" required="required" onkeyup="validAngka(this)" class="form-control col-md-7 col-xs-12">'); 
    }
  }

function kurangya(){
  //$(aa.target).closest('div [id="koneksi_app"]').remove();
 //alert('tes');
  $aa = $('#angka').val();
    if ($aa == '1'){
      alert('tidak ada data yang terhapus');
    }
    else
    {
      //$x = parseInt($aa);
      $('#hps-'+$aa+'').remove();
      $('#angka').val(parseInt($aa)-1);
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

function editya(){ // --- get nama aplikasi ---
//alert('xx');
//alert($angka);
  $.ajax({
    url: "<?php echo base_url("data_koneksi/get_app");?>",
    type: "POST",
    data: {},
    dataType: "json",
    success: function(data){
      //$("#div-list-app").html(msg);
      //console.log(msg);
      var text= '<div class="form-group"><label class="control-label col-md-3 col-sm-2 col-xs-12" id="span" >Koneksi Ke Aplikasi : <span>*</span></label><div class="col-md-4 col-sm-8 col-xs-12"><select id="edit_koneksi_app" name="koneksi_apps" onchange="edit_koneksi_fitur(this)" required="required"  class="form-control col-md-7 col-xs-12 target"><option></option>';

        for(let i = 0; i < data.length; i++){
        text += '<option value="'+data[i]['id_app']+'">'+data[i]['nama_app']+'</option>';
        }

        text += '</select></div></div><div class="form-group" id="edit_tampil_fitur"></div>';

        $('#edit_koneksi_app').append(text);
      }
       
    });
}

function edit_koneksi_fitur($b){
 // alert($a +'|'+ $b.value);
  
  $('#edit_tampil_fitur').empty();
  if ($b.value != '')
  {
  $id = $b.value;
  //alert($id);
  $.ajax({
      url: "<?php echo base_url("data_koneksi/get_fiturr");?>",
      type: "POST",
      data: {id_app:$id},
      dataType: "json",
      success: function(data){
        //alert('aa');
        console.log(data);

        //$("#div-list-fitur2").html(msg);
        //console.log(msg);
        //var text = '<select id="koneksi_fiturx" name="koneksi_fitur[]" onchange="koneksi_ip(this)" ></select>';
        var text = '<div class="form-group"><label class="control-label col-md-3 col-sm-2 col-xs-12" id="span" >Koneksi Ke Fitur : <span>*</span></label><div class="col-md-4 col-sm-8 col-xs-12"><select id="edit_koneksi_fiturx" name="koneksi_fiturs" onchange="edit_koneksi_ip(this)" required="required"  class="form-control col-md-7 col-xs-12 target"><option></option><option value="FTP">FTP</option><option value="Pihak Ketiga">Pihak Ketiga</option>';

         for(let i = 0; i < data.length; i++){
           text+= '<option value="'+data[i]['nama_fitur']+'">'+data[i]['nama_fitur']+'</option>';
          }
          text += '</select></div></div><div class="form-group" id="tampil_ip"></div>';

      $('#edit_tampil_fitur').append(text);
    }
  });
}
}

function edit_koneksi_ip($z)
  {
    //alert($z.value);
    $('#tampil_ip').empty();
    if (($z.value == 'Pihak Ketiga') || ($z.value == 'FTP'))
    {
      //alert('xx');
     $('#tampil_ip').append('<label class="control-label col-md-3 col-sm-2 col-xs-12" >Alamat IP <span>*</span></label><div class="col-md-4 col-sm-8 col-xs-12"><input type="text" name="koneksi_ips" required="required" onkeyup="validAngka(this)" class="form-control col-md-7 col-xs-12"></div>'); 
    }

    else
    {
      $('#tampil_ip').append('<input type="hidden" name="koneksi_ips" required="required" onkeyup="validAngka(this)" class="form-control col-md-7 col-xs-12">'); 
    }
  }



$(document).ready(function() {
  //alert('ddd');
  awal();
  editya();

});

</script>
 