<!--main content start-->

<section id="main-content">

    <section class="wrapper">

      <nav aria-label="breadcrumb">

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="<?php echo base_url()?>Dashboard"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>

            <li class="breadcrumb-item"><a href="<?php echo base_url()?>BankDeposit">बैंक दाखिला फारम सुची </a></li>

            <li class="breadcrumb-item"><a href=""> नयाँ थप्नुहोस् </a></li>

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


              <form role="form" action="<?php echo base_url()?>BankDeposit/Save" method="post" class="form save_post" enctype="multipart/form-data">
              <header class="card-header" style="background: #1b5693;color:#FFF">बैंक दाखिला फारम <?php echo $this->mylibrary->convertedcit($fiscal_year)?></header>

              <div class="card-body">
                 <div class="alert alert-info"><h2>हाल सम्मा संकलन गरिएको रकम:- <?php echo round($total_amount,2)?>|हाल बैंक खातामा  जम्मा  गरिएको रकम:- <?php echo round($total_deposit_amt->deposit_amt,2)?> </h2></div>
                <div class="valid_errors"></div>

                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                  <div class="row">
                    <input type ="hidden" name = "fiscal_year" value="<?php echo $fiscal_year?>" class="form-control" readonly="true">
                    <input type ="hidden" name = "id" value="<?php echo !empty($rows)?$rows['id']:'';?>" class="form-control" readonly="true">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>दाखिला मिति<span style="color:red">*</span></label>
                        <div class="">
                          <div class="input-group">
                            <input type="text" name="dakhila_date" class="form-control" required="true" id="nepaliDate" value="<?php echo !empty($rows)?$rows['deposit_date']:convertDate(date('Y-m-d'));?>">
                            <div class="input-group-prepend">
                              <button type="button" class="input-group-text btn btn-danger" title="" style="background:#FFF"><i class="fa fa-calendar" style="color:#1b5693;background: #fff;"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>बैंकको नाम<span style="color:red">*</span></label>
                        <div class="">
                         <select class="form-control bank_name" name="bank_name" required="true">
                          <option value ="">छान्नुहोस्</option>
                          <?php if(!empty($banks)): 
                            foreach ($banks as $key => $value) : ?>
                              <option value="<?php echo $value['name']?>" 
                                <?php if(!empty($rows['bank_name'])) {
                                    if($rows['bank_name'] == $value['name']) {
                                      echo 'selected';
                                    }
                                } ?>

                                ><?php echo $value['name']?></option>
                          <?php endforeach;endif;?>
                         </select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>खाता नं<span style="color:red">*</span></label>
                        <div class="">
                          <input type="text" name="acc_no" value="<?php echo !empty($rows)?$rows['acc_no']:''?>" class="form-control acc_no" readonly="true" required = "true">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>भौचर नं. <span style="color:red">*</span></label>
                        <div class="">
                          <input type="text" name="voucher_no" value="<?php echo !empty($rows)?$rows['voucher_no']:''?>" class="form-control" required="true">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>बैंक भौचर.</label>
                        <div class="">
                          <input type="file" name="userfile" value="" class="form-control">
                          <?php if(!empty($rows)) { ?>
                            <input type="hidden" name="old_image" value="<?php echo $rows['voucher_image']?>">
                          <?php } ?>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>जम्मा गर्नु पर्ने रकम<span style="color:red">*</span></label>
                        <div class="">
                          <input type="text" name="total_amount" value="<?php echo round($total_due_amount,2)?>" id="totalamount" class="form-control" required="true" readonly ="true">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>जम्मा गरेको रकम<span style="color:red">*</span></label>
                        <div class="">
                          <input type="text" name="deposit_amount" id="deposit_amount" value="<?php echo !empty($rows)?$rows['deposit_amt']:''?>" class="form-control" required="true">
                        </div>
                      </div>
                    </div>

                    <?php $total_edit_value = $total_due_amount + $rows['deposit_amt'];?>
                    <input type="hidden" name="edit_value" id="edit_value" value="<?php echo $total_edit_value?>">

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>बाकीं रकम<span style="color:red">*</span></label>
                        <div class="">
                          <input type="text" name="due_amount" value="<?php echo !empty($rows)?$rows['due_amount']:''?>" id="due_amount" class="form-control" required="true">
                        </div>
                      </div>
                    </div>
                     <?php if(!empty($rows['voucher_image'])) { ?>
                      <div class="col-md-12">
                        <label>बैंक भौचर.</label>
                        <img src="<?php echo base_url()?>assets/vouchers/<?php echo $rows['voucher_image']?>">
                      </div>
                      <?php } else { ?>
                        <div class="alert alert-danger">बैंक भौचर राखिएको छैन  </div>
                      <?php } ?>
                    <div class="col-md-12 text-center">
                      <hr>
                      <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
                      <a href="<?php echo base_url()?>BankDeposit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
                    </div>
                  </div>
                </form>
              </div>

              </div>

            </section>

          </div>

        </div>

        <!-- page end-->

    </section>

</section>

<script type="text/javascript">
  $(document).ready(function(){
     $('#nepaliDate').nepaliDatePicker({});
      //$('.nepali-calendar').nepaliDatePicker({});
    $(document).on('change', '.bank_name', function(){
     
      var bank_name = $(this).val();
      $.ajax({
        url:base_url+'BankDeposit/getAccountNo',
        method:"POST",
        data:{bank_name:bank_name,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $('.acc_no').val(resp.data);
        }
      });
    });

    $(document).on('input', '#deposit_amount', function(){
      var deposit_amount = $(this).val();
      var total_amount = $('#edit_value').val();
      var due_amount = parseFloat(total_amount) - parseFloat(deposit_amount);
      $('#due_amount').val(due_amount);
    });
  });
</script>

