<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo GNAME?></title>
  <link rel="shortcut icon" href="https://bms_bidur.dev/assets/img/nepal-govt.png">
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
        border: solid 1px #000;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        text-align: center;
        /*background-color:#407ac5;*/
        color: #000;
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
      .table-bordered thead td, .table-bordered thead th{
        border-color:#000;
      }
    }

    /*child table*/
    .child_table {
      width: 100%;
        /*border: solid 1px;
        border-collapse: collapse;*/
      }
      .child_table th{
       /* border-color: black;*/
       font-size: 12px;
       /* border: solid 1px #000;
       border-collapse: collapse;*/
       margin: 0;
       padding: 0;
       /*background-color:#407ac5;*/
       color: #000;
     }
     .child_table td{
      /*border-color: white;*/
      font-size: 12px;
        /*border: solid 1px;
        border-collapse: collapse;*/
        margin: 0;
        padding: 0;
        /*text-align: left;*/
      }
      .child_table tr:nth-child(odd){
        background-color:#fff;
      }
      .child_table tr:nth-child(even){
        background-color:#fff;
        /*color: #FFF;*/
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
      <div style="font-size:12px; margin-left:25px;">??? ???: <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?></div>

      <div style="font-size: 28px;margin-left: 484px;margin-top: -130px;"><b><?php echo GNAME?></b></div>
      <div style="margin-left: 500px;margin-top: 0;font-size: 14px;"><b><?php  if($this->session->userdata('PRJ_USER_ID') == 1){ echo SLOGAN; } else { echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD')).' ??????. ????????? ?????????????????????';}?></b></div>
      <div style="margin-left: 524px;margin-top:0;font-size: 14px;"><b><?php echo ADDRESS.','.DISTRICT?></b></div>
      <div style="margin-left: 460px;margin-top: 12px;font-size: 22px;"></div>
      <div style=" margin-top:70px;">
        <h3><?php echo $this->mylibrary->convertedcit($titles[0]->topic_no).'-'.$titles[0]->topic_name?> <?php echo getNepaliMonthName(get_current_month())?> ?????????????????????  ????????????????????? </h3> 
      </div>

      <table class="table table-bordered print_table">
        <thead>
          <tr>
            <th>#</th>
            <th align="center">?????????????????? ?????? </th>
            <th align="center">????????????????????? ??????????????????</th>
            <th align="center">?????? ??????????????????</th>

          </tr>
        </thead>
        <tbody>
          <?php $i= 2;if(!empty($titles)) :
          foreach ($titles as $key => $maintopic) : ?>
          <tr>
            <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
            <td><?php echo $this->mylibrary->convertedcit($maintopic->topic_no)?></td>
            <td><?php echo $maintopic->topic_name?></td>
            <td>
              <table class="child_table">
                <thead>
                  <tr>
                   <td align="center">??????????????????</td>
                   <td align="center">??????????????? ??????</td>
                 </tr>
               </thead>
               <tbody>
                <?php $total_sum =0;if(!empty($maintopic->children)) : 
                foreach ($maintopic->children as $key => $subtopic) :
                $sum = $this->NagadiTitleWiseReportModel->getMonthlySum($subtopic->id);
                $total_sum += $sum->total;
                ?>
                <tr>
                 <td><?php echo $subtopic->sub_topic?></td>
                 <td><?php echo $this->mylibrary->convertedcit(!empty($sum->total) ? round($sum->total):'0');?></td>
               </tr>
               <?php endforeach;endif;?>
             </tbody>
             <tfooter>
               <tr>
                <td colspan="" align="right">??????????????? </td>
                <td><?php echo $this->mylibrary->convertedcit(round($total_sum))?></td>
              </tr>
            </tfooter>
          </table>
        </td>
        <?php $total_nagadi += $total_sum;?>
      </tr>
      <?php endforeach;endif;?>
      <?php $net_total = $total_nagadi + $sampati_kar['total'] + $bhumi_kar['total']?>
      <tr>
        <td colspan="3" style="text-align: right;">????????? ???????????????</td>
        <td style="text-align: right;"><?php echo $this->mylibrary->convertedcit(round($net_total))?></td>

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
         // $('#container').printThis();
       });
  });
</script>

</body>

</html>
