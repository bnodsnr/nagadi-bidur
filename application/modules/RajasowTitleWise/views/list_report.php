<style type="text/css">
  .print_table tr:nth-child(odd){
        background-color:#fffdfd
    }
    .print_table tr:nth-child(even){
        background-color:#fffdfd;
        /*color: #FFF;*/
    }
</style>
<!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="">शिर्षकगत रिपोर्ट</a></li>
      </ol>
    </nav>
    <!-- page start-->

    <div class="row">
      <div class="col-sm-12">
        <section class="card">
          <div class="card-header">
            <h1 class="text-center" style="text-decoration: underline;">आम्दानी प्रतिबेदन</h1>
            <form action ="<?php echo base_url()?>RajasowTitleWise/Search" method="post" class="search_report">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="row">
               <?php if($this->session->userdata('PRJ_USER_WARD') == '0') { ?>
                 <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control dd_select" name="ward">
                      <option value="">वडा चयन  गर्नुहोस</option>
                      <?php if(!empty($wards)) :
                        foreach($wards as $wn) :?>
                          <option value="<?php if($wn['ward'] == 0){ echo 'PALIKA';} else { echo $wn['ward'];}?>"><?php if($wn['ward'] == 0){ echo TYPE;} else { echo 'वडा नं. ' .$this->mylibrary->convertedcit($wn['ward']);}?></option>
                        <?php endforeach; endif;?>
                      </select>
                  </div>
                </div>
              <?php } ?>

                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control dd_select" name="month">
                      <option value="">महिना छान्नुहोस्</option>
                      <option value="04">श्रावण</option>
                      <option value="05">भाद्र</option>
                      <option value="06">आश्विन</option>
                      <option value="07">कार्तिक</option>
                      <option value="08">मार्ग</option>
                      <option value="09">पौष</option>
                      <option value="10">माघ</option>
                      <option value="11">फाल्गुन</option>
                      <option value="12">चैत्र</option>
                      <option value="01">वैशाख</option>
                      <option value="02">ज्येष्ठ</option>
                      <option value="03">आषाढ</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <button class="btn btn-primary btn-block btn-xs save_button" data-toggle="tooltip" title="   रिपोर्ट खोज्नुहोस" name="Submit" type="submit" value="Save"> <i class="fa fa-search"></i> खोज्नुहोस</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="card-body">
            <div class="search_div">
              <a href="<?php echo base_url()?>RajasowTitleWise/printReport" class="btn btn-info pull-right" data-toggle="tooltip" title="रिपोर्ट खोज्नुहोस" target ="_blank"> <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस </a>
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
                      $bhumi_kar_upto_lastmonth = $bhumi_kar_lastmonth['bhumi_total'] + $bhumi_kar_lastmonth['bhumi_bakeyuta'] - $bhumi_kar_lastmonth['malpot'];
                      echo $this->mylibrary->convertedcit($bhumi_kar_upto_lastmonth)
                    ?></td>
                    <td><?php 
                      $bhumi_kar_currentmonth = $bhumi_kar['bhumi_total'] - $bhumi_kar['malpot'] + $bhumi_kar['bhumi_bakeyuta'];
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
                      <td><?php echo !empty($value['upto_last_month'])? $this->mylibrary->convertedcit(round($value['upto_last_month'])):$this->mylibrary->convertedcit(0)?></td>
                      <td><?php echo !empty($value['current_month_data'])? $this->mylibrary->convertedcit(round($value['current_month_data'])):$this->mylibrary->convertedcit(0)?></td>
                      <td><?php
                          $upto = $value['current_month_data'] + $value['upto_last_month']; 
                          echo $this->mylibrary->convertedcit(round($upto));
                          $total_collection += $upto;
                      ?>
                        
                      </td>
                       <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
                      <td><?php
                          $due = $value['ass_amount'] - $upto; 
                          echo $this->mylibrary->convertedcit(round($due));
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
                  <td><?php echo $this->mylibrary->convertedcit($total_anu +$aanumanit_sampatikar['annual_income'] + $aanumanit_bhumikar['annual_income'])?></td>
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
            </div>
          </div>
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
 </section>

 <script type="text/javascript" src="<?php echo base_url('assets/nepali_datepicker/nepali.datepicker.v2.2.min.js')?>"></script>
 <script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url()?>assets/js/searchjs.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.dd_select').select2();
    var date = "<?php echo convertDate(date('Y-m-d'))?>";
    $('#nepaliDateD').nepaliDatePicker({});
    $('.nepali-calendar').nepaliDatePicker({});
  });
</script>