<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title><?php echo GNAME?></title>
<link rel="shortcut icon" href="<?php echo base_url()?>assets/img/nepal-govt.png">
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

    <div style="margin-left: 500px;margin-top: 0;font-size: 14px;"><b><?php  if($this->session->userdata('PRJ_USER_WARD') == 0){ echo SLOGAN; } else { echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD')).' नं. वडा कार्यलय';}?></b></div>

    <div style="margin-left: 524px;margin-top:0;font-size: 14px;"><b><?php echo ADDRESS.','.DISTRICT?></b></div>
        <hr style="margin-top: 55px;">


 <div class=""><h2 class="text-center">नगदी सङ्कलन (<?php echo $main_topic['topic_name']?>)</h2></div> 

<?php if(!empty($nagadibilldetails)) { ?>

                        <table class="table table-striped table-bordered">

                          <thead>

                            <tr>

                              <th>सि.नं</th>

                              <th>मिति</th>

                              <th>रसिद नं</th>

                              <th>करदाताको नाम</th>

                              <th class="hidden-phone">मुख्य शिर्षक</th>

                              <th class="hidden-phone">सह शिर्षक</th>

                              <th class="hidden-phone">शिर्षक</th>

                              <th class="hidden-phone">रकम</th>

                              <th class="hidden-phone">अवस्था</th>

                              <th>कैफियत</th>
                              <th>रसिद काट्नेको नाम </th>
                            </tr>

                          </thead>

                          <tbody>

                            <?php $i =1;

                            $total = 0;

                            if(!empty($nagadibilldetails)) : 

                            foreach($nagadibilldetails as $key => $detail) : ?>

                              <tr>

                                <td><?php echo $this->mylibrary->convertedcit($i++)?></td>

                                <td><?php echo $this->mylibrary->convertedcit($detail['added'])?></td>

                                <td><?php echo $this->mylibrary->convertedcit($detail['bill_no'])?></td>

                                <td><?php echo $detail['customer_name']?></td>

                                <td><?php echo $detail['topic_name']?></td>

                                <td><?php echo $detail['sub_topic']?></td>

                                <td><?php

                                  if($detail['topic'] == "others") {

                                      echo $detail['others_topic'];

                                  } else {

                                    echo $detail['topic_title'];

                                  } ?>

                                  </td>

                                <td><?php echo $this->mylibrary->convertedcit(number_format($detail['t_rates'],2))?></td>

                                <td><?php 

                                if($detail['status'] == 1) {

                                  echo 'सदर';

                                } else {

                                  echo 'बदर';

                                }

                                ?></td>

                                <td><?php echo $detail['reason']?></td>
                                <td><?php echo $detail['name']?></td>
                                <?php $total += $detail['t_rates']?>

                              </tr>

                          <?php endforeach;endif;?>

                          </tbody>

                          <tfoot>

                            <tr>

                              <td colspan="7" style="text-align: right">जम्मा रकम </td>

                              <td colspan="4"><?php echo !empty($total)? $this->mylibrary->convertedcit(number_format($total,2)):$this->mylibrary->convertedcit(0)?></td>

                            </tr>

                            <tr>

                              <td colspan="7" style="text-align: right">बदर भएको रसिदको जम्मा रकम  </td>

                              <td colspan="4"><?php echo !empty($cancel_amount['cancel_bills'])? $this->mylibrary->convertedcit(number_format($cancel_amount['cancel_bills'],2)):$this->mylibrary->convertedcit(0)?></td>

                            </tr>

                            <tr>

                              <td colspan="7" style="text-align: right">कुल जम्मा : </td>

                              <td colspan="4">

                              <?php 

                                $net_total = $total- $cancel_amount['cancel_bills'];

                                echo $this->mylibrary->convertedcit(number_format($net_total,2));

                              ?></td>

                            </tr>

                          </tfoot>

                        </table>

                      <?php } else { ?>

                        <div class=""> नगदी रसिद काटिएको छैन</div>

                      <?php } ?>

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

