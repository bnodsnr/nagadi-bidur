<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title></title>
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
      font-size: 14pt;
      margin: 5em auto;
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

    @media print {
      .page {
        margin: 0;
        overflow: hidden;
      }
    }


    .print_table {
      width: 100%;
      border: solid 1px;
      border-collapse: collapse;
      margin-top: 10px;
    }
    .print_table th{
      border-color: black;
      font-size: 14px;
      border: solid 1px;
      border-collapse: collapse;
      margin: 0;
      padding: 0;
      color:#000;
      background-color:#c2cdd8;
      text-align: center;
    }
    .print_table td{
      border-color: black;
      font-size: 14px;
      border: solid 1px;
      border-collapse: collapse;
      margin: 0;
      padding: 10px;
      text-align: center;
      width: auto;
    }
    .print_table tr:nth-child(odd){
      background-color:#fff;
    }
    .print_table tr:nth-child(even){
      background-color:#ffffff;
    }
    .print_table table tfoot {
      background-color:#c2cdd8;
    }
  </style>


</head>



<body style="--bleeding: 0.5cm;--margin: 1cm;">

  <div class="page">
    <?php $user = $this->CommonModel->getCurrentUser($kar_details['added_by']);?>
    <!-- Your content here -->
    <?php if($kar_details['status'] == 2) {?>
        <div class="alert alert-danger"><h3><i class="fa fa-times"></i> <?php echo '??????????????? ???????????? ???????????? ('.$cancel_reason['reason'].')'?></h3></div>
    <?php } ?>

      <div style="margin-left: 706px;" class="hideme">
          <a href="<?php echo base_url()?>" class ="btn btn-success btn-sm"><i class="fa fa-home"></i> Dashboard ?????? ????????????????????????</a>
           <button class="btn btn-info btn-sm " style="color:#FFF;" id="basic"><i class="fa fa-print"></i> ????????????????????? ????????????????????????</button>

      </div>

      <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 100px; width: 120px;">

      <div style="font-size:14px; margin-left:5px;">??? ???: <?php echo !empty($kar_details['fiscal_year'])?$this->mylibrary->convertedcit($kar_details['fiscal_year']):''; ?><!-- <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?> --></div>
     <div style="font-size: 28px;margin-left: 484px;margin-top: -127px;"><b><?php echo GNAME?></b></div>

<div style="margin-left: 500px;margin-top: 0;font-size: 18px;"><b><?php  if($user['ward'] == '0'){echo SLOGAN;} else{echo $this->mylibrary->convertedcit($user['ward']).' ??????. ????????? ?????????????????????';}?></b></div>

<div style="margin-left: 524px;margin-top:0;font-size: 18px;"><b><?php echo ADDRESS.','.DISTRICT?></b></div>

      <div style="margin-left: 474px;margin-top: 25px;font-size: 22px;"><b>????????????????????????/?????????????????? ????????????</b></div>

      <hr style="margin-top: 5px;background-color: #000;">

         <div style="margin-right: 90px;">

        ???????????????????????? ??????????????? ??????. - <b><?php echo $this->mylibrary->convertedcit($land_owner_details['file_no'])?></b>

      </div>

      <div style="margin-right: 90px;">

        ???????????????????????? ?????????. - <?php echo $land_owner_details['land_owner_name_np']?>

      </div>

      <div style="margin-top: 0; font-size: 18px;">???????????????????????? ??????????????????. -  <?php echo $land_owner_details['lo_tol'].', '.$gapa['name'].'-'.$this->mylibrary->convertedcit($land_owner_details['lo_ward']);?></div>

      <div style="margin-top: 0; font-size: 18px;margin-left: 122px;"><?php echo $district['name'].', '.$state['Title'];?></div>

       <div style="margin-left: 670px; margin-top:-96px;;">
           ???????????????- <?php echo $this->mylibrary->convertedcit($kar_details['billing_date'])?>
      </div>
      <div style="margin-left: 670px; margin-top:0">
        ???????????? ??????. - <?php echo !empty($kar_details['bill_no'])?$this->mylibrary->convertedcit($kar_details['bill_no']) :''; ?>

      </div>
     
      <div style="margin-left: 670px; margin-top: 5px;">  ????????????????????? ??????????????? ??????.-<?php echo $this->mylibrary->convertedcit($billcount)?>  </div>
      <div style="margin-left: 670px; "> ????????????????????? ????????? ?????????????????? ???????????? ??????.- <?php echo !empty($lastFyBillNo)?$this->mylibrary->convertedcit($lastFyBillNo['bill_no']):'';?>
      </div>

      

       

      <br>

      <table class="print_table">

        <thead>

          <tr>

            <th rowspan="2">?????????.??????</th>

            <th colspan="6" class="text-center">????????????????????? ???????????????</th>

            <th colspan="4" style="width:180px;">??????????????? ???????????????????????? ???????????????</th>

           <th colspan="2" style="width:180px;">?????????????????? ???????????????????????????</th>

          </tr>

          <tr>

            <!-- land details -->

            <th style="width:180px;">??????????????? ??????.??????/???.??????</th>

            <th style="width:180px;">??????????????? ?????????</th>
            <th style="width:180px;">??????????????? ?????????</th>

            <th style="width:180px;">???????????? ???????????????</th>

            <th style="width:180px;">?????????????????? ??????</th>

            <th style="width:180px;">???????????????????????????</th>

            <!-- end of land details -->

            <!-- sanrachana details -->

            <th style="width:180px;">????????????????????? ???????????????</th>
            <th style="width:180px;">??????????????????</th>
            <th style="width:180px;">???????????????????????????(??? ?????? )</th>
            <th style="width:180px;">?????? ?????????????????? ??????????????? </th>
            <!-- end of sanrachana details -->
            <!-- bhumi kar -->

            <th>???????????????????????????(??? ?????? )</th>

            <th>?????? ?????????????????? ??????????????? </th>

            <!-- ends section -->

          </tr>

        </thead>

        <tbody>

        <?php

          if(!empty($landdetails)) {

          $i=1;

          $sampati_mulyankan_amount = 0;

          $bhumi_kar_mulyankan_rakam = 0;

          $total_ropani = 0;

          foreach($landdetails as $key => $value) {
         
          ?>

          <tr>

              <td style="width: 180px"><?php echo $this->mylibrary->convertedcit($i++)?></td>

              <td><?php echo $value['old_gapa_napa'].'-'.$this->mylibrary->convertedcit($value['old_ward'])?></td>

              <td><?php echo $value['present_gapa_napa'].'-'.$this->mylibrary->convertedcit($value['present_ward'])?></td>

             <!--  <td><?php //echo $value['land_area_type']?></td> -->

              <td style="width:900px;"><?php echo $value['rm']?></td>

              <td><?php echo $this->mylibrary->convertedcit($value['k_land_rate'])?></td>

              <td><?php echo $this->mylibrary->convertedcit($value['k_number'])?></td>

              <td style="width:200px;">

                <?php

                  $ropani = !empty($value['a_ropani']) ? $value['a_ropani'] : 0;
                  $a_ana = !empty($value['a_ana']) ? $value['a_ana'] : 0;
                  $a_paisa = !empty($value['a_paisa']) ? $value['a_paisa'] : 0;
                  $a_dam = !empty($value['a_dam']) ? $value['a_dam'] : 0;


                  echo $this->mylibrary->convertedcit($ropani).'-'.$this->mylibrary->convertedcit($a_ana).'-'.$this->mylibrary->convertedcit($a_paisa).'-'.$this->mylibrary->convertedcit($a_dam);

                ?><br>(??????.???.??????.??????) <?php echo $this->mylibrary->convertedcit( number_format($value['total_square_feet']),2)?>(???. ??????.)

              </td>

              <!-- if has sanrachana -->

              <?php if(!empty($value['sanrachana_id'])) { ?>

                <td style="width:900px;"><?php echo $value['structure_type']?></td>

                <td><?php echo $value['sanrachana_usages']

                    //   if($value['sanrachana_usages'] == 1 ) {

                    //     echo '????????????';

                    // } else if($value['sanrachana_usages'] == 2 ) {

                    //   echo '????????????';

                    // } else {

                    //     echo '????????????';

                    // }

                  ?></td>

               

                <td><?php echo $this->mylibrary->convertedcit(round($value['sanrachana_ground_housing_area_sqft'],2))?></td>

                 <?php if(!empty($value['net_tax_amount'])){

                    $sampati_mulyankan_amount += $value['net_tax_amount']; //sum sampati mulyankan rakam.

                  } else{

                    $sampati_mulyankan_amount = 0;

                  } ?>

                  <td><?php echo $this->mylibrary->convertedcit($sampati_mulyankan_amount)?></td>

              <?php } else { ?>

              <td colspan="4"><div class="alert alert-danger">?????????????????? ????????? </div></td>

             <?php  } ?>

             <!-- end of sanrachana details -->

             <!-- bhumi kar details -->

             <td style="width:200px;">

                <?php 

                  if(!empty($value['sanrachana_id'])) { 

                    $bhumi_eval = $value['r_bhumi_area'];

                    $ropani = $bhumi_eval/5476;

                  } else { 

                    $bhumi_eval = $value['total_square_feet'];

                    $ropani = $bhumi_eval/5476;

                  } 

                 $unit = '???????????????';

                 //if($ropani < 1) {

                //  echo '--'; 

              // } else {

                echo $this->mylibrary->convertedcit(round($bhumi_eval,2)).'<br>('.$this->mylibrary->convertedcit(round($ropani,2)).$unit.')';

             // }

               // 

                 ?>

              </td>



              <!-- bhumi kar rakam -->

              <td style="width:200px;">

                <?php if(!empty($value['sanrachana_id'])) {

                    $bhumi_kar_lagne_rakam =  $value['r_bhumi_kar'];

                  } else {

                    $bhumi_kar_lagne_rakam = $value['t_rate'];

                  } 

                  //get bhumi_kar_mulyankan_rakam

                  if(!empty($bhumi_kar_lagne_rakam)) {

                    $bhumi_kar_mulyankan_rakam += $bhumi_kar_lagne_rakam;

                  }

                  if($bhumi_kar_lagne_rakam < 1) {

                    echo '--';

                  } else {

                    echo $this->mylibrary->convertedcit($bhumi_kar_lagne_rakam);

                  }

                ?>

                <?php $total_ropani += $value['total_square_feet'];?>

              </td> 

          </tr>

        <?php }

        } 

        ?>

          <tfoot>
            <tr>
              <td colspan="10" class="text-right">??????????????? ?????????????????? ??????????????????????????? </td>
              <td colspan="" class="text-left"><?php echo $this->mylibrary->convertedcit($sampati_mulyankan_amount)?></td>
              <td colspan="">??????????????? ?????????????????? ???????????????????????????</td>
              <td colspan="">
                <?php echo !empty($bhumi_kar_mulyankan_rakam)?$this->mylibrary->convertedcit($bhumi_kar_mulyankan_rakam):0; ?>
              </td>
            </tr>
          </tfoot>
        </tbody>
      </table>
      <div style="width: 100%;margin-left:690px; margin-top: 11px;">

          <table >

            <tr >

              <td ><b>???????????????????????? ??????:</b></td><td align="right"> <?php echo !empty($kar_details['sampati_kar'])?$this->mylibrary->convertedcit(number_format($kar_details['sampati_kar'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr>

            

            <tr>

              <td><b>??????????????????:</b> </td><td align="right"><?php echo !empty($kar_details['bhumi_kar'])?$this->mylibrary->convertedcit(number_format($kar_details['bhumi_kar'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr> 

            <tr>

              <td><b>???????????? ???????????? ??????????????? ??????:</b></td><td align="right"> <?php echo !empty($kar_details['other_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['other_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr>

            <tr>

              <td><b>????????? ????????? ??????:</b></td><td align="right"> <?php echo !empty($kar_details['discount_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['discount_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr>

            <tr>

              <td><b>????????????????????? ????????? ??????:</b></td><td align="right"> <?php echo !empty($kar_details['fine_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['fine_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr>

           
            <tr>
              <td><b>???????????????????????? ????????????????????? ????????? ??????:</b></td><td align="right"> <?php echo !empty($kar_details['bakeyuta_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['bakeyuta_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>
            </tr>

            <tr>
              <td><b>???????????????????????? ????????????????????? (???.???.)</b></td><td align="right" style="width:150px;"> <?php echo !empty($kar_details['sampati_baykeuta_date'])?$this->mylibrary->convertedcit($kar_details['sampati_baykeuta_date']):$this->mylibrary->convertedcit('-')?></td>
            </tr>

            <tr>
              <td><b>??????????????????  ????????????????????? ????????? ??????:</b></td><td align="right"> <?php echo !empty($kar_details['bhumi_baykeuta_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['bhumi_baykeuta_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>
            </tr>

            <tr>
              <td><b>?????????????????? ????????????????????? (???.???.)</b></td><td align="right" style="width:150px;"> <?php echo !empty($kar_details['bhumi_bakeuta_date'])?$this->mylibrary->convertedcit($kar_details['bhumi_bakeuta_date']):$this->mylibrary->convertedcit('-')?></td>
            </tr>
            <tr>
            <tr><td colspan="2" style="border-bottom: 2px #000 solid"></td></tr>
            <td ><b>????????? ??????????????? ??????:</b></td><td align="right" style="border-top: 2px solid #000"> <?php echo !empty($kar_details['net_total_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['net_total_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?>
            </td>
            </tr>
          </table>

         

      </div>

      <div style="width: 570px;margin-left: 30px; margin-top: -288px;">

        <ul class="">

          <li>??????????????? ????????????????????? ??????????????? ?????? ???????????????????????? ????????????????????? ?????????????????? ??? ???</li>

          <li>???????????????????????? ???????????? ???????????? ???????????? ???????????? ?????? ????????? ???????????????  <?php echo TYPE?> ?????????????????????????????? ?????? ?????? ?????? ??????????????? ????????? ?????????????????????????????? ??????</li>

          <li>???????????????????????? ??????????????????????????? <?php echo TYPE?> ???????????? ???????????????????????? ?????????????????????????????? ?????????????????????????????? ?????????????????? ????????????????????? ???</li>

        </ul>

     </div>

      <div style="margin-top: 150px;margin-left: 315px;"><b>??????????????????????????? <?php echo $this->convertlib->convert($kar_details['net_total_amount'],"??????????????? |").' '.'??????????????? ';?></b></div>

      <div style="margin-top:50px;margin-left: 30px;">

          ------------------------<br>

          ?????????????????????????????? ?????????:

      </div>



      <div style="margin-left: 843px;margin-top:-64px; ">

          ------------------------<br>

          ????????????????????????????????? ?????????<br>

          <?php
              
              echo $user['name'].'<br>';
              echo $this->mylibrary->convertedcit($user['ward']) .' ??????. ????????? ?????????????????????';

          ?>

      </div>

      <div style="margin-left: 268px;

    margin-top: 139px;"><b><u>?????????????????? ??????????????? ????????? ?????? ??????????????? ??????????????? ?????? ???????????? ??????????????? ???????????? ???????????????????????? ???

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

