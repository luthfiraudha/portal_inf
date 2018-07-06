<script type="text/javascript">

function yesnoCheck(box) {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';

}




</script>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu; ?> |<small><?php echo $this->fitur; ?></small></h2>
                <div class="clearfix"></div>
            </div>

            <?php cetak_flash_msg(); ?>
            <?php if (!empty($alert['message'])) { ?>
                <div class="alert alert-<?php echo $alert['class']; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <?php echo $alert['message']; ?>
                </div>
            <?php } ?>

            <?php if ($this->fitur != 'Lihat') { ?>

                <div class="alignleft" style="padding-left: 23%;">
                    <!--                    <h4>Informasi</h4>
                                        <ul>
                                            <li>Hak Akses tidak dapat dihapus.</li>
                                            <li>Beberapa Hak Akses tidak dapat diubah.</li>
                                        </ul>
                                    -->
                </div>



            <?php } ?>
            <div class="x_content">
                <br />

                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
                    <?php if ($this->fitur == 'Lihat') { ?>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Pos Anggaran
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pakai_anggaran_detail->nama_anggaran; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Kanwil / Divisi
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pakai_anggaran_detail->kanwil_divisi; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Kanca / Bagian
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pakai_anggaran_detail->kanca_bagian; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Pembuat
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pakai_anggaran_detail->pengirim; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Judul IP
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pakai_anggaran_detail->judul_ip; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Nomor Surat
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pakai_anggaran_detail->nomor_surat; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Keperluan
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pakai_anggaran_detail->keperluan; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Nilai
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pakai_anggaran_detail->nilai; ?><p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" >Tanggal
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <p>: <?php echo $pakai_anggaran_detail->tanggal; ?><p>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        <?php
                    } else {
                        ?>
                      
                      
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Pos Anggaran
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="id_anggaran" name="id_anggaran">
                                   <?php
                             foreach ($pos_anggaran as $key) {
                                 
                                    echo "<option value=".$key->id_anggaran.">".$key->nama_anggaran."</option>"; // change This Line
                             
                             }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kawil / Divisi
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="kanwil_divisi" required="required"  class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah')  echo $pakai_anggaran_detail->kanwil_divisi;?>" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kanca / Bagian
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="kanca_bagian" required="required"  class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah')  echo $pakai_anggaran_detail->kanca_bagian;?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Pembuat
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="pengirim" required="required"  class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah')  echo $pakai_anggaran_detail->pengirim;?>" >
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Judul IP
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="judul_ip" required="required"  class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah')  echo $pakai_anggaran_detail->judul_ip;?>" >
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nomor Surat
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nomor_surat" required="required"  class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah')  echo $pakai_anggaran_detail->nomor_surat;?>" >
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Keperluan
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="keperluan" required="required"  class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah')  echo $pakai_anggaran_detail->keperluan;?>" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal
                            </label>
                             <?php 
                            if($this->fitur == 'Ubah'){
                            $newdate1 = date("m/d/Y", strtotime($pakai_anggaran_detail->tanggal));
                            
                             }
                            
                            ?>
                               <div class="control-group">
                                <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                             <input type="text" name="tanggal" class="form-control has-feedback-left" id="single_cal1" value="<?php if ($this->fitur == 'Ubah')  echo $newdate1;?>">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            
                                        </div>
                                    </div>
                                 </div>
                            
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nilai
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" onkeyup="checkconfirm()" name="nilai" required="required"  class="form-control col-md-7 col-xs-12 numeric" value="<?php if ($this->fitur == 'Ubah')  echo $pakai_anggaran_detail->nilai;?>" maxlength="10" autocomplete="off" >
                                <span class="help-block confirm">Nilai tidak boleh melebihi anggaran </span>

                            </div>
                        </div>
                          <?php  
                        if($this->fitur == 'Ubah'){
                            ?>
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" onclick="yesnoCheck('ifYes')" id="yesCheck" name="yesno"  /> Update file dokumen
                            </div>
                        </div>
                        <div class="form-group" id="ifYes" style="display:none;">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dokumen <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="upload_surat" required="required" class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                         <?php
                        }else{
                        ?>    
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dokumen <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="upload_surat" required="required" class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                        
                        <?php } ?>
                                     
                       
                  
                                                          

                    <?php }
                    ?>
                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                            <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php if ($this->fitur == 'Lihat') { ?>
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $pakai_anggaran_detail->id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                            <?php } ?>
                            <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah') { ?>
                                <button type="submit"   class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>

                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    function checkconfirm() {
        var nilai = $('input[name=nilai]').val();
        var id_anggaran = $('#id_anggaran').val();
        //var repass = $('input[name=repassword]').val();
        if (nilai !='' ) {
            console.log(id_anggaran);
             $.ajax({
            type: "POST",
            url: "/portalinf/Pakai_anggaran/ajax_ceknilai/",
            data: {id_anggaran: id_anggaran},
            cache: false,
            success: function(data) {
                    //alert(id_anggaran);
                    console.log(data);

                    var sisa = data-nilai;
                    console.log(sisa);
                    if(sisa < 0){
                        $('.form-group.passfield').removeClass('has-success').addClass('has-error');
                        $('.confirm').text('Dana anggaran kurang');
                    }else{
                        $('.form-group.passfield').removeClass('has-error').addClass('has-success');
                        // var lala = 'Dana anggaran cukup dengan sisa ' + sisa;
                        $('.confirm').text('Dana anggaran cukup dengan sisa ' + sisa);
                    }
                   
                }
            });
            // alert("Please Fill All Fields");
            // $('.form-group.passfield').removeClass('has-error').addClass('has-error');
            // $('.confirm').text('Nilai tidak boleh kosong');
        } else {
                        
            // AJAX code to submit form.
            // $.ajax({
            // type: "POST",
            // url: "/portalinf/Pakai_anggaran/ajax_ceknilai/",
            // data: {id_anggaran: id_anggaran},
            // cache: false,
            // success: function(html) {
            //         alert(html);
            //         // if(){

            //         // }else{
            //         //     $('.form-group.passfield').removeClass('has-success').addClass('has-error');
            //         //     $('.confirm').text('Confirm Password has not matched with Password');
            //         // }
                   
            //     }
            // });
            
            
        }
        return false;
    }
    

</script>

