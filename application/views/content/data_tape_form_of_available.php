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
                                    <p>: <?php echo $data_tape_of->vol_id; ?><p>
                                </div>
                                <div>
                                    <p><i><b><u>History</u></i></b><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Tanggal Tape
                                </label>
                                <div class="col-md-5 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_tape_of->tanggal_tape; ?><p>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-12" >Rak Sebelum
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape_of->rak_before; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Lokasi
                                </label>
                                <div class="col-md-5 col-sm-10 col-xs-12">
                                    <p>: <?php echo $data_tape_of->lokasi; ?><p>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-12" >Koordinat Sebelum
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape_of->koordinat_before; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Free Data
                                </label>
                                <div class="col-md-5 col-sm-10 col-xs-12">
                                    <p>: <?php echo number_format((($data_tape_of->size_total-$data_tape_of->size_usage)/1024),2). " GB"; ?><p>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-12" >Last Updated by
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape_of->user_pn; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Size Usage
                                </label>
                                <div class="col-md-5 col-sm-10 col-xs-12">
                                    <p>: <?php echo number_format(($data_tape_of->size_usage/1024),2). " GB"; ?><p>
                                </div>
                                <label class="col-md-2 col-sm-2 col-xs-12" >Last Updated on
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape_of->lastupdated; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Size Total
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo number_format(($data_tape_of->size_total/1024), 2)." GB"; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Status
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape_of->status; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Rak
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape_of->rak_after; ?><p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 col-xs-12" >Koordinat
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <p>: <?php echo $data_tape_of->koordinat_after; ?><p>

                                </div>
                            </div>
                            <div class="form-group">
                                </br>
                                </br>
                                <label class="col-md-2 col-sm-2 col-xs-12" >List Host
                                </label></h2>
                                <table id="data-tape" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="background-color: grey; color:white;">
                                            <th>No</th>
                                            <th>Tanggal Data</th>
                                            <th>Host Name</th>
                                            <th>IP</th>
                                            <th>Size</th>
                                            <th>Jenis</th>
                                            <th width="180px">Detail</th>
                                        </tr>
                                        <?php $no=1; foreach ($content_tape_of as $row) { ?>
                                        <tr>
                                            <th><?php echo $no++; ?></th>
                                            <th><?php echo $row->tanggal;?></th>
                                            <th><?php echo $row->hostname;?></th>
                                            <th><?php echo $row->ip;?></th>
                                            <th><?php echo number_format(($row->size/1024), 2)." GB"; ?></th>
                                            <th><?php echo $row->jenis;?></th>
                                            <?php echo "<td style='text-align:center' width='140px'>
                            <a title='Lihat' href='".base_url().'data_tape_of/action/view/'.$row->id_content."' class='btn btn-circle btn-sm bg-green'>
                                <i class='fa fa-folder'></i>
                            </a> 
                            <a title='Request' href='".base_url().'data_tape_of/action/request/'.$row->id_content."' class='btn btn-circle btn-sm bg-orange'>
                                <i class='fa fa-send'></i>
                            </a>
                            <a title='Edit' href='".base_url().'data_tape_of/action/edit/'.$row->id_content."' class='btn btn-circle btn-sm bg-blue'>
                                <i class='fa fa-edit'></i>
                            </a>
                        </td>"; ?>
                                        </tr>
                                        <?php }
                                        ?>
                                        </thead>
                                </table>
                            </div>
                        
                        



               <!--  <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div> -->
                        
                        
                        <?php
                    } else if ($this->fitur == 'Tambah Host'){
                        ?>
                        

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Volume ID<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vol_id" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_of->vol_id;?>" readonly>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Host Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="hostname" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >IP<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="ip" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Size<span class="required">*</span>
                            </label>
                            <?php if ($size ==""){?>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <input type="number" name="size" required="required" class="form-control col-md-7 col-xs-12" value="">
                            </div>
                            <?php }
                            else {?>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <input type="number" name="size" min=0 required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $size;?>" readonly>
                            </div>
                            <?php }?>

                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <select class="form-control" name="tipe" id="tipe">                                                
                                        <option value="GB">GigaByte</option>  
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Jenis<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="jenis" id="jenis">                                                
                                        <option value="Harian">Harian</option>    
                                        <option value="Mingguan">Mingguan</option>
                                        <option value="Bulanan">Bulanan</option>
                                </select>
                            </div>
                        </div>
                                   

                    <?php }

                    else if ($this->fitur == 'Konfigurasi'){?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Volume ID<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vol_id" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_of->vol_id;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" required="required">Tanggal Tape
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="tanggal_tape" class="form-control has-feedback-left" required="required" id="single_cal1"  value="<?php echo date("m/d/Y", strtotime($data_tape_of->tanggal_tape));;?>">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Lokasi<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="lokasi" id="lokasi"> 
                                        <option value ="GTI" <?php if($data_tape_of->lokasi == "GTI") echo 'selected="selected"';?> >GTI</option> 
                                        <option value ="SUD" <?php if($data_tape_of->lokasi == "SUD") echo 'selected="selected"';?> >SUD</option>       
                                        <option value ="DRC" <?php if($data_tape_of->lokasi == "DRC") echo 'selected="selected"';?> >DRC</option>    
                                        
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Rak<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="rak_after" id="rak_after">  
                                              
                                        <option value="Vault 1" <?php if($data_tape_of->rak_after == "Vault 1") echo 'selected="selected"';?> >Vault 1</option>    
                                        <option value="Vault 2" <?php if($data_tape_of->rak_after == "Vault 2") echo 'selected="selected"';?> >Vault 2</option>
                                        <option value="Vault 3" <?php if($data_tape_of->rak_after == "Vault 3") echo 'selected="selected"';?> >Vault 3</option>
                                        <option value="Vault 4" <?php if($data_tape_of->rak_after == "Vault 4") echo 'selected="selected"';?> >Vault 4</option>
                                        <option value="Vault 5" <?php if($data_tape_of->rak_after == "Vault 5") echo 'selected="selected"';?> >Vault 5</option>    
                                        <option value="Vault 6" <?php if($data_tape_of->rak_after == "Vault 6") echo 'selected="selected"';?> >Vault 6</option>
                                        <option value="Vault 7" <?php if($data_tape_of->rak_after == "Vault 7") echo 'selected="selected"';?> >Vault 7</option>
                                        <option value="Vault 8" <?php if($data_tape_of->rak_after == "Vault 8") echo 'selected="selected"';?> >Vault 8</option>
                                        <option value="Vault 9" <?php if($data_tape_of->rak_after == "Vault 9") echo 'selected="selected"';?> >Vault 9</option>
                                        <option value="Vault 10" <?php if($data_tape_of->rak_after == "Vault 10") echo 'selected="selected"';?> >Vault 10</option> 
                                        <option value="Robot" <?php if($data_tape_of->rak_after == "Robot") echo 'selected="selected"';?> >Robot</option>                                         
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Koordinat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="koordinat_after" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data_tape_of->koordinat_after;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Size<span class="required">*</span>
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <input type="decimal" name="size_total" min="0" id="size" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo number_format($data_tape_of->size_total/1024, 2)?>">
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <select class="form-control" name="ukuran" id="ukuran" ?>"> 
                                        <option value ="GB">GigaByte</option>       
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
                                <a href="<?php echo base_url($this->cname . '/action/edit/' . $data_tape_of->id_tape); ?>" class="btn btn-sm bg-orange"><i class="fa fa-edit"></i> Ubah</a>
                            <?php } ?>
                            <?php if ($this->fitur == 'Tambah Host' || $this->fitur == 'Konfigurasi' || $this->fitur == "Request") { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>

                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
