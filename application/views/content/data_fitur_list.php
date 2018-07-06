
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
                                <i class="fa fa-plus"></i> Data Aplikasi Baru
                            </a>
                        </div>
                        <!-- <div class="btn-group">
                            <a href="<?php echo base_url($this->cname . '/upload_file')?>" class="btn btn-small sbold" >
                                <i class="fa fa-upload"></i> Upload file
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
          
            <div class="x_content" >
                
                <table id="data-fit" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10px">No</th>
                            <th width="120">Nama Fitur</th>
                            <th width="250">Deskripsi Fitur</th>
                            <th>Pengembang</th>
                            <th>Programmer</th>
                            <th>User Bagian</th>
                            <th>Tanggal Input</th>
                            <th>Fitur Detail</th>
                            
                        </tr>
                    </thead>
                   
                </table>
            </div>
        </div>
    </div>
</div>