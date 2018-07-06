
 
          <form action="<?php echo base_url($this->cname.'/reportmonth');?>" method="post">
                         Report by month:  
                          <select onchange="this.form.submit()" name="month">
                              <option value="empty">select month</option>
                                <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                           </select></a>
                          
                    </form>
                    </br>

          <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Troubleshooting Perform<small>month: <?php echo $month;?> year: <?php echo date('Y');?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                    
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-12" style="overflow:hidden; height: 20em;" id="tes">
                        
                      
                      </div>
                     

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

             <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Perform<small>month: <?php echo $month;?> year: <?php echo date('Y');?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                    
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-12" style="overflow:hidden; height: 20em;" id="tes4">
                        
                      
                      </div>
                     

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>


           

             <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                     <h2>Tickets Share by Category <small>month: <?php echo $month;?> year: <?php echo date('Y');?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                     
                      <div class="col-md-12" style="overflow:hidden; height: 20em;" id="tes2">
                        
                      
                      </div>

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                     <h2>Top Tickets by Category <small>month: <?php echo $month;?> year: <?php echo date('Y');?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                   
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                     
                      <div class="col-md-12" style="overflow:hidden; height: 20em;" id="tes3">
                        
                      
                      </div>

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>



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
                          <th style="width: 10%">Vendor Detail</th>
                          <th style="width: 10%">Tanggal Kontrak</th>
                          <th style="width: 10%">Vendor Time Limit</th>
                          <th>Status</th>
                 
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
                          $percentageRounded = round($percentage);

                          ?>
                          <?php if( $percentageRounded >= 70){?>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="77" style="width:<?php  echo $percentageRounded . '%';?>;" aria-valuenow="<?php  echo $percentageRounded;?>"></div>
                            </div>
                            <small><?php  echo $percentageRounded . '%';?></small>
                          </td>
                          <?php }else if($percentageRounded >= 50 && $percentageRounded < 70){?>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-yellow" role="progressbar" data-transitiongoal="77" style="width:<?php  echo $percentageRounded . '%';?>;" aria-valuenow="<?php  echo $percentageRounded;?>"></div>
                            </div>
                            <small><?php  echo $percentageRounded . '%';?></small>
                          </td>
                          <?php } else if ($percentageRounded < 50){?>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="77" style="width:<?php  echo $percentageRounded . '%';?>;" aria-valuenow="<?php  echo $percentageRounded;?>"></div>
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


           



