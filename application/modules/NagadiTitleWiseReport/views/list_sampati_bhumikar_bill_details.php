 <!--main content start-->

 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="javascript:;">रिपोर्ट </a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <header class="card-header" style="background: #1b5693;color:#FFF">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  btn btn-warning" href="<?php echo base_url()?>Report/DailyReport" r>दैनिक रिपोर्ट</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  btn btn-warning active"href="<?php echo base_url()?>Report/MonthlyReport" >मासिक रिपोर्ट </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  btn btn-warning"  href="<?php echo base_url()?>Report/Search" >रिपोर्ट खोज्नुहोस</a>
                </li>
            </ul>
        </header>
        <div class="card-body">
          <h3 class="text-center">
           
         एकीकृत सम्पती कर/भुमिकर-मालपोत विवरण: महिना: <?php echo getNepaliMonthName(get_current_month())?> </h3>
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
        </div>
      </div>
    </div>
    <!-- page end-->
  </section>
</section>