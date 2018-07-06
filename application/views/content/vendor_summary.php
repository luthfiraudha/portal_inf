

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                     <h2>Vendor Summary<small>month: <?php echo $month;?> year: <?php echo date('Y');?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                  
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                
                    <table id="datatable-buttons" class="table table-striped projects" >
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 1%">Vendor Detail</th>
                           <th style="width: 1%">Tanggal Kontrak</th>
                          <th style="width: 1%">Vendor Time Limit</th>
                          <th style="width: 5%">Status</th>
                 
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($vendor as $vendor) { ?>
                        <tr>
                          <td>#</td>
                          <td>
                            <a><?php echo $vendor->nama_projek?></a>
                            <br />
                            <small>by <?php echo $vendor->vendor_nama?></small> |
                            <small>SPK <?php echo $vendor->spk_nmr?></small>
                          </td>
                            <td>Mulai : <?php echo $vendor->vendor_begindate?>
                          </br>Akhir : <?php echo $vendor->vendor_enddate?></td>
                          <?php 
                          $date1 =  date('y-m-d', strtotime($vendor->vendor_begindate));
                          $date2 =  date('y-m-d', strtotime($vendor->vendor_enddate));
                          $today =  date('y-m-d');

                          $date1 = new DateTime($date1);
                          $date2 = new DateTime($date2);
                          $now = new DateTime($today);

                          $num = $date2->diff($date1)->format("%a");
                          $num = (int) $num;
                   

                          $num2 = $now->diff($date2)->format("%a");
                          $num2 = (int) $num2;
                         
                      
                          $percent = $num2/ $num * 100;
                          $percentage = 100 - $percent;
                          $percentageRounded = round($percent);

                          ?>
                          <?php if( $percentageRounded >= 70){?>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="77" style="width:<?php  echo $percentageRounded . '%';?>;" aria-valuenow="<?php  echo $percentageRounded;?>"></div>
                            </div>
                            <small><?php  echo $percentageRounded . '%';?></small>
                          </td>
                          <?php }else if($percentageRounded >= 50 && $percentageRounded < 70){?>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="77" style="width:<?php  echo $percentageRounded . '%';?>;" aria-valuenow="<?php  echo $percentageRounded;?>"></div>
                            </div>
                            <small><?php  echo $percentageRounded . '%';?></small>
                          </td>
                          <?php } else if ($percentageRounded < 50){?>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="77" style="width:<?php  echo $percentageRounded . '%';?>;" aria-valuenow="<?php  echo $percentageRounded;?>"></div>
                            </div>
                            <small><?php  echo $percentageRounded . '%';?></small>
                          </td>
                          <?php } ?>
                     
                          <td>
                           <?php if($vendor->status == 'kadaluarsa'){?>
                                <i class='btn btn-circle btn-xs bg-red'>kadaluarsa</i>
                                <?php } else{ ?>

                                <i class='btn btn-circle btn-xs bg-green'><?php echo $vendor->status;?></i>
                                <?php } ?>
                          </td>
                          
                        </tr>
                                                 <?php
}
?>
                      </tbody>
                    </table>
                    <!-- end project list -->
                  </div>
                </div>
              </div>
            </div>
