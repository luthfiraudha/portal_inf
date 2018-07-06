
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12" >
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?><small><?php echo $this->fitur;?></small></h2>
                <div class="clearfix"></div>
            </div>
            <?php cetak_flash_msg();?>
            <?php if (!empty($alert['message'])) {?>
            <div class="alert alert-<?php echo $alert['class'];?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <?php echo $alert['message'];?>
            </div>
            <?php }
            ?>
      
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <a href="<?php echo base_url($this->cname . '/add')?>" class="btn btn-small sbold bg-green" >
                                <i class="fa fa-plus"></i> Tambah Data Inventori 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="x_content" >
                <!--                <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div>-->
                <table id="data-inven" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10px">No</th>
                            <th width="50px">SPK Nomor</th>
                            <th width="150px">Nama Inventori</th>
                            <th>Jumlah Inventori</th>
                            <th>Tersedia</th>
                            <th>Dipakai</th>
                            <th>Rusak</th>
                            <th width="100px">Sumber Inventori</th>
                            <th>Tanggal Datang</th>
                            <th>Detail</th>
                            <th>Pakai</th>
                            <?php if($this->active_privilege == "superadmin" || $this->active_privilege == "signer"){?>
                            <th width="120px">Action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                   
                </table>
            </div>
        </div>
    </div>
</div>