 <a href="<?php echo base_url()?>SearchDetails/PrintDetails/<?php echo $from_date.'/'.$to_date.'/'.$ward_no.'/'.$fy?>" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> प्रिन्ट </a>
 <?php if(!empty($nagadi_details)) { ?>
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
      if(!empty($nagadi_details)) : 
        foreach($nagadi_details as $key => $detail) : ?>
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
          <td><?php echo $detail['name']?></td>
          <td><?php echo $detail['reason']?></td>
          <?php $total += $detail['t_rates']?>
        </tr>
      <?php endforeach;endif;?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="7" style="text-align: right">जम्मा रकम </td>
        <td colspan=""><?php echo !empty($total)? $this->mylibrary->convertedcit(number_format($total,2)):$this->mylibrary->convertedcit(0)?></td>
        <td colspan="3"></td>
      </tr>
      <tr>
        <td colspan="7" style="text-align: right">बदर भएको रसिदको जम्मा रकम  </td>
        <td colspan=""><?php echo !empty($cancel_amount['cancel_bills'])? $this->mylibrary->convertedcit(number_format($cancel_amount['cancel_bills'],2)):$this->mylibrary->convertedcit(0)?></td>
        <td colspan="3"></td>
      </tr>
      <tr>
        <td colspan="7" style="text-align: right">कुल जम्मा : </td>
        <td colspan="">
          <?php 
            $net_total = $total- $cancel_amount['cancel_bills'];
            echo $this->mylibrary->convertedcit(number_format($net_total,2));
          ?></td>
          <td colspan="3"></td>
        </tr>
      </tfoot>
    </table>
  <?php } else { ?>
    <div class="alert alert-danger"> नगदी रसिद काटिएको छैन</div>
  <?php } ?>
  <?php if(!empty($sampatikar)) { ?>
    <div class="alert alert-info"><h3 class="text-center"> सम्पति /भुमि  रसिद</h3>
  </div>
    <table class="print_table table table-stripe table-bordered">
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
          <th class="hidden-phone">सम्पतिमा बक्यौता रकम</th>
          <th class="hidden-phone">भूमिमा बक्यौता रकम</th>
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
        if(!empty($sampatikar)) :
          foreach ($sampatikar as $key => $sampatikar) : 
            $ssampati += $sampatikar['sampati_kar'];
            $sbhumi += $sampatikar['bhumi_kar'];
            $sother_amount += $sampatikar['other_amount'];
            $sfine_amount += $sampatikar['fine_amount'];
            $sbhumiba += $sampatikar['bhumi_baykeuta_amount'];
            $ssampatiba += $sampatikar['bakeyuta_amount'];
            $sdiscount +=$sampatikar['discount_amount'];
          ?>
            <tr>
              <td><?php echo $this->mylibrary->convertedcit($i++)?></td>

              <td><?php echo $this->mylibrary->convertedcit($sampatikar['billing_date'])?></td>

              <td><?php echo $this->mylibrary->convertedcit($sampatikar['bill_no'])?></td>

              <td><?php echo $this->mylibrary->convertedcit($sampatikar['nb_file_no'])?></td>

              <td><?php echo $this->mylibrary->convertedcit($sampatikar['land_owner_name_np'])?></td>

              <td><?php echo $this->mylibrary->convertedcit(number_format($sampatikar['sampati_kar'],2))?></td>

              <td><?php echo $this->mylibrary->convertedcit(number_format($sampatikar['bhumi_kar'],2))?></td>

              <td><?php echo $this->mylibrary->convertedcit(number_format($sampatikar['other_amount'],2))?></td>

              <td><?php echo $this->mylibrary->convertedcit(number_format($sampatikar['fine_amount'],2))?></td>

              <td><?php echo $this->mylibrary->convertedcit(number_format($sampatikar['bakeyuta_amount'],2))?></td>
              <td><?php echo $this->mylibrary->convertedcit(number_format($sampatikar['bhumi_baykeuta_amount'],2))?></td>

              <td><?php echo $this->mylibrary->convertedcit(number_format($sampatikar['discount_amount'],2))?></td>

              <td><?php echo $this->mylibrary->convertedcit(number_format($sampatikar['net_total_amount'],2))?></td>

              <td>

                <?php 

                if($sampatikar['status'] == 1) {

                  echo 'सदर';

                } else {

                  echo 'बदर';

                } ?>

              </td>
              <td><?php echo $detail['name']?></td>
              <td><?php echo ''?></td>

              <?php $sampati_total += $sampatikar['net_total_amount']?>

            </tr>

          <?php endforeach;endif;?>
        <tr>
            <td colspan = "5"></td>
            <td><?php echo $this->mylibrary->convertedcit(number_format($ssampati,2))?></td>
            <td><?php echo $this->mylibrary->convertedcit(number_format($sbhumi,2))?></td>
            <td><?php echo $this->mylibrary->convertedcit(number_format($sother_amount,2))?></td>
            <td><?php echo $this->mylibrary->convertedcit(number_format($sfine_amount,2))?></td>
            <td><?php echo $this->mylibrary->convertedcit(number_format($ssampatiba,2))?></td>
            <td><?php echo $this->mylibrary->convertedcit(number_format($sbhumiba,2))?></td>
            <td><?php echo $this->mylibrary->convertedcit(number_format($sdiscount,2))?></td>
            <td><?php echo $this->mylibrary->convertedcit(number_format($sampati_total,2))?></td>
            <td colspan ='2'></td>
        </tr>
        </tbody>

        <tfoot>

          <tr>

            <td colspan="13" style="text-align: right">जम्मा रकम </td>

            <td colspan="3"><?php echo !empty($sampati_total)? $this->mylibrary->convertedcit(number_format($sampati_total,2)):$this->mylibrary->convertedcit(0)?></td>

          </tr>

          <tr>

            <td colspan="13" style="text-align: right">बदर भएको रसिदको जम्मा रकम  </td>

            <td colspan="3"><?php echo !empty($sampati_cancel_amount['sampati_cancel_bills'])? $this->mylibrary->convertedcit(number_format($sampati_cancel_amount['sampati_cancel_bills'],2)):$this->mylibrary->convertedcit(0)?></td>

          </tr>

          <tr>

            <td colspan="13" style="text-align: right">कुल जम्मा : </td>

            <td colspan="3">

              <?php 

              $net_total = $sampati_total- $sampati_cancel_amount['sampati_cancel_bills'];

              echo $this->mylibrary->convertedcit(number_format($net_total,2));

              ?></td>

            </tr>

          </tfoot>

        </table>

      <?php } else { ?>

        <div class="alert alert-danger"> सम्पति /भुमि  रसिद काटिएको छैन</div>

        <?php } ?>