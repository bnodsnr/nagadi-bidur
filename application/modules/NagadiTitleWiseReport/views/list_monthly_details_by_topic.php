 <!--main content start-->

 <section id="main-content">

  <section class="wrapper site-min-height">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>

        </li>

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>WardReport">रिपोर्ट </a></li>

      </ol>

    </nav>

    <!-- page start-->

    <div class="row">

      <div class="col-sm-12">

        <section class="card">

          <h2 class="text-center"><?php echo $this->mylibrary->convertedcit($billDetails[0]['topicno'].'-'.$billDetails[0]['main_topic'])?> <?php echo getNepaliMonthName(get_current_month())?> महिनाको  विवरण </h2>

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

                <th class="hidden-phone">रसिद काट्नेको नाम </th>

                <th>कैफियत</th>

              </tr>

            </thead>

            <tbody>

              <?php $i =1;

              $total = 0;

              if(!empty($billDetails)) :

                foreach($billDetails as $key => $detail) : ?>

                  <tr style="background-color:<?php if($detail['status'] == 2 ){echo 'red';}?>">

                    <td><?php echo $this->mylibrary->convertedcit($i++)?></td>

                    <td><?php echo $this->mylibrary->convertedcit($detail['added'])?></td>

                    <td><?php echo $this->mylibrary->convertedcit($detail['bill_no'])?></td>

                    <td><?php echo $detail['customer_name']?></td>

                    <td><?php echo $detail['main_topic']?></td>

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

                  <td><?php echo $detail['name']?></td>

                  <td><?php echo $detail['reason']?></td>

                  <?php $total += $detail['t_rates'];?>

                </tr>

              <?php endforeach;endif;?>

            </tbody>

            <tfoot>

              <tr>

                <td colspan="8" style="text-align: right">जम्मा रकम </td>

                <td colspan="3"><?php echo !empty($total)? $this->mylibrary->convertedcit($total):$this->mylibrary->convertedcit(0)?></td>

              </tr>

              <tr>

                <td colspan="8" style="text-align: right">बदर भएको रसिदको जम्मा रकम  </td>

                <td colspan="3"><?php echo !empty($cancel_amount['cancel_bills'])? $this->mylibrary->convertedcit($cancel_amount['cancel_bills']):$this->mylibrary->convertedcit(0)?></td>

              </tr>

              <tr>

                <td colspan="8" style="text-align: right">कुल जम्मा : </td>

                <td colspan="3">

                  <?php 

                    $net_total = $total - $cancel_amount['cancel_bills'];

                    echo $this->mylibrary->convertedcit($net_total);

                  ?></td>

                </tr>

              </tfoot>

            </table>

        </section>

      </div>

    </div>

  </section>

</section>