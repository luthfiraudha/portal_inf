
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
          
            <div class="x_content" >
               
                <table id="data-konfirm" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10px">No</th>
                            <th>Nama Aplikasi</th>
                            <th>Nama Fitur</th>
                            <th>No Surat</th>
                            <th>Versi</th>
                            <th>Programmer</th>
                            <th width="120px">Tanggal Input</th>
                            <th width="100px">Status</th>
                            <th width="130px">Action</th>
                        </tr>
                    </thead>
                   
                </table>
            </div>
        </div>
    </div>
</div>