 <!--main content start-->

 <section id="main-content">

  <section class="wrapper site-min-height">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>

        </li>

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>WardReport">रिपोर्ट </a></li>

        <li class="breadcrumb-item"><a href="javascript:;">दैनिक सङ्कलन </a></li>

      </ol>

    </nav>

    <!-- page start-->

    <div class="row">

      <div class="col-sm-12">

       <section class="card">

          <div class="card-body">

              <div class="tab-content tasi-tab" id="myTabContent">

                    <div class=""><h2 class="text-center"><?php if($ward_no == 0){ echo 'नगरपालिका' ;}  else { echo $this->mylibrary->convertedcit($ward_no).' नं वडा कार्यलय'; }?>  मासिक नगदी कर सङ्कलन रिपोर्ट

                    </h2>

                    <a href="<?php echo base_url()?>Report/MonthlyReport/printCollectionReport/<?php echo $date.'/'.$ward_no?>" class="btn btn-info">प्रिन्ट गर्नुहोस</a>

                    </div>

                      <?php if(!empty($details)) { ?>

                        <table class=" table table-striped table-bordered">

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

                            $total_amount_d = '';

                            if(!empty($details)) : 

                            foreach($details as $key => $detail) : ?>

                              <tr style="background-color:<?php if($detail['status'] == 2 ){echo 'red';}?>">

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

                                <td><?php echo $this->mylibrary->convertedcit((float)$detail['t_rates'])?></td>

                                <td><?php 

                                if($detail['status'] == 1) {

                                  echo 'सदर';

                                } else {

                                  echo 'बदर';

                                }

                                ?></td>
                                <td><?php echo $detail['name']?></td>
                                <td><?php echo $detail['reason']?></td>

                                <?php 
                                //if(!empty($detail['t_rates'])) {
                                  $total_amount_d += (float)$detail['t_rates'];
                                ?>
                              </tr>

                          <?php endforeach;endif;?>

                          </tbody>

                          <tfoot>

                            <tr>

                              <td colspan="8" style="text-align: right">जम्मा रकम </td>

                              <td colspan="3"><?php echo !empty($total_amount_d)? $this->mylibrary->convertedcit($total_amount_d):$this->mylibrary->convertedcit(0)?></td>

                            </tr>

                            <tr>

                              <td colspan="8" style="text-align: right">बदर भएको रसिदको जम्मा रकम  </td>

                              <td colspan="3"><?php echo !empty($cancel_amount['cancel_bills'])? $this->mylibrary->convertedcit($cancel_amount['cancel_bills']):$this->mylibrary->convertedcit(0)?></td>

                            </tr>

                            <tr>

                              <td colspan="8" style="text-align: right">कुल जम्मा : </td>

                              <td colspan="3">

                              <?php 

                                $net_total = $total_amount_d - $cancel_amount['cancel_bills'];

                                echo $this->mylibrary->convertedcit($net_total);

                              ?></td>

                            </tr>

                          </tfoot>

                        </table>

                      <?php } else { ?>

                        <div class="alert alert-danger"> नगदी रसिद काटिएको छैन</div>

                      <?php } ?>

                      <div class=""><h2 class="text-center">

                      <?php  

                        if($ward_no == '0'){

                          echo 'नगरपालिका' ;

                        }  else {

                          echo $this->mylibrary->convertedcit($ward_no).' नं वडा कार्यलय';

                        }

                      ?>  मासिक सम्पति /भुमि कर सङ्कलन रिपोर्ट

                    </h2></div> 

                      <?php if(!empty($sampati_bhumi_kar)) { ?>

                        <table class="table table-striped table-bordered">

                          <thead>

                            <tr>

                              <th>सि.नं</th>

                              <th>मिति</th>

                              <th>रसिद नं</th>

                              <th>करदाताको संकेत नं</th>

                              <th class="hidden-phone">करदाता को नाम</th>

                              <th class="hidden-phone">सम्पति कर</th>

                              <th class="hidden-phone">भुमि कर</th>

                              <th class="hidden-phone">अन्य सेवा शुल्क</th>

                              <th class="hidden-phone">जरिवाना रकम</th>

                              <th class="hidden-phone">बक्यौता रकम</th>

                              <th class="hidden-phone">छुट रकम</th>

                              <th class="hidden-phone"> जम्मा  रकम</th>
                              <th class="hidden-phone">अवस्था</th>
                              <th class="hidden-phone">रसिद काट्नेको नाम </th>

                              <th>कैफियत</th>

                            </tr>

                          </thead>

                          <tbody>

                            <?php 

                            $i =1;

                            $sampati_total = 0;
                            $date_sum = 0;

                            if(!empty($sampati_bhumi_kar)) :

                              foreach ($sampati_bhumi_kar as $key => $sampatikar) : ?>

                                <tr style="background-color:<?php if($sampatikar['status'] == 2 ){echo 'red';}?>; color:<?php if($sampatikar['status'] == 2 ){echo '#FFF';}?>">

                                  <td><?php echo $this->mylibrary->convertedcit($i++)?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['billing_date'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['bill_no'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['nb_file_no'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['land_owner_name_np'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['sampati_kar'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['bhumi_kar'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['other_amount'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['fine_amount'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['bakeyuta_amount'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['discount_amount'])?></td>

                                  <td><?php echo $this->mylibrary->convertedcit(number_format($sampatikar['net_total_amount']))?></td>

                                 <td>

                                    <?php 

                                    if($sampatikar['status'] == 1) {

                                      echo 'सदर';

                                    } else {

                                      echo 'बदर';

                                    } ?>

                                  </td>
                                  <td><?php echo $sampatikar['name']?></td>
                                  <td><?php echo $sampatikar['reason']?></td>

                                   <?php $sampati_total += $sampatikar['net_total_amount']?>

                                </tr>

                            <?php endforeach;endif;?>

                          </tbody>

                          <tfoot>

                            <tr>

                              <td colspan="12" style="text-align: right">जम्मा रकम </td>

                              <td colspan="3"><?php echo !empty($sampati_total)? $this->mylibrary->convertedcit($sampati_total):$this->mylibrary->convertedcit(0)?></td>

                            </tr>

                            <tr>

                              <td colspan="12" style="text-align: right">बदर भएको रसिदको जम्मा रकम  </td>

                              <td colspan="3"><?php echo !empty($sampati_cancel_amount['sampati_cancel_bills'])? $this->mylibrary->convertedcit($sampati_cancel_amount['sampati_cancel_bills']):$this->mylibrary->convertedcit(0)?></td>

                            </tr>

                            <tr>

                              <td colspan="12" style="text-align: right">कुल जम्मा : </td>

                              <td colspan="3">

                              <?php 

                                $net_total = $sampati_total- $sampati_cancel_amount['sampati_cancel_bills'];

                                echo $this->mylibrary->convertedcit(number_format($net_total));

                              ?></td>

                            </tr>

                          </tfoot>

                        </table>

                      <?php } else { ?>

                        <div class="alert alert-danger"> सम्पति /भुमि  रसिद काटिएको छैन</div>

                      <?php } ?>

                  </div>

          </div>   

        </section>

      </div>

    </div>

    <!-- page end-->

  </section>

</section>