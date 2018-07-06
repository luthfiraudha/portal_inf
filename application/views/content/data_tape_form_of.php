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
                        <h2>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Volume ID
                                </label>
                                <div class="col-md-5 col-sm-10 col-xs-12">
                                    <p>: <?php echo $content_tape_of->vol_id; ?><p>
                                </div>
                                <div>
                                    <p><i><b><u>History</u></i></b><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Tanggal Data
                                </label>
                                <div class="col-md-5 col-sm-10 col-xs-12">
                                    <p>: <?php echo $content_tape_of->tanggal; ?><p>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-12" >Rak Sebelum
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $content_tape_of->rak_before; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Hostname
                                </label>
                                <div class="col-md-5 col-sm-10 col-xs-12">
                                    <p>: <?php echo $content_tape_of->hostname; ?><p>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-12" >Koordinat Sebelum
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $content_tape_of->koordinat_before; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >IP
                                </label>
                                <div class="col-md-5 col-sm-10 col-xs-12">
                                    <p>: <?php echo $content_tape_of->ip; ?><p>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-12" >Last Updated by
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $content_tape_of->user_pn; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Lokasi
                                </label>
                                <div class="col-md-5 col-sm-10 col-xs-12">
                                    <p>: <?php echo $content_tape_of->lokasi; ?><p>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-12" >Last Updated on
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $content_tape_of->lastupdated; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Size
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo number_format(($content_tape_of->size/1024), 2)." GB"; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Jenis
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $content_tape_of->jenis; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Rak
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $content_tape_of->rak_after; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Koordinat
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $content_tape_of->koordinat_after; ?><p>
                                </div>
                            </div>
                        </h2>

                        
                        <?php
                    } else if ($this->fitur == 'Tambah'){
                        ?>
                        

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Volume ID<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vol_id" required="required" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '99-9999'" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Lokasi<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="lokasi" id="lokasi"> 
                                        <option value ="GTI">GTI</option> 
                                        <option value ="SUD">SUD</option>       
                                        <option value ="DRC">DRC</option>    
                                        
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal<span class="required">*</span>
                            </label>
                               <div class="control-group">
                                <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback required">
                                             <input type="text" name="tanggal" class="form-control has-feedback-left" id="single_cal1" required="required" value="<?php if ($this->fitur == 'Ubah') echo $newdate1; ?>">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Rak<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="rak" id="rak">  
                                        <option value="Vault 1">Vault 1</option>    
                                        <option value="Vault 2">Vault 2</option>
                                        <option value="Vault 3">Vault 3</option>
                                        <option value="Vault 4">Vault 4</option>
                                        <option value="Vault 5">Vault 5</option>    
                                        <option value="Vault 6">Vault 6</option>
                                        <option value="Vault 7">Vault 7</option>
                                        <option value="Vault 8">Vault 8</option>
                                        <option value="Vault 9">Vault 9</option>
                                        <option value="Vault 10">Vault 10</option> 
                                        <option value="Robot">Robot</option>                                         
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Koordinat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="koordinat" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Size<span class="required">*</span>
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <input type="number" name="size" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <select class="form-control" name="tipe" id="tipe">                                                
                                        <option value="MB">MegaByte</option>    
                                        <option value="GB" selected="selected">GigaByte</option>
                                </select>
                            </div>
                        </div>
                                   

                    <?php }

                    else if ($this->fitur == 'Ubah'){?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Volume ID<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-2 col-xs-6">
                                <input type="text" name="vol_id" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $content_tape_of->vol_id;?>" readonly>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" required="required">Tanggal Data
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="tanggal" class="form-control has-feedback-left" required="required" id="single_cal1"  value="<?php echo date("m/d/Y", strtotime($content_tape_of->tanggal));?>">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Host Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="hostname" id ="hostname" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $content_tape_of->hostname;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >IP<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="ip" id ="ip" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $content_tape_of->ip;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Size<span class="required">*</span>
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <input type="decimal" name="size" min="0" id="size" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo number_format($content_tape_of->size/1024, 2)?>">
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <select class="form-control" name="ukuran" id="ukuran" ?>"> 
                                        <option value ="GB">GigaByte</option> 
                                        <option value ="MB">MegaByte</option>       
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Status<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="status" id="status" ?>"> 
                                        <option value ="Harian" <?php if($content_tape_of->jenis == "Harian") echo 'selected="selected"';?> >Harian</option> 
                                        <option value ="Mingguan" <?php if($content_tape_of->jenis == "Mingguan") echo 'selected="selected"';?> >Mingguan</option>       
                                        <option value ="Bulanan" <?php if($content_tape_of->jenis == "Bulanan") echo 'selected="selected"';?> >Bulanan</option>
                                </select>
                            </div>
                        </div>
                    <?php }
                    else if ($this->fitur == 'Request'){?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Volume ID<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vol_id" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_of->vol_id;?>" readonly>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >No Surat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="no_surat" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tujuan<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="tujuan" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Perihal<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="perihal" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Lokasi<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="lokasi" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_of->lokasi;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Rak<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="rak_after" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_of->rak_after;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Koordinat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="koordinat_after" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_of->koordinat_after;?>" readonly>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php if ($this->fitur == 'Lihat') { ?>
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $content_tape_of->id_content); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                            <?php } ?>
                            <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah' || $this->fitur == 'Request') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>

                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
