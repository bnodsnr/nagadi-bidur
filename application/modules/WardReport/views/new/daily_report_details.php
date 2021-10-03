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
        <li class="breadcrumb-item"><a href="javascript:;">व्यक्तिगत अभिलेख</a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <?php $success_message = $this->session->flashdata("MSG_SUCCESS");
                      if(!empty($success_message)) { ?>
        <div class="alert alert-success">
          <button class="close" data-close="alert"></button>
          <span> <?php echo $success_message;?> </span>
        </div>
        <?php } ?>
       <section class="card">
         <!--  <header class="card-header" style="background: #1b5693;color:#FFF"> -->
             <!--  <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link show active btn btn-warning" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">नगदी कर रिपोर्ट  </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link  btn btn-warning" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">स्सम्पति /भुमि कर रिपोर्ट </a>
                  </li>
              </ul> -->
         <!--  </header> -->
          <div class="card-body">
              <div class="tab-content tasi-tab" id="myTabContent">
               <!--  <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab"> -->
                  <!-- <div style="margin-top:20px;"> -->
                   
                      <?php if(!empty($details)) { ?>
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
                            if(!empty($details)) : 
                            foreach($details as $key => $detail) : ?>
                              <tr>
                                <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                                <td><?php echo $this->mylibrary->convertedcit($detail['billing_date'])?></td>
                                <td><?php echo $this->mylibrary->convertedcit($detail['bno'])?></td>
                                <td><?php echo $detail['customer_name']?></td>
                                <td><?php echo $detail['main_topic']?></td>
                                <td><?php echo $detail['st']?></td>
                                <td><?php echo $detail['topic_title']?></td>
                                <td><?php echo $this->mylibrary->convertedcit($detail['t_rates'])?></td>
                                <td><?php 
                                if($detail['nagadi_status'] == 1) {
                                  echo 'सदर';
                                } else {
                                  echo 'बदर';
                                }
                                ?></td>
                                <td><?php echo $detail['reason']?></td>
                                <?php $total += $detail['t_total']?>
                              </tr>
                          <?php endforeach;endif;?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="7"> जम्मा </td>
                              <td colspan="3" align="left"><?php echo !empty($total)?$this->mylibrary->convertedcit($total):$this->mylibrary->convertedcit(0)?></td>
                            </tr>
                          </tfoot>
                      </table>
                      <?php } else { ?>
                        <div class="alert alert-danger">डाटा खाली छ</div>
                      <?php } ?>
                      
                  </div>
               <!--  </div> -->
              <!-- </div> -->
              
              <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

              </div> -->
          </div>   
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
</section>