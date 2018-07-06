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
                <?php if($this->fitur == 'Konfigur') { ?>
                    <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Volume ID<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vol_id" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $sop_detail->sop_name; ?>">
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
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            </br>
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Cari </button>
                            </div>
                        </div>
                     </form>
                <?php }?>
                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
                        <?php if ($this->fitur == 'Edit') { ?>
                            <input type="hidden" name="id_tape" value="<?php echo $data_tape->id_tape; ?>">
                        <?php } ?>

                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Status 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="status" id="status"> 
                                        <option value="EOD">EOD</option>       
                                        <option value="EOM">EOM</option> 
                                        <option value="EOY">EOY</option>       
                                        <option value="Request">Request</option>                                        
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
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                             <input type="text" name="start_date" class="form-control has-feedback-left" id="single_cal1" value="<?php if ($this->fitur == 'Ubah') echo $newdate1; ?>">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            
                                        </div>
                                    </div>
                                 </div>                            
                        </div>

                        

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal Kadaluarsa<span class="required">*</span>
                            </label>
                            <?php 
                            if($this->fitur == 'Ubah'){
                            $newdate2 = date("m/d/Y", strtotime($data_tape->end_date));
                            //$newdate2 = strtotime ( '+1 day' , strtotime ( $newdate2 ) ) ;
                             }
                            
                            ?>
                          
                               <div class="control-group">
                                <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                             <input type="text" name="end_date" class="form-control has-feedback-left" id="single_cal2" value="<?php if ($this->fitur == 'Ubah') echo $newdate2; ?>">
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
                                        <option value="0">Kosong</option>    
                                        <option value="1">Set 1</option>
                                        <option value="2">Set 2</option>
                                        <option value="3">Set 3</option>
                                        <option value="4">Set 4</option>
                                        <option value="5">Set 5</option>
                                        
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >State<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="state" id="state"> 
                                        <option value="Before">Before</option>       
                                        <option value="After">After</option>    
                                        
                                </select>
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
                        
                                   

                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <?php if ($this->fitur == 'Lihat') { ?>
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $sop_detail->sop_id); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                            <?php } ?>
                            <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>

                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

