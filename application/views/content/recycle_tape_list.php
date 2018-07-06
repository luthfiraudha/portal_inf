
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $this->menu;?> | <medium><?php echo "  ".$this->fitur;?></medium></h2>

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
                </br>
                </br>
                <div class="row">
                <table id="data-tape" class="table table-striped table-bordered">
                    <thead>
                        <tr style="background-color: grey; color:white;">
                            <th width="40px">No</th>
                            <th width="100px">Volume ID</th>
                            <th>Tanggal</th>
                            <th>Kadaluarsa</th>
                            <th>Lokasi</th>
                            <th width="75px">Rak</th>
                            <!-- <th>Status</th> -->
                           <!--  <th >Tgl Solusi</th> -->
                            <th width="65px">Koordinat</th>
                            <th>Set</th>
                           <!--  <th>Koreksi</th> -->
                            <th>State</th>
                            <th>Status</th>
                            
                            <!--<th>Answer</th>-->
                            <th width="180px">Detail</th>
                           

                        </tr>
                        <?php $no = 1;
                            foreach ($data_tape as $row) { ?>
                            <tr>
                                <th><?php echo $no++; ?></th>
                                <th><b><?php echo $row->vol_id; ?></b></th>
                                <th><?php echo $row->start_date; ?></th>
                                <th>
                                <?php
                                $tempo = $row->tempo;
                                if($tempo <0)
                                {
                                    $tempo = $tempo*(-1);
                                    (int)$bulan = $tempo/30;
                                    $hari = $tempo%30; 
                                    if((int)$bulan == 0) {?>
                                        <i class='btn btn-circle btn-xs bg-red'><?php echo $hari. ' hari';?></i>
                                    <?php }
                                        else {?>
                                         <i class='btn btn-circle btn-xs bg-red'><?php echo (int)$bulan.' bulan, '.$hari. 'hari';?></i> <?php }
                                }
                                else if($tempo ==0)
                                {
                                    ?>
                                    <i class='btn btn-circle btn-xs bg-orange'>Now Date</i> <?php
                                }
                                else if($tempo>0 && $tempo<=5)
                                {
                                    (int)$bulan = $tempo/30;
                                    $hari = $tempo%30; 
                                    if((int) $bulan == 0) {?>
                                        <i class='btn btn-circle btn-xs bg-orange'><?php echo $hari. 'hari';?></i>
                                    <?php }
                                        else {?>
                                         <i class='btn btn-circle btn-xs bg-orange'><?php echo (int)$bulan.' bulan, '.$hari. 'hari';?></i> <?php }
                                }
                                else
                                { 
                                    (int) $bulan = $tempo/30;
                                    $hari = $tempo%30;
                                    if((int)$bulan == 0) {?>
                                        <i class='btn btn-circle btn-xs bg-blue'><?php echo $hari. ' hari';?></i>
                                    <?php }
                                        else {?>
                                         <i class='btn btn-circle btn-xs bg-blue'><?php echo (int)$bulan.' bulan, '.$hari. 'hari';?></i> <?php }
                                }?></th>
                                <th><?php echo $row->lokasi; ?></th>
                                <th><?php echo $row->rak_after; ?></th>
                                <th><?php echo $row->koordinat_after; ?></th>
                                <th><?php echo $row->set_tape; ?></th>
                                <th><?php echo $row->state; ?></th>
                                <th><?php echo $row->jenis; ?></th>
                                <td style='text-align:center' width='140px'>
                                    <a title='Lihat' href='<?php echo base_url().'data_tape_pf/action/view/'.$row->id_tape; ?>' class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'></i>
                                    </a>
                                    <a title='Edit' href='<?php echo base_url().'data_tape_pf/action/edit/'.$row->id_tape; ?>' class='btn btn-circle btn-sm bg-blue'>
                                        <i class='fa fa-edit'></i>
                                    </a> 
                                    <a title='Recycle' href='<?php echo base_url().'data_tape_pf/action/recycle/'.$row->id_tape; ?>' class='btn btn-circle btn-sm bg-orange' data-toggle='modal' data-target='.dismiss-modal'>
                                        <i class='fa fa-eraser'></i>
                                    </a>
                                </td>
                            </tr>
                            <?php }
                        ?>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
