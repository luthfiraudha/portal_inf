<script type="text/javascript">

function yesnoCheck(box) {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';

}


</script>


<div class="row">
<div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu; ?><small><?php echo $this->fitur; ?></small></h2>
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

                <form  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <?php if ($this->fitur == 'Pakai') { ?>
                    
                        <input type="hidden" name="id_inven" value="<?php echo $inven_detail->id_inven; ?>">
                        <input type="hidden" name="spk_inven" value="<?php echo $inven_detail->spk_inven; ?>">
                        <input type="hidden" name="tgl_datang" value="<?php echo $inven_detail->tgl_datang; ?>">
                        <input type="hidden" name="qty_inven" value="<?php echo $inven_detail->qty_inven; ?>">
                        <input type="hidden" name="tersedia" value="<?php echo $inven_detail->tersedia; ?>">
                        <input type="hidden" name="dipakai_temp" value="<?php echo $inven_detail->dipakai; ?>">
                        <input type="hidden" name="rusak_temp" value="<?php echo $inven_detail->rusak; ?>">

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Nama inventori
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input  type="text" name="nama_inven" class="form-control col-md-7 col-xs-12" value="<?php echo $inven_detail->nama_inven; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Jumlah inventori yang tersedia
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input  type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $inven_detail->tersedia; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Jumlah yang akan dipakai <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input  type="text" name="qty_inven_temp" required="required" class="form-control col-md-7 col-xs-12 numeric">
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Keterangan Pengambilan <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control" type="text" name="status" required="required" id="status" class="form-control col-md-7 col-xs-12">
                                    <option></option>
                                    <option value="rusak">kerusakan</option>
                                    <option value="dipakai">Pemakaian</option>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Keterangan Pemakaian <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select type="text" name="ket_inven" required="required"  class="form-control col-md-7 col-xs-12">
                                  <option></option>
                                  <option value="Rusak">- Inventori Rusak -</option>
                                  <?php
                                    foreach($list_server as $row){
                                        echo "<option value=\"$row->Label\">$row->Label</option>\n";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Tanggal Dipakai <span class="required">*</span>
                            </label>                          
                            <div class="control-group">
                                <div class="controls">
                                    <div class="col-md-4 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                        <input type="text" name="tgl_dipakai" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Dipakai">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    } 

                    elseif ($this->fitur == 'Lihat') { ?>
                        <table style="width : 100%">
                            <tr>
                                <td width="45%">
                                 <div class="x_panel">
                                 <h2><small><?php echo 'Info Inventori' ?></small></h2>
                                <HR WIDTH=100%>
                                    
                        <?php
                        $nama = $inven_detail->nama_inven . " " . $inven_detail->merk ." " . $inven_detail->kapasitas . " GB" ;
                        ?>
                        
                                
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >SPK Nomor
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $inven_detail->spk_inven; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Nama Inventori
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $nama; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Jumlah Inventori
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $inven_detail->qty_inven; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Inventori Dipakai
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $inven_detail->dipakai; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Inventori Rusak
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $inven_detail->rusak; ?>" readonly> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" >Inventori Tersedia
                            </label>
                            <div class="col-md-6 col-sm-4 col-xs-12">
                                <input type="text" class="form-control col-md-4 col-xs-6" value="<?php echo $inven_detail->tersedia; ?>" readonly> 
                            </div>
                        </div>

                    
                </div>
                </div>

                </td>

                <td>
                
                <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2><small><?php echo 'Riwayat Pemakaian' ?></small></h2>
                    <div class="clearfix"></div>
                    </div>
                        
                        <div>
                            <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Jumlah</th>
                                    <!-- <th width="100px">Status</th> -->
                                    <th>Keterangan Pemakaian</th>
                                    <th width="100px">Tanggal pemakaian</th>
                                    <!-- <th width="100px">Action</th> -->
                                    
                                </tr>
                            </thead>

                            <tbody>
                            <?php 
                            $i=1;
                            foreach( $trans_detail as $row){?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->qty_transaksi; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($row->ket_inven == "Rusak" ) {
                                          $rowx =    "<i class='btn btn-xs bg-orange'>Kerusakan</i>";
                                        } else {
                                          $rowx =   "<i class='btn btn-xs bg-blue'>Server $row->ket_inven</i>";
                                        }
                                        echo $rowx ;?>
                                    </td>

                                    <td>
                                        <?php echo $row->tgl_transaksi; ?>
                                    </td>
<!-- 
                                    <td>
                                        <a title='Edit' href="<?php echo base_url().'data_inven/action/edit/'.$row->id_inven; ?>" class='btn btn-circle btn-sm bg-orange'>
                                            <i class='fa fa-edit'></i>
                                        </a> 
                                        <a title='Delete' href="<?php echo base_url().'data_inven/action/delete/'.$row->id_inven;?>" class='btn btn-circle btn-sm bg-red' data-toggle="modal" data-target=".delete-modal">
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </td> -->

                                </tr>
                                <?php 
                                $i++;
                                } ?>
                            </tbody>
                            </table>
                        </div>
                            </td>
                            </tr>
                        </table>
                        
                        <?php
                    } 

                    else 
                    {
                        ?>
                        <?php if ($this->fitur == 'Ubah')  { ?>
                            <input type="hidden" name="id_inven" value="<?php echo $inven_detail->id_inven; ?>">
                            <input type="hidden" name="rusak" value="<?php echo $inven_detail->rusak; ?>">
                            <input type="hidden" name="dipakai" value="<?php echo $inven_detail->dipakai; ?>">
                        <?php } ?>

                        <!-- tambah data -->

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >SPK Nomor <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <?php if ($this->fitur == 'Ubah') {?>
                                <input  type="text" name="spk_inven" required="required" class="form-control col-md-7 col-xs-12 numeric" value="<?php echo $inven_detail->spk_inven; ?>" readonly>
                                
                                <?php } else {?>
                                <input  type="text" name="spk_inven" required="required" class="form-control col-md-7 col-xs-12 numeric">
                                <?php }?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Nama Inventori <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <?php if ($this->fitur == 'Ubah') {?>
                                <input  type="text" name="nama_inven" required="required" class="form-control col-md-7 col-xs-12 numeric" value="<?php echo $inven_detail->nama_inven; ?>">
                                
                                <?php } else {?>
                                <select class="form-control" type="text" name="nama_inven" onchange="DropDownChanged(this);" required="required" id="nama_inven" class="form-control col-md-7 col-xs-12">
                                    <option></option>
                                    <option value="Hardisk">Hardisk</option>
                                    <option value="Hardisk">Hardisk SSD</option>
                                    <option value="Memori">Memori</option>
                                    <option value="nn">Lainnya..</option>
                                </select>
                                <input type="text" name="nama_inven_txt" class="form-control col-md-7 col-xs-12" style="display: none;" />
                                <?php }?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Merek <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input  type="text" name="merk" required="required" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $inven_detail->merk; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Kapasitas <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input  type="text" name="kapasitas" required="required" placeholder="dalam GigaByte (GB)" class="form-control col-md-7 col-xs-12 numeric" value="<?php if ($this->fitur == 'Ubah') echo $inven_detail->kapasitas; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Sumber Inventori <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control" type="text" name="sumber_inven" required="required" id="sumber_inven" class="form-control col-md-7 col-xs-12" value="<?php if ($this->fitur == 'Ubah') echo $inven_detail->sumber_inven; ?>">
                                    <option></option>
                                    <option value="Pengadaan">Pengadaan</option>
                                    <option value="Pelepasan">Pelepasan</option>
                                </select>
                            </div>
                        </div>

                        <?php if ($this->fitur != 'Ubah'){ ?>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Jumlah Inventori <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input  type="text" name="qty_inven" required="required" class="form-control col-md-7 col-xs-12 numeric" value="<?php if ($this->fitur == 'Ubah') echo $inven_detail->qty_inven; ?>">
                            </div>
                        </div>
                        <?php }?>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" >Tanggal Datang <span class="required">*</span>
                            </label>  
                            <?php 
                            if ($this->fitur=='Ubah')
                                { 
                                    $newdate1 = date("m/d/Y", strtotime($inven_detail->tgl_datang));
                                }
                            ?>                         
                            <div class="control-group">
                                <div class="controls">
                                    <div class="col-md-4 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                        <input type="text" name="tgl_datang" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Datang" value="<?php if ($this->fitur == 'Ubah') echo $newdate1?>">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    <?php }
                    ?>

                                          
 

                    <div class="ln_solid">

                    </div>
                    <div class="form-group">

                        

                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" align="center">
                            <a class="btn btn-sm bg-blue" href="#" onclick="history.go(-1)";> <i class="fa fa-arrow-left"></i> Kembali</a>
                            <!-- <?php if ($this->fitur == 'Lihat') { ?>
                                
                            <?php } ?> -->
                            <?php if ($this->fitur == 'Tambah' || $this->fitur == 'Ubah') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Ubah') echo 'popconfirm-update'; ?>" data-toggle='confirmation'><i class="fa fa-save"></i> Simpan</button>
                            <?php } ?>
                            <?php if ($this->fitur == 'Pakai') { ?>
                                <button type="submit" class="btn btn-sm btn-primary <?php if ($this->fitur == 'Pakai') echo 'popconfirm-pakai'; ?>" data-toggle='confirmation'><i class="fa fa-check"></i> Pakai</button>
                            <?php } ?>

                        </div>
                    </div>

                    
                </form>
            </div>

        </div>
    </div>
</div>

