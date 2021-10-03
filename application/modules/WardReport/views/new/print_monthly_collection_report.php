<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
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
  font-family: Kalimati, Georgia, serif;
  margin: 0 auto;
  padding: 0;
  background: rgb(204, 204, 204);
  display: flex;
  flex-direction: column;
}

.page {
  display: inline-block;
  position: relative;
  /*height: 327mm;*/
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
                background-color:#407ac5;
                color: #FFF;
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
                background-color:#E8E8E8;
            }
            .print_table tr:nth-child(even){
                background-color:#E8E8E8;
                /*color: #FFF;*/
            }
            
            }
  </style>

</head>

<body style="--bleeding: 0.5cm;--margin: 1cm;">
  <div class="page">
    <!-- Your content here -->
      <div style="margin-left: 986px; " class="hideme">
          <button class="btn btn-default btn-sm " style="color:#FFF;" id="basic"><i class="fa fa-print"></i></button>
          <a href="<?php echo base_url()?>" class ="btn btn-success btn-sm"><i class="fa fa-home"></i></a>
      </div>
      <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 120px; width: 140px;">
      <div style="font-size:10px; margin-left:5px;">आ ब: <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?></div>

     <div style="font-size: 28px;margin-left: 484px;margin-top: -130px;"><b><?php echo GNAME?></b></div>
<div style="margin-left: 500px;margin-top: 0;font-size: 14px;"><b><?php  if($this->session->userdata('PRJ_USER_ID') == 1){ echo SLOGAN; } else { echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD')).' नं. वडा कार्यलय';}?></b></div>
<div style="margin-left: 524px;margin-top:0;font-size: 14px;"><b><?php echo ADDRESS.','.DISTRICT?></b></div>
      <div style="margin-left: 425px;margin-top: 12px;font-size: 22px;"><b>
        <?php if($ward_no != '0'){
          echo $this->mylibrary->convertedcit($ward_no). ' नं. वडा कार्यलय';
      } ?>

      मासिक कर सङ्कलन रिपोर्ट</b></div>
      <div style="margin-left: 905px; margin-top:0px;font-size: 16px">
           <?php echo getNepaliMonthName($date) ?>
      </div>
      <hr style="margin-top: 5px;">

      <table class="print_table table table-stripe table-bordered">
    <thead>
      <tr>
        <th>सि.नं</th>
        <th>आम्दानी शिर्षक</th>
        <th class="hidden-phone">शिर्षक नं  </th>
        <th class="hidden-phone">मुल्य रु</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($main_topic)) : 
        $i=1;
        $nagadi_total = 0;
        foreach($main_topic as $mt):
          ?>
          <tr>
            <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
            <td><?php echo $mt['topic_name']?></td>
            <td><?php echo $this->mylibrary->convertedcit($mt['topic_no'])?></td>
            <?php
             $collection_rate = $this->WardReportModel->GetPrintMonthltNagadi($mt['id'],$ward_no,$date);
            ?>

            <td><?php echo !empty($collection_rate['total'])?$this->mylibrary->convertedcit($collection_rate['total']):$this->mylibrary->convertedcit(0)?></td>
            <?php $nagadi_total += $collection_rate['total'];?>
          </tr>
        <?php endforeach;endif;?>
        <td>१०</td>
        <td>सम्पति /भुमि कर </td>
        <td>--</td>
        <td><?php echo !empty($sampati_kar_bhumi['total'])?$this->mylibrary->convertedcit($sampati_kar_bhumi['total']):$this->mylibrary->convertedcit(0)?></td>

      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" style="text-align: right"> जम्मा </td>
          <?php
          $net_total = $nagadi_total + $sampati_kar_bhumi['total'];
          ?>
          <td colspan="2" align="left"><?php echo !empty($net_total)?$this->mylibrary->convertedcit($net_total):$this->mylibrary->convertedcit(0)?> (<?php  echo $this->convertlib->convert($net_total,"मात्र |");?>)</td>
        </tr>
      </tfoot>
    </table>
    <!-- <div style="margin-left: 843px;margin-top: -54px; ">
          ------------------------<br>
          बुझिलिनेकाे सही<br>
          (<?php
              $user = $this->session->userdata('PRJ_');
          echo $user['name'];
          ?>)
      </div> -->
  </div><!--end of page-->

   <script src="<?php echo base_url()?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/jsprint/printThis.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
          $('#basic').on("click", function () {
            $('.hideme').hide();
            window.print();
         // $('#container').printThis();
        });
        });
    </script>

</body>

</html>
