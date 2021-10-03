<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title><?php echo GNAME?></title>
  <link rel="shortcut icon" href="<?php echo base_url()?>/assets/img/nepal-govt.png">

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

          font-size: 18px;

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

          font-size: 18px;

          border: solid 1px;

          border-collapse: collapse;

          margin: 0;

          padding: 0;

          text-align: center;

      }

      .print_table tr:nth-child(odd){

          background-color:#fff;

      }

      .print_table tr:nth-child(even){

          background-color:#ffffff;

      }

  </style>



</head>



<body style="--bleeding: 0.5cm;--margin: 1cm;">

  <div class="page">

    <!-- Your content here -->

    <?php if(!empty($cancel_reason)) {?>
        <div class="alert alert-danger"><h3><i class="fa fa-times"></i> <?php echo 'रद्धा भएको रसिद ('.$cancel_reason['reason'].')'?></h3></div>
    <?php } ?>

      <div style="margin-left: 986px; " class="hideme">
          <?php if(empty($cancel_reason)){ ?>

          <?php } ?>
          <button class="btn btn-default btn-sm " style="color:#FFF;" id="basic"><i class="fa fa-print"></i></button>

          <a href="<?php echo base_url()?>" class ="btn btn-success btn-sm"><i class="fa fa-home"></i></a>

      </div>



      <!--

      ----------------------------------------------------------------------------------------------

       office copy 

      ----------------------------------------------------------------------------------------------->

      <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 60px; width: 70px;">

<div style="font-size:10px; margin-left:5px;">आ ब: <?php echo $this->mylibrary->convertedcit($bill_details['fiscal_year'])?></div>



<div style="font-size: 28px;margin-left: 484px;margin-top: -65px;"><b><?php echo GNAME?></b></div>

<div style="margin-left: 500px;margin-top: 0;font-size: 14px;"><b><?php

  if($this->session->userdata('PRJ_USER_ID') == 1) {

    echo SLOGAN;

  } else {
    if($this->session->userdata('PRJ_USER_WARD') == 0) {
      echo SLOGAN;
    } else {
      echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD')).' नं. वडा कार्यलय';

    }

  }?></b></div>

<div style="margin-left: 524px;margin-top:0;font-size: 14px;"><b><?php echo ADDRESS.','.DISTRICT?></b></div>




<div style="margin-left: 434px;margin-top: 12px;font-size: 20px;"><b>नगदी रशिद(कार्यालय प्रति <?php if($bill_details['print_count'] > 0){echo '';}?>)</b></div>

<div style="margin-top: -65px;margin-left: 919px;font-size: 15px;">म.ले.प. फारम नं.१०१</div>

<hr style="margin-top: 50px;">

<div style="margin-top: 0;margin-left: 925px;font-size: 14px;"> रशिद नं : <?php echo $this->mylibrary->convertedcit($bill_details['bill_no']) ?></div>

<div style="margin-top: -5px; margin-left:915px; font-size: 14px;">मिति : <?php echo $this->mylibrary->convertedcit($bill_details['date'])?></div>

<div style="margin-top: -42px; font-size: 14px;">नाम: <?php echo $bill_details['customer_name'] ?></div>

<div style="margin-top: 0; font-size: 14px;">ठेगाना: <?php echo $gapas['name'] .'-'.$this->mylibrary->convertedcit($bill_details['ward'])?><br><?php echo $district['name'] .', '.$states['Title']?></div>
<!--  -->


<table class="print_table">

  <tr>

    <th rowspan="2" style="font-size: font-size: 18px" align="center">क्र.सं</th>

    <th colspan="2" style="font-size: font-size: 18px"align="center">प्राप्त शीर्षक</th>

    <th rowspan="2" style="font-size: font-size: 18px" align="center">वापत/प्रयाेजन</th>

    <th rowspan="2" align="center">परिमाण</th>

    <th rowspan="2" align="center">दर</th>
    <th rowspan="2">छुट रकम </th>
    <th rowspan="2" align="center">रकम रु</th>

    <th rowspan="2" style="font-size: font-size: 18px" align="right">प्राप्त माध्यम</th>

  </tr>

  <tr>

   <th>संकेत नम्बर</th>

   <th>विवरण</th>

 </tr>

 <?php

 $count = 0;

 $i =1;if(!empty($nagadi_detials)) : 

 foreach ($nagadi_detials as $key => $value): ?>

  <tr>

    <td style="font-size: font-size: 18px"><?php echo $this->mylibrary->convertedcit($i);?></td>

    <td style="font-size: font-size: 18px">

      <?php 

      echo $this->mylibrary->convertedcit($value['topic_no'])

      ?>

    </td>

    <td style="font-size: font-size: 18px"><?php echo $value['topic_name']?></td>

    <td style="font-size: font-size: 18px">

     <?php if($value['topic'] == 'others') {

      $topic_title = $value['others_topic'];

    } else {

      $topic_title = $value['topic_title'];

    }

    echo $topic_title;

    ?>

  </td>

  <td><?php echo $this->mylibrary->convertedcit($value['topic_qty'])?></td>

  <td><?php echo $this->mylibrary->convertedcit($value['rate']).'/-'?>

</td>

<td><?php 
    $discount_amount = $value['rate'] / 100 * $value['discount_amount'];
    echo $this->mylibrary->convertedcit($discount_amount);
?></td>


<td><?php echo $this->mylibrary->convertedcit($value['t_rates']).'/-'?></td>

<td style="font-size: 18px"><?php if($bill_details['payment_mode'] == 1) {echo 'नगद';} else { echo 'चेक';}?></td>

</tr>

<?php $i++;endforeach;endif;?>

<tr>

  <td colspan="5" align="right" style="font-size: font-size: 18px">जम्मा रकम(अंकमा)</td>

  <td colspan="3" style="font-size: font-size: 18px"><?php echo 'रु.'.$this->mylibrary->convertedcit($bill_details['t_total'])?></td>

</tr>

</table>
<div style="font-size: 16px;margin-top:10px;">

            <b><i>श्री  <?php echo $bill_details['customer_name']?>  बाट देहाय बमोजिम अक्षेरुपी <?php echo $this->convertlib->convert($bill_details['t_total'],"मात्र |");?> प्राप्त भयो ।</i></b>

          </div>
<div style="font-size: font-size: 18px;">

  बुझाउनेकाे सही :

</div>

<div style="font-size: font-size: 18px;margin-left: 872px;margin-top: -13px;">बुझिलिनेकाे सही :</div>

<div style="font-size: font-size: 18px;margin-left: 872px;"><?php echo $user->name?></div>

 <div style="font-size: 18px;margin-left: 872px;margin-top:7px;"><?php 
  if($user->ward == 0 ) {
    echo GNAME;
  } else {
  echo $this->mylibrary->convertedcit($user->ward).' नं. वडा कार्यलय';

  } ?>
  </div>

   <div style="width:485px;margin-left: 19px;">

        <ul>

          <li style="font-size: 12px;">कर तिराैं, सभ्य नागरिक बनाैं ।</li>

          <li style="font-size: 12px;">हाम्राे ठाउँ सवै मिलेर राम्राे बनाऔ‌ं।</li>

          <li style="font-size: 12px;">नियमित कर तिरी नगरकाे विकास निर्माणमा सहभागी बनौ ।</li>

          <li style="font-size: 12px;">कर तिर्नु सवै नगरवासीहरुकाे कर्तव्य हाे भने सेवा प्राप्त गर्नु अधिकार हाे ।</li>

          <li style="font-size: 12px;">तिर्नुपर्ने सम्पूर्ण कर चुक्ता नगरेसम्म कुनैपनि सेवा सुविधा उपलब्ध गराउन कार्यलय बाध्य हुने छैन ।</li>

        </ul>

      </div>


      <!-- ---------------------------------------------------------------------------------------

        users copy

      -------------------------------------------------------------------------------------------

       -->

       <div style="margin-top:10px;">----------------------------------------------------------------------------------------------------------------------------------------------------------------</div>

      <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 120px; width: 150px;">

      <div style="font-size: 16px;

    margin-left: 0px;

    margin-top: 45px;">आ ब: <?php echo $this->mylibrary->convertedcit($bill_details['fiscal_year'])?></div>



      <div style="font-size: 28px;margin-left: 495px;margin-top: -135px;"><b><?php echo GNAME?></b></div>

      <div style="margin-left: <?php  

      if($this->session->userdata('PRJ_USER_ID') == 1){echo '500px';} else{echo '536px';}?>;margin-top: 0;font-size: 14px;"><b><?php  if($this->session->userdata('PRJ_USER_ID') == 1){echo SLOGAN;} else {

        if($this->session->userdata('PRJ_USER_WARD') == 0)  {
          echo SLOGAN;
        } else{
          echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD')).' नं. वडा कार्यलय';}

        }

        ?>
          

        </b></div>

      <div style="margin-left: 524px;margin-top:0;font-size: 14px;"><b><?php echo ADDRESS.','.DISTRICT?></b></div>



      <div style="margin-left: 474px;margin-top: font-size: 18px;font-size: 20px;"><b>नगदी रशिद(सेवाग्राही प्रति <?php if($bill_details['print_count'] > 0){echo ' ';}?>)</b></div>

      <div style="margin-top: -90px;margin-left: 900px;font-size: 16px;">म.ले.प. फारम नं.१०१</div>

      

       <div style="margin-top: 80px;margin-left: 875px;font-size: 16px;"> रशिद नं : <?php echo $this->mylibrary->convertedcit($bill_details['bill_no']) ?></div>

       <div style="margin-top: 0px; margin-left:875px; font-size: 16px;">मिति : <?php echo $this->mylibrary->convertedcit($bill_details['date'])?></div>

      <div style="margin-top: -42px; font-size: 16px;">नाम: <?php echo $bill_details['customer_name'] ?></div>

      <div style="margin-top: 0; font-size: 16px;">ठेगाना: <?php echo $gapas['name'] .'-'.$this->mylibrary->convertedcit($bill_details['ward'])?><br><?php echo $district['name'] .', '.$states['Title']?></div>

      <hr style="margin-top: 17px;background-color: #000">

      <table class="print_table">

          <tr>

            <th rowspan="2" style="font-size: 18px" align="center">क्र.सं</th>

            <th colspan="2" style="font-size: 18px"align="center">प्राप्त शीर्षक</th>

            <th rowspan="2" style="font-size: 18px" align="center">वापत/प्रयाेजन</th>

             <th rowspan="2" align="center">परिमाण</th>

            <th rowspan="2" align="center">दर</th>
            <th rowspan="2">छुट रकम </th>
            <th rowspan="2" align="center">रकम रु</th>

           <th rowspan="2" style="font-size: 12px" align="right">प्राप्त माध्यम</th>

         </tr>

         <tr>

           <th>संकेत नम्बर</th>

           <th>विवरण</th>

         </tr>

         <?php

          $count = 0;

          $i =1;if(!empty($nagadi_detials)) : 

          foreach ($nagadi_detials as $key => $value): ?>

          <tr>

            <td style="font-size: 18px"><?php echo $this->mylibrary->convertedcit($i);?></td>

            <td style="font-size: 18px">

              <?php 

              echo $this->mylibrary->convertedcit($value['topic_no'])

              ?>

            </td>

            <td style="font-size: 18px"><?php echo $value['topic_name']?></td>

            <td style="font-size: 18px">

               <?php if($value['topic'] == 'others') {

                  $topic_title = $value['others_topic'];

                } else {

                  $topic_title = $value['topic_title'];

                }

                echo $topic_title;

              ?>

            </td>

            <td><?php echo $this->mylibrary->convertedcit($value['topic_qty'])?></td>

            <td><?php echo $this->mylibrary->convertedcit($value['rate']). '/-'?>

            </td>
            <td><?php 
    $discount_amount = $value['rate'] / 100 * $value['discount_amount'];
    echo $this->mylibrary->convertedcit($discount_amount);
?></td>
            <td><?php echo $this->mylibrary->convertedcit($value['t_rates']).'/-'?></td>

            <td style="font-size: 18px"><?php if($bill_details['payment_mode'] == 1) {echo 'नगद';} else { echo 'चेक';}?></td>

          </tr>

          <?php $i++;endforeach;endif;?>

           <tr>

            <td colspan="5" align="right" style="font-size: 18px">जम्मा रकम(अंकमा)</td>

            <td colspan="3" style="font-size: 18px"><?php echo 'रु.'.$this->mylibrary->convertedcit($bill_details['t_total'])?></td>

          </tr>

      </table>

      <div style="font-size: 16px;margin-top:10px;">

            <b><i>श्री  <?php echo $bill_details['customer_name']?>  बाट देहाय बमोजिम अक्षेरुपी <?php echo $this->convertlib->convert($bill_details['t_total'],"मात्र |");?> प्राप्त भयो ।</i></b>

          </div>

       <div style="font-size: 18px; margin-top: 15px;">

          बुझाउनेकाे सही :

      </div>

      <div style="font-size: 18px;margin-left: 872px;margin-top: -13px;">बुझिलिनेकाे सही :</div>

      <div style="font-size: 18px;margin-left: 872px;"><?php echo $user->name?></div>

      <div style="font-size: 18px;margin-left: 872px;margin-top:7px;"><?php 
       if($user->ward == 0 ) {
          echo GNAME ;
       } else {
          echo $this->mylibrary->convertedcit($user->ward).' नं. वडा कार्यलय';
       }

      ?></div>

      <div style="width:485px;margin-left: 19px;">

        <ul>

          <li style="font-size: 12px;">कर तिराैं, सभ्य नागरिक बनाैं ।</li>

          <li style="font-size: 12px;">हाम्राे ठाउँ सवै मिलेर राम्राे बनाऔ‌ं।</li>

          <li style="font-size: 12px;">नियमित कर तिरी नगरकाे विकास निर्माणमा सहभागी बनौ ।</li>

          <li style="font-size: 12px;">कर तिर्नु सवै नगरवासीहरुकाे कर्तव्य हाे भने सेवा प्राप्त गर्नु अधिकार हाे ।</li>

          <li style="font-size: 12px;">तिर्नुपर्ने सम्पूर्ण कर चुक्ता नगरेसम्म कुनैपनि सेवा सुविधा उपलब्ध गराउन कार्यलय बाध्य हुने छैन ।</li>

        </ul>

      </div>

      <div style="margin-left: 392px;margin-top: 5px;"><b>नियमानुसार कर / दस्तुर तिर्नु भएकोमा धन्यवाद !!! !!!</b></div>



      

      <!-- End of your content -->

     

        

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

