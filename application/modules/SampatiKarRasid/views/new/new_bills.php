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
        page-break-after:auto;
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
        <div class="alert alert-danger"><h3><i class="fa fa-times"></i> <?php echo 'रद्धा भएको रसिद ('.$cancel_reason['reason'].')'?></h3></div>
    <?php } ?>

      <div style="margin-left: 896px;" class="hideme">
          <a href="<?php echo base_url()?>" class ="btn btn-success btn-sm"><i class="fa fa-home"></i> Dashboard मा जानुहोस्</a>
           <button class="btn btn-info btn-sm " style="color:#FFF;" id="basic"><i class="fa fa-print"></i> प्रिन्ट गर्नुहोस</button>

      </div>

      <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 100px; width: 120px;">

      <div style="font-size:14px; margin-left:5px;">आ ब: <?php echo !empty($kar_details['fiscal_year'])?$this->mylibrary->convertedcit($kar_details['fiscal_year']):''; ?><!-- <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?> --></div>
     <div style="font-size: 28px;margin-left: 484px;margin-top: -127px;"><b><?php echo GNAME?></b></div>

<div style="margin-left: 500px;margin-top: 0;font-size: 18px;"><b><?php  if($user['ward'] == '0'){echo SLOGAN;} else{echo $this->mylibrary->convertedcit($user['ward']).' नं. वडा कार्यलय';}?></b></div>

<div style="margin-left: 524px;margin-top:0;font-size: 18px;"><b><?php echo ADDRESS.','.DISTRICT?></b></div>

      <div style="margin-left: 474px;margin-top: 25px;font-size: 22px;"><b>सम्पतीकर/भूमिकर रसिद</b></div>

      <hr style="margin-top: 5px;background-color: #000;">

         <div style="margin-right: 90px;">

        करदाताको संकेत नं. - <b><?php echo $this->mylibrary->convertedcit($land_owner_details['file_no'])?></b>

      </div>

      <div style="margin-right: 90px;">

        करदाताको नाम. - <?php echo $land_owner_details['land_owner_name_np']?>

      </div>

      <div style="margin-top: 0; font-size: 18px;">करदाताको ठेगाना. -  <?php echo $land_owner_details['lo_tol'].', '.$gapa['name'].'-'.$this->mylibrary->convertedcit($land_owner_details['lo_ward']);?></div>

      <div style="margin-top: 0; font-size: 18px;margin-left: 122px;"><?php echo $district['name'].', '.$state['Title'];?></div>

       <div style="margin-left: 670px; margin-top:-96px;;">
           मितिः- <?php echo $this->mylibrary->convertedcit($kar_details['billing_date'])?>
      </div>
      <div style="margin-left: 670px; margin-top:0">
        रसिद नं. - <?php echo !empty($kar_details['bill_no'])?$this->mylibrary->convertedcit($kar_details['bill_no']) :''; ?>

      </div>
     
      <div style="margin-left: 670px; margin-top: 5px;">  आन्तरीक संकेत नं.-<?php echo $this->mylibrary->convertedcit($billcount)?>  </div>
      <div style="margin-left: 670px; "> पछिल्लो पटक तिरेको रसिद नं.- <?php echo !empty($lastFyBillNo)?$this->mylibrary->convertedcit($lastFyBillNo['bill_no']):'';?>
      </div>

      

       

      <br>

      <table class="print_table">

        <thead>

          <tr>

            <th rowspan="2">क्र.सं</th>

            <th colspan="6" class="text-center">जग्गाको विवरण</th>

            <th colspan="4" style="width:180px;">भौतिक संरचनाको विवरण</th>

           <th colspan="2" style="width:180px;">भूमिकर मूल्यांकन</th>

          </tr>

          <tr>

            <!-- land details -->

            <th style="width:180px;">साबिक गा.पा/न.पा</th>

            <th style="width:180px;">हालको वडा</th>
            <th style="width:180px;">सडकको नाम</th>

            <th style="width:180px;">कबुल मुल्य</th>

            <th style="width:180px;">कित्ता नं</th>

            <th style="width:180px;">क्षेत्रफल</th>

            <!-- end of land details -->

            <!-- sanrachana details -->

            <th style="width:180px;">बनावटको किसिम</th>
            <th style="width:180px;">प्रयोग</th>
            <th style="width:180px;">क्षेत्रफल(व फु )</th>
            <th style="width:180px;">कर लाग्ने मुल्य </th>
            <!-- end of sanrachana details -->
            <!-- bhumi kar -->

            <th>क्षेत्रफल(व फु )</th>

            <th>कर लाग्ने मुल्य </th>

            <!-- ends section -->

          </tr>

        </thead>

        <tbody>

        <?php

          if(!empty($Billsdetails)) {

          $i=1;

          $sampati_mulyankan_amount = 0;

          $bhumi_kar_mulyankan_rakam = 0;

          $total_ropani = 0;

          foreach($Billsdetails as $key => $value) {?>

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

                ?><br>(रो.आ.पै.दा) <?php echo $this->mylibrary->convertedcit( number_format($value['total_square_feet']),2)?>(व. फु.)

              </td>

              <!-- if has sanrachana -->

              <?php if(!empty($value['sanrachana_id'])) { ?>

                <td style="width:900px;"><?php echo $value['structure_type']?></td>

                <td><?php echo $value['sanrachana_usages']

                    //   if($value['sanrachana_usages'] == 1 ) {

                    //     echo 'निजि';

                    // } else if($value['sanrachana_usages'] == 2 ) {

                    //   echo 'भाडा';

                    // } else {

                    //     echo 'अन्य';

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

              <td colspan="4"><div class="alert alert-danger">संरचनाको  छैन </div></td>

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

                 $unit = 'रोपनी';

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

          
        </tbody>
      </table>
      <table class ="print_table" style ="margin-top:-2px;">
         <tbody>
            <tr>
               
              <td  colspan="8" class="text-right">जम्मा सम्पती मूल्यांकन </td>
              <td colspan="" class="text-left"><?php echo $this->mylibrary->convertedcit($sampati_mulyankan_amount)?></td>
              <td colspan="">जम्मा भूमिकर मूल्यांकन</td>
              <td colspan="">
                <?php echo !empty($bhumi_kar_mulyankan_rakam)?$this->mylibrary->convertedcit($bhumi_kar_mulyankan_rakam):0; ?>
              </td>
            </tr>
         </tbody>
      </table>
      <div style="width: 100%;margin-left:690px; margin-top: 11px;">

          <table >

            <tr >

              <td ><b>सम्पतीकर रु:</b></td><td align="right"> <?php echo !empty($kar_details['sampati_kar'])?$this->mylibrary->convertedcit(number_format($kar_details['sampati_kar'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr>

            

            <tr>

              <td><b>भूमिकर:</b> </td><td align="right"><?php echo !empty($kar_details['bhumi_kar'])?$this->mylibrary->convertedcit(number_format($kar_details['bhumi_kar'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr> 

            <tr>

              <td><b>अन्य सेवा शुल्क रु:</b></td><td align="right"> <?php echo !empty($kar_details['other_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['other_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr>

            <tr>

              <td><b>छुट रकम रु:</b></td><td align="right"> <?php echo !empty($kar_details['discount_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['discount_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr>

            <tr>

              <td><b>जरिवाना रकम रु:</b></td><td align="right"> <?php echo !empty($kar_details['fine_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['fine_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>

            </tr>

           
            <tr>
              <td><b>सम्पतिमा बक्यौता रकम रु:</b></td><td align="right"> <?php echo !empty($kar_details['bakeyuta_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['bakeyuta_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>
            </tr>

            <tr>
              <td><b>सम्पतिमा बक्यौता (आ.व.)</b></td><td align="right"> <?php echo !empty($kar_details['sampati_bakeyuta_date'])?$this->mylibrary->convertedcit($kar_details['sampati_bakeyuta_date']):$this->mylibrary->convertedcit('-')?></td>
            </tr>

            <tr>
              <td><b>भूमिमा  बक्यौता रकम रु:</b></td><td align="right"> <?php echo !empty($kar_details['bhumi_baykeuta_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['bhumi_baykeuta_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?></td>
            </tr>

            <tr>
              <td><b>भूमिमा बक्यौता (आ.व.)</b></td><td align="right"> <?php echo !empty($kar_details['bhumi_bakeuta_date'])?$this->mylibrary->convertedcit($kar_details['bhumi_bakeuta_date']):$this->mylibrary->convertedcit('-')?></td>
            </tr>
            <tr>
            <tr><td colspan="2" style="border-bottom: 2px #000 solid"></td></tr>
            <td ><b>कुल जम्मा रु:</b></td><td align="right" style="border-top: 2px solid #000"> <?php echo !empty($kar_details['net_total_amount'])?$this->mylibrary->convertedcit(number_format($kar_details['net_total_amount'])).'/-':$this->mylibrary->convertedcit(0).'/-'?>
            </td>
            </tr>
          </table>

         

      </div>

      <div style="width: 570px;margin-left: 30px; margin-top: -288px;">

        <ul class="">

          <li>समयमा बुझाउनु पर्ने कर नबुझाएमा जरिवाना लाग्ने छ ।</li>

          <li>सम्पतीकर थपघट भएमा थपघट भएको ३५ दिन भित्र  <?php echo TYPE?> कार्यालयमा आइ सो को विवरण पेश गर्नुपर्ने छ।</li>

          <li>सम्पतीकर बुझाउदैमा <?php echo TYPE?> घरको नक्सापास गर्नुपर्ने दायित्ववाट छुटकार हुनेछैन ।</li>

        </ul>

     </div>

      <div style="margin-top: 150px;margin-left: 315px;"><b>अक्षेरुपी <?php echo $this->convertlib->convert($kar_details['net_total_amount'],"मात्र |").' '.'मात्र ';?></b></div>

      <div style="margin-top:50px;margin-left: 30px;">

          ------------------------<br>

          बुझाउनेकाे सही:

      </div>



      <div style="margin-left: 843px;margin-top:-64px; ">

          ------------------------<br>

          बुझिलिनेकाे सही<br>

          <?php
              
              echo $user['name'].'<br>';
              echo $this->mylibrary->convertedcit($user['ward']) .' नं. वडा कार्यलय';

          ?>

      </div>

      <div style="margin-left: 268px;"><b><u>कृपयाः अर्को पटक कर तिर्न आउँदा यो रसिद साथमा लिएर आउनुहोला ।

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

