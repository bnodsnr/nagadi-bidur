<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo GNAME?></title>
  <link rel="shortcut icon" href="https://bmsnepal.net/bidur/assets/img/nepal-govt.png">
  <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/css/bootstrap-reset.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <style type="text/css">
    :root {
      --bleeding: 0.5cm;
      --margin: 1cm;
    }
    @page {
      size: A4;
      margin: 0;
    }
    * {
      box-sizing: border-box;
    }
    body {
     /*font-family: Kalimati, Georgia, serif;*/
      margin: 0 auto;
      padding: 0;
      background: rgb(204, 204, 204);
      display: flex;
      flex-direction: column;
    }
    .page {
      display: inline-block;
      position: relative;
      width: 310mm;
      font-size: 12pt;
      margin: 2em auto;
      padding: calc(var(--bleeding) + var(--margin));
      box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
      background: white;
    }
    @media screen {
      .page::after {
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: calc(100% - var(--bleeding) * 2);
        height: calc(100% - var(--bleeding) * 2);
        margin: var(--bleeding);
        /*outline: thin dashed black;*/
        pointer-events: none;
        z-index: 9999;
      }
    }

    @media all {
      .print_table {
        width: 100%;
        border: solid 1px;
        border-collapse: collapse;
      }
      .print_table th{
        border-color: black;
        font-size: 12px;
        border: solid 1px;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        /*background-color:#FFF;*/
       /* color: #FFF;*/
      }
      .print_table td{
        border-color: white;
        font-size: 12px;
        border: solid 1px;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        text-align: left;
      }
      .print_table tr:nth-child(odd){
        background-color:#fff;
      }
      .print_table tr:nth-child(even){
        background-color:#fff;
       /*color: #FFF;*/
      }
    }
  </style>
</head>
<body style="--bleeding: 0.5cm;--margin: 1cm;">
  <div class="page">
    <!-- Your content here -->
    <div style="margin-left: 826px; " class="hideme">
      <button class="btn btn-info btn-sm " style="color:#FFF;" id="basic"><i class="fa fa-print"></i> PRINT</button>
      <a href="<?php echo base_url()?>" class ="btn btn-success btn-sm"><i class="fa fa-home"></i> DASHBOARD</a>
    </div>
    <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 120px; width: 140px;">
    <div style="font-size:10px; margin-left:5px;">आ ब: <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?></div>
    <div style="font-size: 28px;margin-left: 484px;margin-top: -130px;"><b><?php echo GNAME?></b></div>
    
    <div style="margin-left: 500px;margin-top: 0;font-size: 14px;"><b><?php  if($this->session->userdata('PRJ_USER_ID') == 1){ echo SLOGAN; } else { echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD')).' नं. वडा कार्यलय';}?></b></div>
    <div style="margin-left: 524px;margin-top:0;font-size: 14px;"><b><?php echo ADDRESS.','.DISTRICT?></b></div>
    <div style="margin-left: 498px;margin-top: 12px;font-size: 22px;"><b>आम्दानी प्रतिवेदन</b></div>
  <div style="margin-left: 905px; margin-top:0px;">

   महिना- 
   <?php 
     echo  !empty($search_month) ? getNepaliMonthName($search_month):getNepaliMonthName(get_current_month());
    
  ?></div>
  <hr style="margin-top: 5px;">
    <table class="table table-bordered print_table">
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
</div><!--end of page-->

<script src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/jsprint/printThis.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#basic').on("click", function () {
      $('.hideme').hide();
      window.print();
    });
  });
</script>
</body>
</html>

