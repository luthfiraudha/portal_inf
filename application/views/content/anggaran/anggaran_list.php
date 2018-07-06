
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
            <?php if ( $this->active_privilege == 'maker' || $this->active_privilege == 'checker' || $this->active_privilege == 'signer' || $this->active_privilege == 'superadmin') {?>

                <div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="btn-group">
                                <a href="<?php echo base_url($this->cname . '/add')?>" class="btn btn-small sbold bg-green" >
                                    <i class="fa fa-plus"></i> Tambah Anggaran
                                </a>
                            </div>
                            <!-- <div class="btn-group">
                                <a href="<?php //echo base_url($this->cname . '/upload_file')?>" class="btn btn-small sbold" >
                                    <i class="fa fa-upload"></i> Upload file
                                </a>
                            </div> -->
                        </div>

                    </div>
                </div>
                
                <?php
}
?>

            <div class="x_content">


               <!--  <div>
                    <h4>Informasi</h4>
                    <ul>
                        <li>Hak Akses tidak dapat dihapus.</li>
                        <li>Beberapa Hak Akses tidak dapat diubah.</li>
                    </ul>
                </div> -->
                <div class="row">
                    <div class="col-xs-12">
                       
<!-- 
                    <form  id="form-filter" class="form-horizontal form-label-left" >
                           
            
                      <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Tanggal
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="tanggal" class="form-control has-feedback-left" id="tgl_pmslan" 
                                         value="">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>                        
                                        </div>
                                    </div>
                                 </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nomor surat
                            </label>
                               <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                         <input type="text" name="nmr_surat" class="form-control has-feedback-left" id="nmr_surat" value="">
                                        
                                        </div>
                                    </div>
                                 </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
                               
                            <button type="button" id="btn-filter" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Filter </button>
                                <button type="button" id="btn-reset" class="btn btn-sm btn-default">Reset</button>
                                
                            </div>  
                                    
                        </div>
                        
                       
                    </form> -->
                    </div>
                </div>
                </br>

                <div class="row">
                <table id="data-anggaran" class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th rowspan="1">NO</th>
                            <th width="" rowspan="1">NAMA ANGGARAN</th>
                            <th width="" rowspan="1">TAHUN ANGGARAN</th>
                            <th width="" rowspan="1">NILAI</th>
                             <th width="" rowspan="1">SISA</th>
                            <th width="" rowspan="1">AKSI</th>
                        </tr>
                       
                    </thead>


                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>


</style>
<script>

</script>