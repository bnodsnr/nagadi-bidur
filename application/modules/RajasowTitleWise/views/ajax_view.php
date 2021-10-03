 <a href="<?php echo base_url()?>RajasowTitleWise/printSearch/<?php echo $ward?>/<?php echo $month?>" class="btn btn-info pull-right" data-toggle="tooltip" title="रिपोर्ट खोज्नुहोस" target ="_blank"> <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस </a>
              <table class="table table-bordered table-striped print_table">
                <thead>
                  <tr>
                    <th>सि नं</th>
                    <th>राजश्व संकेत</th>
                    <th>आम्दानी शिर्षक</th>
                    <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                    <th>अनुमान</th>
                    <?php } ?>
                    <th>गत महिना सम्मको आम्दानी</th>
                    <th>यस महिना आम्दानी</th>
                    <th>यस महिना सम्मको आम्दानी</th>
                    <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                    <th>बाकी</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td><?php echo $this->mylibrary->convertedcit(1)?></td>
                    <td><?php echo $this->mylibrary->convertedcit(11313)?></td>
                    <td><?php echo 'एकिकृत सम्पती कर'?></td>
                    <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                    <td><?php echo $this->mylibrary->convertedcit($aanumanit_sampatikar['annual_income'])?>  
                    </td>
                     <?php } ?>
                    <td><?php 
                       $tsampati_kar_upto_lastmonth = $sampati_kar_lastmonth['sampati_total'] + $sampati_kar_lastmonth['ba_amount'] + $sampati_kar_lastmonth['fa_amount'] + $sampati_kar_lastmonth['oa_amount'];
                      echo $this->mylibrary->convertedcit($tsampati_kar_upto_lastmonth)
                    ?></td>
                    <td><?php $tsampati_kar = $sampati_kar['sampati_total'] + $sampati_kar['ba_amount'] + $sampati_kar['fa_amount'] + $sampati_kar['oa_amount'];
                      echo $this->mylibrary->convertedcit($tsampati_kar)?></td>
                    <td>
                      <?php 
                        $total_sampati_kar = $tsampati_kar_upto_lastmonth + $tsampati_kar;
                        echo $this->mylibrary->convertedcit($total_sampati_kar);
                      ?>
                    </td>
                     <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                    <td> <?php $due_sampati = $aanumanit_sampatikar['annual_income']-$total_sampati_kar; echo $this->mylibrary->convertedcit($due_sampati)?></td>
                  <?php  } ?>
                  </tr>

                  <tr>
                    <td><?php echo $this->mylibrary->convertedcit(2)?></td>
                    <td><?php echo $this->mylibrary->convertedcit(11314)?></td>
                    <td><?php echo 'भूमि कर / मालपोत'?></td>
                     <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                    <td><?php echo $this->mylibrary->convertedcit($aanumanit_bhumikar['annual_income'])?></td>
                  <?php  } ?>
                    <td><?php 
                      $bhumi_kar_upto_lastmonth = $bhumi_kar_lastmonth['bhumi_total'] + $bhumi_kar_lastmonth['malpot'] + $bhumi_kar_lastmonth['bhumi_bakeyuta'];
                      echo $this->mylibrary->convertedcit($bhumi_kar_upto_lastmonth)
                    ?></td>
                    <td><?php 
                       $bhumi_kar_currentmonth = $bhumi_kar['bhumi_total'] + $bhumi_kar['malpot']+$bhumi_kar['bhumi_bakeyuta'];
                      echo $this->mylibrary->convertedcit($bhumi_kar_currentmonth);
                    ?></td>
                    <td><?php
                          $total_bhumi_kar = $bhumi_kar_upto_lastmonth + $bhumi_kar_currentmonth;
                          echo $this->mylibrary->convertedcit($total_bhumi_kar);
                    ?></td>
                     <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                    <td><?php $due_bhumikar = $aanumanit_bhumikar['annual_income']-$total_bhumi_kar; echo $this->mylibrary->convertedcit($due_bhumikar);?></td>
                  <?php } ?>
                    
                  </tr>

                <?php if(!empty($report)) :
                  $i = 3;
                  $total_anu = 0;
                  $total_collection_lastmonth = 0;
                  $total_collection_currentmonth = 0;
                  $total_due = 0;
                  $total_collection = 0;
                  foreach($report as $key => $value) :
                    $total_anu+= $value['ass_amount'];
                    $total_collection_lastmonth += $value['upto_last_month'];
                    $total_collection_currentmonth += $value['current_month_data'];
                  ?>
                    <tr>
                      <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                      <td><?php echo $this->mylibrary->convertedcit($value['topic_no'])?></td>
                      <td><?php echo $value['topic_name']?></td>
                       <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                      <td><?php echo $this->mylibrary->convertedcit($value['ass_amount'])?></td>
                    <?php  } ?>
                      <td><?php echo !empty($value['upto_last_month'])? $this->mylibrary->convertedcit(number_format($value['upto_last_month'])):$this->mylibrary->convertedcit(0)?></td>
                      <td><?php echo !empty($value['current_month_data'])? $this->mylibrary->convertedcit(number_format($value['current_month_data'])):$this->mylibrary->convertedcit(0)?></td>
                      <td><?php
                          $upto = $value['current_month_data'] + $value['upto_last_month']; 
                          echo $this->mylibrary->convertedcit(number_format($upto));
                          $total_collection += $upto;
                      ?>
                        
                      </td>
                       <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                      <td><?php
                          $due = $value['ass_amount'] - $upto; 
                          echo $this->mylibrary->convertedcit(number_format($due));
                          $total_due += $due;
                        ?>
                      </td>
                    <?php } ?>
                    </tr>
                <?php endforeach; endif;?>
                <tr>
                  <td colspan="3" align="right">जम्मा </td>
                  <!-- total aanumanit rakam -->
                   <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                  <td><?php echo $this->mylibrary->convertedcit($total_anu + $aanumanit_sampatikar['annual_income'] + $aanumanit_bhumikar['annual_income'])?></td>
                <?php } ?>
                  <!-- total collection upto last month -->
                  <td><?php echo $this->mylibrary->convertedcit(round($total_collection_lastmonth + $tsampati_kar_upto_lastmonth + $bhumi_kar_upto_lastmonth))?></td>
                  <!-- total collection monthly -->
                  <td><?php echo $this->mylibrary->convertedcit(round($total_collection_currentmonth + $tsampati_kar + $bhumi_kar_currentmonth))?></td>
                  <!-- total collection upto now -->
                  <td><?php echo $this->mylibrary->convertedcit(round($total_collection + $total_bhumi_kar + $total_sampati_kar))?></td>
                  <!-- total due amount -->
                   <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                  <td><?php echo $this->mylibrary->convertedcit(round($total_due+$due_bhumikar+$due_sampati)) ?></td>
                <?php } ?>
                </tr>
              </tbody>
            </table>