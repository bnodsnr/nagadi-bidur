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
 <!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="javascript:;">सम्पति-भुमि कर विवरण</a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <section class="card">
          <div class="card-body">
            <div class="tab-content tasi-tab" id="">
                <div class="alert alert-info"><h3 class=""> मिति:<?php echo !empty($date)?$this->mylibrary->convertedcit($date):'';?> सपम्पति-भुमि कर विवरण
                  </h3>
                </div>
                  <?php if(!empty($sampati_bhumi_kar)) { ?>
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
                              <th>कैफियत</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $i =1;
                            $sampati_total = 0;
                            if(!empty($sampati_bhumi_kar)) :
                              foreach ($sampati_bhumi_kar as $key => $sampatikar) : ?>
                                <tr style="background-color:<?php if($sampatikar['status'] == 2 ){echo 'red';}else { echo 'green'; }?>;color:#FFF">
                                  <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['billing_date'])?></td>
                                  <td><a href="<?php echo base_url()?>SampatiKarRasid/printPreview/<?php echo $sampatikar['nb_file_no']?>" class="badge badge-warning" target ="_blank"><i class="fa fa-eye"> </i> <?php echo $this->mylibrary->convertedcit($sampatikar['bill_no'])?></a></td>
                                  <td><a href="<?php echo base_url()?>PersonalProfile/view/<?php echo $sampatikar['nb_file_no']?>" class="badge badge-warning" target ="_blank"><i class="fa fa-eye"> </i><?php echo $this->mylibrary->convertedcit($sampatikar['nb_file_no'])?></a></td>
                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['land_owner_name_np'])?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['sampati_kar'])?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['bhumi_kar'])?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['other_amount'])?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['fine_amount'])?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['bakeyuta_amount'])?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['discount_amount'])?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($sampatikar['net_total_amount'])?></td>
                                 <td>
                                    <?php 
                                    if($sampatikar['status'] == 1) {
                                      echo 'सदर';
                                    } else {
                                      echo 'बदर';
                                    } ?>
                                  </td>
                                  <td><?php echo $sampatikar['reason']?></td>
                                   <?php $sampati_total += $sampatikar['net_total_amount']?>
                                </tr>
                            <?php endforeach;endif;?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="11" style="text-align: right">जम्मा रकम </td>
                              <td colspan="3"><?php echo !empty($sampati_total)? $this->mylibrary->convertedcit($sampati_total):$this->mylibrary->convertedcit(0)?></td>
                            </tr>
                            <tr>
                              <td colspan="11" style="text-align: right">बदर भएको रसिदको जम्मा रकम  </td>
                              <td colspan="3"><?php echo !empty($sampati_cancel_amount['sampati_cancel_bills'])? $this->mylibrary->convertedcit($sampati_cancel_amount['sampati_cancel_bills']):$this->mylibrary->convertedcit(0)?></td>
                            </tr>
                            <tr>
                              <td colspan="11" style="text-align: right">कुल जम्मा : </td>
                              <td colspan="3">
                              <?php 
                                $net_total = $sampati_total- $sampati_cancel_amount['sampati_cancel_bills'];
                                echo $this->mylibrary->convertedcit($net_total);
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