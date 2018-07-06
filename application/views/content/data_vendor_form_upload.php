<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?> |<small><?php echo $this->fitur;?></small></h2>
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



            <div class="alignleft" style="padding-left: 23%;">
                         <!--    <h4>Informasi</h4>
                                    <ul>
                                        <li>Hak Akses tidak dapat dihapus.</li>
                                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                                    </ul> -->
            </div>


            <div class="x_content">
                <br />

                <form  method="POST"  action="<?php echo base_url($this->cname.'/upload');?>" id="demo-form2" enctype="multipart/form-data" class="form-horizontal form-label-left">
                    
                    <div class="form-group">
                      
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="file">
                        </div>
                    </div>


                    <div class="ln_solid">

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <a class="btn btn-sm bg-blue" href="<?php echo base_url($this->cname);?>"><i class="fa fa-arrow-left"></i> Kembali</a>

                            <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-upload"></i> Upload</button>


                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
