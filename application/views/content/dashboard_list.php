
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
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" ></button>
                    <?php echo $alert['message'];?>
                </div>
            <?php }
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
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Kategori / nama SOP</th>
                            <th>Isi</th>
                            <th>Tindakan</th>
                            <th>Detail</th>
                           

                        </tr>
                    </thead>



                    <tbody>

                        <?php
                        $start = 0;
                        foreach ($cari as $cari) {

                           ?>
                            <tr>
                                <td><?php echo ++$start?></td>
                                <td><?php echo $cari->id?></td>
                                <td><a class="bg red">Ticketing: <?php echo $cari->tgl_input?> <a></br>

                                <a class="bg green">Tindakan : <?php 
                                if($cari->tgl_sol!= NULL){
                                echo $cari->tgl_sol;
                                }else{ echo "-";}?><a>
                                </td>
                                <td><?php 
                                if($cari->shift != NULL){
                                    echo "Problem/Request";
                                }else{
                                    echo "SOP";
                                }

                                ?></td>
                                <td><?php echo $cari->kategori_nama?></td>
                               
                   
                                 </td>
                                 <td><?php 

                                if($cari->shift != NULL){
                                $string = strip_tags($cari->isi);
                                    if (strlen($string) > 50) {
                                     // truncate string
                                $stringCut = substr($string, 0, 50);

                                 // make sure it ends in a word so assassinate doesn't become ass...
                                $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
                                }
                                echo $string;
                                   }else{
                                ?>
                                 <a title='Dokumen' href="<?php echo $cari->isi?>" class='btn btn-circle btn-sm sbold bg-blue' target="_blank">
                                    <i class='fa fa-file'> Lihat Dokumen</i>
                                </a></td>
                                <?php
                            }
                                ?></td>
                               
                                <td><?php 
                                if($cari->isi2!=NULL){
                                $string2 = strip_tags($cari->isi2);
                                 if (strlen($string) > 50) {
                                     // truncate string
                                $stringCut2 = substr($string2, 0, 50);

                                 // make sure it ends in a word so assassinate doesn't become ass...
                                $string2 = substr($stringCut2, 0, strrpos($stringCut2, ' ')).'... '; 
                                }
                                echo $string2;
                             }else{
                                echo "-";
                             }

                                ?></td>
                                <td>
                                <?php if($cari->shift == NULL){?>
                                     <a title='Detail'  href="<?php echo base_url('data_sop/action/view/' . $cari->id);?>" target="_blank" class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'> <strong>view</strong></i>
                                    </a>
                                <?php }else{?>
                                 <a title='Detail'  href="<?php echo base_url('bank_issue/action/view/' . $cari->id."/". $cari->id2);?>" target="_blank" class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'> <strong>view</strong></i>
                                    </a>
                                <?php } ?>
                                </td>
     <?php                               
}
?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

/*.dataTables_filter {
display: none; 
}*/
</style>
<script>

</script>