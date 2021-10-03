<style type="text/css">

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

                text-align: center;

            }

            .print_table tr:nth-child(odd){

                background-color:#E8E8E8;

            }

            .print_table tr:nth-child(even){

                background-color:#E8E8E8;

                /*color: #FFF;*/

            }

            

  }



  .hiddenRow {

    padding: 0 !important;

    &:before {

      display: none;

    }

  table {

    margin-bottom: 0;

  }

}



  @media only screen and (max-width: 767px) {

  

  /* Taken from elvery.net/demo/responsive-tables */

  

  /* Force table to not be like tables anymore */

  #no-more-tables > table, 

  #no-more-tables > table > thead, 

  #no-more-tables > table > tbody, 

  #no-more-tables > table > thead > tr > th, 

  #no-more-tables > table > tbody > tr > td, 

  #no-more-tables > table > tbody > tr { 

    display: block; 

  }

 

  /* Hide table headers (but not display: none;, for accessibility) */

  #no-more-tables > table > thead > tr { 

    position: absolute;

    top: -9999px;

    left: -9999px;

  }

 

  #no-more-tables > table > tbody > tr { border: 1px solid #ccc; }

 

  #no-more-tables > table > tbody > tr > td { 

    /* Behave  like a "row" */

    border: none;

    border-bottom: 1px solid #eee; 

    position: relative;

    padding-left: 36.1%; 

    white-space: normal;

    text-align:left;

  }

 

  #no-more-tables > table > tbody > tr > td:before { 

    /* Now like a table header */

    position: absolute;

    /* Top/left values mimic padding */

    top: 0;

    left: 0;

    width: 33.33333333%; 

    padding-right: 10px; 

    white-space: nowrap;

    text-align:left;

    font-weight: bold;

    background-color: #f5f5f5;

    padding: 8px;

  }

 

  /*

  Label the data

  */

  #no-more-tables td:before { content: attr(data-title); }

  

  .table-nested,

  .table-nested tbody,

  .table-nested td,

  .table-nested tr,

  .table-nested th,

  .table-nested tr > td {

      width: 100%;

      display: block;

  }

}

</style>

 <!--main content start-->

 <section id="main-content">

  <section class="wrapper site-min-height">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>Report"><i class="fa fa-home"></i> गृहपृष्ठ</a>

        </li>

        <li class="breadcrumb-item"><a href="javascript:;">दैनिक रिपोर्ट </a></li>

      </ol>

    </nav>

    <!-- page start-->

    <div class="row">

      <div class="col-sm-12">

        <section class="card">

          <div class="card-body">

            <div class="alert alert-info"><h3 class="text-center"> <?php 

              echo $title['topic_name'];

                  ?> </h3>

            </div>

           <?php if(!empty($nagadi_details)) { ?>

              <a href="<?php echo base_url()?>Report/DailyReport/printNagadiDetailsByTopic/<?php echo $topic_id.'/'.$date.'/'.$ward_no?>" class="btn btn-sm btn-info pull-right"> <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस </a>

              <table class="print_table table table-stripe table-bordered">

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

                  </tr>

                </thead>

                <tbody>

                  <?php $i =1;

                  $total = 0;

                  if(!empty($nagadi_details)) : 

                  foreach($nagadi_details as $key => $detail) : ?>

                    <tr style="background-color:<?php if($sampatikar['status'] == 2 ){echo 'red';}?>">

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

                      <td><?php echo $this->mylibrary->convertedcit($detail['t_rates'])?></td>

                      <td><?php 

                      if($detail['status'] == 1) {

                        echo 'सदर';

                      } else {

                        echo 'बदर';

                      }

                      ?></td>

                      <td><?php echo $detail['reason']?></td>

                      <?php $total += $detail['t_rates']?>

                    </tr>

                <?php endforeach;endif;?>

                </tbody>

                <tfoot>

                  <tr>

                    <td colspan="7" style="text-align: right">जम्मा रकम </td>

                    <td colspan="3"><?php echo !empty($total)? $this->mylibrary->convertedcit($total):$this->mylibrary->convertedcit(0)?></td>

                  </tr>

                  <tr>

                    <td colspan="7" style="text-align: right">बदर भएको रसिदको जम्मा रकम  </td>

                    <td colspan="3"><?php echo !empty($cancel_amount['cancel_bills'])? $this->mylibrary->convertedcit($cancel_amount['cancel_bills']):$this->mylibrary->convertedcit(0)?></td>

                  </tr>

                  <tr>

                    <td colspan="7" style="text-align: right">कुल जम्मा : </td>

                    <td colspan="3">

                    <?php 

                      $net_total = $total- $cancel_amount['cancel_bills'];

                      echo $this->mylibrary->convertedcit($net_total);

                    ?></td>

                  </tr>

                </tfoot>

              </table>

            <?php } else { ?>

              <div class="alert alert-danger"> नगदी रसिद काटिएको छैन</div>

            <?php } ?>

          </div>   

        </section>

      </div>

    </div>

    <!-- page end-->

  </section>

</section>