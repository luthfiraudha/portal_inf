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
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_tape->vol_id; ?><p>
                                </div>
                                <div>
                                    <p><i><b><u>History</u></i></b><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Tanggal Data
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_tape->start_date; ?><p>
                                </div>
                                <label class="col-md-3 col-sm-3 col-xs-12" >Rak Sebelum
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape->rak_before; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Kadaluarsa
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_tape->end_date; ?><p>
                                </div>
                                <label class="col-md-3 col-sm-3 col-xs-12" >Koordinat Sebelum
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape->koordinat_before; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Lokasi
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_tape->lokasi; ?><p>
                                </div>
                                <label class="col-md-3 col-sm-3 col-xs-12" >Last Updated by
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape->user_pn; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Set
                                </label>
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_tape->set_tape; ?><p>
                                </div>
                                <label class="col-md-3 col-sm-3 col-xs-12" >Last Updated on
                                </label>
                                <div class="col-md-3 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape->lastupdated; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >State
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape->state; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Rak
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape->rak_after; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Koordinat
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape->koordinat_after; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Media Class
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape->jenis; ?><p>
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
                                <input type="text" name="vol_id" required="required" class="form-control col-md-7 col-xs-12" value="">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal Data<span class="required">*</span>
                            </label>
                            <?php 
                            if($this->fitur == 'Ubah'){
                            $newdate1 = date("m/d/Y", strtotime($data_tape->start_date));
                            
                             }
                            
                            ?>
                          
                               <div class="control-group">
                                <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback required">
                                             <input type="text" name="start_date" class="form-control has-feedback-left" id="single_cal1" required="required" value="<?php if ($this->fitur == 'Ubah') echo $newdate1; ?>">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Rak<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="rak_after" id="rak_after">  
                                              
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
                                <input type="text" name="koordinat_after" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>

                    <?php }

                    else if ($this->fitur == 'Ubah'){?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Volume ID<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vol_id" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape->vol_id;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Lokasi<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="lokasi" id="lokasi"> 
                                        <option value ="GTI" <?php if($data_tape->lokasi == "GTI") echo 'selected="selected"';?> >GTI</option> 
                                        <option value ="SUD" <?php if($data_tape->lokasi == "SUD") echo 'selected="selected"';?> >SUD</option>       
                                        <option value ="DRC" <?php if($data_tape->lokasi == "DRC") echo 'selected="selected"';?> >DRC</option>    
                                        
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" required="required">Tanggal Data
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="start_date" class="form-control has-feedback-left" required="required" id="single_cal1"  value="">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kadaluarsa
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="end_date" class="form-control has-feedback-left" id="single_cal2" 
                                         value="">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Set<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="set_tape" id="set_tape">  
                                        <option value ="SET 1" <?php if($data_tape->set_tape == "Set 1") echo 'selected="selected"';?> >Set 1</option>       
                                        <option value ="SET 2" <?php if($data_tape->set_tape == "Set 2") echo 'selected="selected"';?> >Set 2</option>    
                                        <option value ="SET 3" <?php if($data_tape->set_tape == "Set 3") echo 'selected="selected"';?> >Set 3</option>       
                                        <option value ="SET 4" <?php if($data_tape->set_tape == "Set 4") echo 'selected="selected"';?> >Set 4</option>    
                                        <option value ="SET 5" <?php if($data_tape->set_tape == "Set 5") echo 'selected="selected"';?> >Set 5</option>    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >State<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="state" id="state" ?>">  
                                        <option value ="Before" <?php if($data_tape->state == "Before") echo 'selected="selected"';?> >Before</option>       
                                        <option value ="After" <?php if($data_tape->state == "After") echo 'selected="selected"';?> >After</option>    
                                        
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Status<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="status" id="status" ?>">
                                        <option value ="EOD" <?php if($data_tape->status == "EOD") echo 'selected="selected"';?> >EOD</option>       
                                        <option value ="EOM" <?php if($data_tape->status == "EOM") echo 'selected="selected"';?> >EOM</option>    
                                        <option value ="EOY" <?php if($data_tape->status == "EOY") echo 'selected="selected"';?> >EOY</option>       
                                        <option value ="Request"  <?php if($data_tape->status == "Request") echo 'selected="selected"';?> >Request</option>    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Rak<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="rak_after" id="rak_after">  
                                              
                                        <option value="Vault 1" <?php if($data_tape->rak_after == "Vault 1") echo 'selected="selected"';?> >Vault 1</option>    
                                        <option value="Vault 2" <?php if($data_tape->rak_after == "Vault 2") echo 'selected="selected"';?> >Vault 2</option>
                                        <option value="Vault 3" <?php if($data_tape->rak_after == "Vault 3") echo 'selected="selected"';?> >Vault 3</option>
                                        <option value="Vault 4" <?php if($data_tape->rak_after == "Vault 4") echo 'selected="selected"';?> >Vault 4</option>
                                        <option value="Vault 5" <?php if($data_tape->rak_after == "Vault 5") echo 'selected="selected"';?> >Vault 5</option>    
                                        <option value="Vault 6" <?php if($data_tape->rak_after == "Vault 6") echo 'selected="selected"';?> >Vault 6</option>
                                        <option value="Vault 7" <?php if($data_tape->rak_after == "Vault 7") echo 'selected="selected"';?> >Vault 7</option>
                                        <option value="Vault 8" <?php if($data_tape->rak_after == "Vault 8") echo 'selected="selected"';?> >Vault 8</option>
                                        <option value="Vault 9" <?php if($data_tape->rak_after == "Vault 9") echo 'selected="selected"';?> >Vault 9</option>
                                        <option value="Vault 10" <?php if($data_tape->rak_after == "Vault 10") echo 'selected="selected"';?> >Vault 10</option> 
                                        <option value="Robot" <?php if($data_tape->rak_after == "Robot") echo 'selected="selected"';?> >Robot</option>                                         
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Koordinat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="koordinat_after" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape->koordinat_after;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Media Class<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="jenis" id="jenis">  
                                              
                                        <option value="Source" <?php if($data_tape->jenis == "Source") echo 'selected="selected"';?> >Source</option>    
                                        <option value="Duplikat" <?php if($data_tape->jenis == "Duplikat") echo 'selected="selected"';?> >Duplikat</option>                                   
                                </select>
                            </div>
                        </div>
                    <?php }
                    else if ($this->fitur == 'Request'){?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Volume ID<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vol_id" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_pf->vol_id;?>" readonly>
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
                                <input type="text" name="lokasi" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_pf->lokasi;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Rak<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="rak_after" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_pf->rak_after;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Koordinat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="koordinat_after" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_pf->koordinat_after;?>" readonly>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php if ($this->fitur == 'Lihat') { ?>
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $data_tape->id_tape); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
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

