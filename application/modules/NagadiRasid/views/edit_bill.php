<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>NagadiRasid">नगदी रशिद सूची</a></li>
        <li class="breadcrumb-item"><a href="javascript:;"> सम्पादन थप्नुहोस् </a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
            <section class="card">
              <header class="card-header" style="background: #1b5693;color:#FFF"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                नगदी रशिद
              </header>
              <div class="card-body">
                   <?php $success_message = $this->session->flashdata("MSG_ERR");
                      if(!empty($success_message)) { ?>
                      <div class="alert alert-success">
                          <button class="close" data-close="alert"></button>
                          <span> <?php echo $success_message;?> </span>
                      </div>
                    <?php } ?>
                  <form role="form" action="<?php echo base_url()?>NagadiRasid/editNagadiRasid" method="post">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                      <div class="col-md-12">
                        <table class="table table-bordered">
                          <thead style="background: #1b5693; color:#fff">
                            <tr>
                              <th>करदाताको विवरण प्रविष्ट गर्नुहोस्</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <div class="row">
                                  <input type="hidden" name="id" value="<?php echo $erow['id']?>">
                                  <input type="hidden" name="guid" value="<?php echo $erow['guid']?>">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label class="">प्रदेश </label>
                                      <!-- <input type="text" class="form-control" name="pradesh" value="<?php echo PROVIENCE?>" readonly="readonly" tabindex="-1"> -->
                                      <select class="form-control dd_select npl_state" name="pradesh" required id="province">
                                        <option value="">छान्नुहोस्</option>
                                        <?php if(!empty($provinces)) : 
                                            foreach ($provinces as $key => $p) : ?>
                                              <option value="<?php echo $p['ID']?>" <?php if($p['ID'] == $erow['provience']) {echo 'selected';}?>><?php echo $p['Title']?></option>
                                        <?php endforeach;endif;?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label class="">जिल्ला</label>
                                    <!--   <input type="text" class="form-control" name="" value="<?php //echo DISTRICT?>" readonly="readonly" tabindex="-1">
                                     <input type="hidden" class="form-control" name="district" value="<?php //echo DID?>" readonly="readonly" tabindex="-1"> -->
                                     <select class="form-control dd_select npl_districts" id="district" required name="district" >
                                        <option value=""></option>
                                        <?php if(!empty($districts)) : 
                                            foreach($districts as $d) :?>
                                              <option value="<?php echo $d['id']?>" <?php if($d['id'] == $erow['district']) {echo 'selected';}?>><?php echo $d['name']?></option>
                                        <?php endforeach;endif;?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                     <label class="">ग.पा / न. पा 
                                     </label>
                                     <select class=" form-control select_option npl_gapana" name="gaunpalika_nagarpalika">
                                      <?php 
                                        $gapana = $this->CommonModel->getGapanaByDistrict($erow['district']);
                                        if(!empty($gapana)) : 
                                          foreach ($gapana as $key => $gn) : ?>
                                          <option value="<?php echo $gn['id']?>" <?php if($erow['gapa_napa'] == $gn['id']){ echo 'selected';}?>><?php echo $gn['name']?></option>
                                          <?php endforeach;endif;?>
                                    </select>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                     <label class="">वडा </label>
                                     <select class="select_option form-control" name = "ward_no">
                                      <?php if(!empty($ward)) : 
                                        foreach ($ward as $key => $w) : ?>
                                          <option value="<?php echo $w['name']?>" <?php if($erow['ward']== $w['name']){ echo 'selected';}?>><?php echo $this->mylibrary->convertedcit($w['name'])?></option>
                                        <?php endforeach;endif;?>
                                    </select>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                                      <input type="text" class="form-control" placeholder="" name="fiscal_year" required="required" value="<?php echo $current_fy['year']?>" readonly="readonly">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>मिति <span style="color:red">*</span></label>
                                      <input type="text" class="form-control" placeholder="" name="date" required="required" value="<?php echo convertDate(date('Y-m-d'))?>" readonly="readonly">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                    
                                      <label> रशिद  नं <span style="color:red">*</span></label>
                                      <input type="text" class="form-control" placeholder="" name="bill_no" required="required" readonly="readonly" value="<?php echo $erow['bill_no']?>" tabindex="-1">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label> करदताको नाम  <span style="color:red">*</span></label>
                                      <input type="text" class="form-control" placeholder="" name="customer_name" required="required" value="<?php if(!empty($erow['customer_name'])) {echo $erow['customer_name'];}?>" tabindex="1" autofocus>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <table class="table table-bordered" id="add_new_fields">
                          <thead style="background: #1b5693; color:#fff">
                           <!--  <tr>
                              <th>बिल विवरण प्रविष्ट गर्नुहोस् <button class="btn btn-success btn-sm btnAddNew pull-right" data-toggle="tooltip" title=" नयाँ थप्नुहोस्" tabindex="-1"><i class="fa fa-plus"> </i> नयाँ थप्नुहोस् </button></th>
                            </tr> -->
                          </thead>
                          <tbody>
                            <?php if(!empty($nagadi_detials)): 
                              foreach ($nagadi_detials as $key => $ngd) : ?>
                              <tr class="nagadi_rasid_frm">
                                <input type = "hidden" name="bid[]" value="<?php echo $ngd['id']?>">
                                <td>
                                  <div class ="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="">मुख्य शीर्षक </label>
                                         <select class="main_topic" name="main_topic[]" data-placeholder="मुख्य शीर्षक छनौट गर्नुहोस्" tabindex="0" required="required">
                                          <option value="">मुख्य शीर्षक छनौट गर्नुहोस्</option>
                                          <?php if(!empty($main_topic)) : 
                                            foreach ($main_topic as $key => $value) : ?>
                                              <option value="<?php echo $value['id']?>"
                                                <?php if($value['id'] == $ngd['main_topic']){echo 'selected';} ?>
                                                ><?php echo $value['topic_name']?></option>
                                          <?php endforeach;endif;?>
                                        </select>
                                      </div>
                                    </div>
                                    <?php 
                                      $sub_topic = $this->CommonModel->getAllDataBySelectedFields('topic', 'main_topic', $ngd['main_topic'])?>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="">सहायक शीर्षक  </label>
                                          <select class="select_option sub_topic" name="sub_topic[]" data-placeholder="" tabindex="1" required="required" >
                                            <?php if(!empty($sub_topic)) : 
                                              foreach ($sub_topic as $key => $subtopic) : ?>
                                                <option value="<?php echo $subtopic['id']?>" <?php if($subtopic['id'] == $ngd['subtopic_id']){ echo 'selected';}?>><?php echo $subtopic['sub_topic']?></option>
                                            <?php endforeach;endif?>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <?php 
                                        $topic = $this->CommonModel->getAllDataBySelectedFields('sub_topic', 'sub_topic', $ngd['st']);
                                        ?> <label class=""> शीर्षक</label>
                                      <select class="main_title" name="main_title[]" required="required">
                                        <?php if(!empty($topic)) : 
                                              foreach ($topic as $key => $tp) : ?>
                                                <option value="<?php echo $tp['id']?>" <?php if($tp['id'] == $ngd['topic']){ echo 'selected';}?>><?php echo $tp['topic_title']?></option>
                                                <option value ='others' <?php if($ngd['topic'] == 'others'){echo 'selected';}?>>अन्य शीर्षक</option>
                                        <?php endforeach;endif?>
                                      </select>
                                    </div>

                                   <?php if($ngd['topic'] == 'others'): ?>
                                    <div class="col-md-4 other_title_section" id="other_title" >
                                      <div class="form-group">
                                        <label class="">अन्य शीर्षक</label>
                                        <input type="text" name="other_title[]" value="<?php echo !empty($ngd['others_topic'])?$ngd['others_topic']:''?>" class="form-control other_title" style="height: 30px;">
                                      </div>
                                    </div>
                                  <?php else: ?>
                                    <div class="col-md-4 other_title_section" id="other_title" >
                                      <div class="form-group">
                                        <label class="">अन्य शीर्षक</label>
                                        <input type="text" name="other_title[]" value="<?php echo !empty($ngd['others_topic'])?$ngd['others_topic']:''?>" class="form-control other_title" style="height: 30px;">
                                      </div>
                                    </div>
                                  <?php  endif;?>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="rate_type">दर </label>
                                         <input type="text" name="rate[]" value="<?php echo $ngd['rate']?>" class="form-control topic_fixed_rate" readonly="readonly" style="height: 30px;" tabindex="-1">
                                         <input type = "hidden" name="percent_rate" class="percent_rate">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="qty_title">परिमाण/रकम  </label>
                                        <input type="text" class="form-control topic_qty" placeholder="" name="qty[]" required="required" value="<?php echo $ngd['topic_qty']?>" style="height: 30px;" autocomplete="off" tabindex="-1">
                                        <span class="notifiy_percent" style="color:red"></span>
                                      </div>
                                    </div>

                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label class="">छुट रकम( %प्रतिशतमा ) </label>
                                        <input type="text" class="form-control discount_amount" placeholder="" name="discount_amount[]"  value="<?php echo !empty($ngd['discount_amount'])?$ngd['discount_amount']:0?>" style="height: 30px;">
                                      </div>
                                    </div>

                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label class="">जम्मा </label>
                                        <input type="text" class="form-control topic_rate " placeholder="" name="rates[]" required="required" value="<?php echo $ngd['t_rates']?>" style="height: 30px;" tabindex="-1">
                                      </div>
                                    </div>

                                   <!--  <div class="col-md-1">
                                      <div class="form-group">
                                       <a href="<?php //echo base_url()?>NagadiRasid/deleteItem/<?php //echo $ngd['id']?>" class="btn btn-danger">हटाउनुहोस्</a>
                                      </div>
                                    </div> -->
                                  </div>
                                </td>
                              </tr>
                            <?php endforeach;endif;?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                         <label class="">कुल जम्मा </label>
                         <input type="text" class="form-control t_total" placeholder="" name="t_total"  id= "t_total" required="required" readonly="readonly" tabindex="-1" value="<?php echo $erow['t_total']?>">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                         <label class="">लिएको रकम </label>
                         <input type="text" class="form-control recieved_amount" placeholder="" name="recieved_amount" required="required" value="<?php echo $erow['recieved_amount']?>">
                        </div>
                        <div class="rec_err"></div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                         <label class="">फिर्ता रकम </label>
                         <input type="text" class="form-control return_amount" placeholder="" name="return_amount" readonly="readonly">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <hr>
                      <button class="btn btn-primary btn-xs btn-save btn_save_nagadi" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit" id="btn_save_details"> सेभ गर्नुहोस्</button>
                      <a href="<?php echo base_url()?>NagadiRasid" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
                    </div>
                  </form>
              </div>
            </section>
        </div>
      </div>
      <!-- page end-->
    </section>
  </section>
  <script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
  <script type="text/javascript">
    $(".main_topic").select2();
    $(document).ready(function () {
        //add new fields
      $('#other_title').hide();
      $('.select_option').select2();
      $('.main_title').select2();
      $('.btnAddNew').click(function(e) {
        e.preventDefault();
        var trOneNew = $('.nagadi_rasid_frm').length+1;
        var new_row =  '<tr class="nagadi_rasid_frm"><td>'+
              '<div class ="row">'+
                  '<div class="col-md-4">'+
                    '<div class="form-group">'+
                      '<label class="">मुख्य शीर्षक </label>'+
                        '<select class="select_option form-control main_topic" name="main_topic_new[]" data-placeholder="मुख्य शीर्षक छनौट गर्नुहोस्" tabindex="0" required="required"><option value="">मुख्य शीर्षक छनौट गर्नुहोस्</option><?php if(!empty($main_topic)) : foreach ($main_topic as $key => $value) : ?><option value="<?php echo $value['id']?>"><?php echo $value['topic_name']?></option><?php endforeach;endif;?></select>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-4">'+
                    '<div class="form-group">'+
                        '<label class="">सहायक शीर्षक </label>'+
                        '<select class="select_option form-control sub_topic" name="sub_topic_new[]" required="required"></select>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-4">'+
                    '<label class="">शीर्षक </label>'+
                    '<select class="main_title " name = "main_title_new[]" required="required"></select>'+
                  '</div>'+
                  '<div class="col-md-4">'+
                    '<div class="form-group">'+
                      '<label class="">दर </label>'+
                        '<input type="text" name="rate_new[]" value="" class="form-control topic_fixed_rate" readonly="readonly" style="height: 30px;" tabindex="-1">'+
                        '<input type = "hidden" name="percent_rate" class="percent_rate">'+
                    '</div>'+
                   '</div>'+
                  '<div class="col-md-4">'+
                    '<div class="form-group">'+
                      '<label class="">परिमाण/रकम </label>'+
                      '<input type="text" class="form-control topic_qty" placeholder="" name="qty_new[]" required="required" value="" style="height: 30px;" autocomplete="off" tabindex="-1">'+
                      '<span class="notifiy_percent" style="color:red"></span>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-2">'+
                    '<div class="form-group">'+
                      '<label class="">छुट रकम( %प्रतिशतमा ) </label>'+
                      '<input type="text" class="form-control discount_amount" placeholder="" name="discount_amount_new[]"  value="" style="height: 30px;">'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-2">'+
                    '<div class="form-group">'+
                      '<label class="">जम्मा </label>'+
                      '<input type="text" class="form-control topic_rate " placeholder="" name="rates_new[]" required="required" id="total_rate_'+trOneNew+'" value="" style="height: 30px;" tabindex="-1">'+
                    '</div>'+
                   '</div>'+       
                  '</div>'+
                  '<div class="col-md-1">'+
                    '<div class="form-group">'+
                      '<button class="btn btn-danger btn-sm remove-row" data-id = "'+trOneNew+'">हटाउनुहोस्</button>'+
                    '</div>'+
                  '</div>';
                '</div>'+
              '</td></tr>'+
            
        $("#add_new_fields").append(new_row);
        $('.select_option').select2();
         $('.main_title').select2();
      });
      $("body").on("click",".remove-row", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
          var trOneNew = $('.nagadi_rasid_frm').length;
          // var amt  = $(this).parent().parent().parent().closest('tr').find('td').find('.topic_rate').val();
          //alert(id);
          //alert(trOneNew);
          var amt = $('#total_rate_'+id).val();
          //alert(amt);
          var t_amt = $('.t_total').val();
          var new_amt = t_amt-amt;
          $("#t_total").val(new_amt);
          $(this).parent().parent().parent().remove();
        }
      });

      $(document).on('click','#first_row_remove', function(){
        alert('यसलाई हटाउन सक्दैन');
      });

      $(document).on('change','.main_topic', function() {
        obj = $(this);
        var main_topic = obj.val();
        $.ajax({
          method:"POST",
          url:base_url+"NagadiRasid/getSubTopic",
          data: {main_topic:main_topic},
          success:function(resp) {
            if(resp.status == 'success') {
              obj.closest("tr").find(".sub_topic").html(resp.data);
              obj.closest("tr").find(".topic_rate ").val('');
              obj.closest("tr").find(".topic_fixed_rate ").val('');
              obj.closest("tr").find('.main_title ').html('<option value="">सहायक शीर्षक छान्नुहोस्</option>');
              $(".t_total ").val('');
              $(".recieved_amount ").val('');
            }
          }
        });
      });

      //on change subtopic return rate and default qty 1.
      // $(document).on('change','.sub_topic',function() {
      //   obj = $(this);
      //   var sub_topic = obj.val();
      //   var final_total = 0;
      //   $.ajax({
      //     method:"POST",
      //     url:base_url+"NagadiRasid/getSubTopicByID",
      //     data: {sub_topic:sub_topic},
      //     success:function(resp) {
      //       if(resp.status == 'success') {
      //         var ta = resp.data.rate*1;
      //         obj.closest("tr").find(".topic_qty").val(1);
      //         obj.closest("tr").find(".topic_fixed_rate").val(resp.data.rate)
      //         obj.closest("tr").find(".topic_rate").val(ta);

      //         $( ".topic_rate" ).each( function(){
      //           final_total += parseFloat( $( this ).val() ) || 0;
      //         });
      //         $('#t_total').val(final_total);

      //       }
      //     }
      //   });
      // });

      // $(document).on('input', '.topic_qty', function(){
      //   obj =$(this);
      //   var final_total = 0
      //   var qty = obj.val();
      //   var rate = obj.closest("tr").find('.topic_fixed_rate').val();
      //   trp = qty*rate;
      //   obj.closest("tr").find('.topic_rate').val(trp)
      //   $( ".topic_rate" ).each( function(){
      //     final_total += parseFloat( $( this ).val() ) || 0;
      //   });
      //   $('#t_total').val(final_total); 
      // });

      $(document).on('input', '.topic_qty', function(){
        obj =$(this);
        var final_total = 0
        var qty = obj.val();
        var rate = obj.closest("tr").find('.topic_fixed_rate').val();
        var is_percent = obj.closest("tr").find(".percent_rate").val();
        if(is_percent == 1) {
          var p = rate/100;
          var total = qty * p;
          obj.closest("tr").find('.topic_rate').val(total)
         
        } else {
          trp = qty*rate;
          obj.closest("tr").find('.topic_rate').val(trp)
        }
        $( ".topic_rate" ).each( function(){
          final_total += parseFloat( $( this ).val() ) || 0;
        });
        $('#t_total').val(final_total); 
      });


      $(document).on('input','.recieved_amount', function()  {
        
        obj = $(this);
        var rec_amount = obj.val();
        var t_total = $('.t_total').val();
        var return_amount = rec_amount -t_total;
        $('.return_amount').val(return_amount);
        
      });

      $(document).on('click','#btn_save_details', function(){
          var rec_amount = $('.recieved_amount').val();
          rec_amount = rec_amount.toFixed(2);
          var t_total = $('.t_total').val();
          var return_amount = rec_amount-t_total;
          if(rec_amount < t_total) {
            $('.rec_err').html('<div class="alert alert-danger">प्राप्त रकम कुल रकम भन्दा कम हुन सक्दैन</div>');
            return false;
          } else {
            $('.rec_err').empty();
          }
          $('.return_amount').val(return_amount);
      });

      //subtopic change
      $(document).on('change','.sub_topic', function(){
        obj = $(this);
        var subtopic = obj.val();
        $.ajax({
          method:"POST",
          url:base_url+"NagadiRasid/getTopicRate",
          data: {subtopic:subtopic},
          success:function(resp) {
            if(resp.status == 'success') {
              obj.closest("tr").find(".main_title").html(resp.data);
            }
          }
        });
      });


      // $(document).on('change', '.main_title', function(){
      //   obj = $(this);
      //   var topic_rate = obj.val();
      //  // alert(topic_rate);
      //   $.ajax({
      //     method:"POST",
      //     url:base_url+"NagadiRasid/getTopicRateDetails",
      //     data: {topic_rate:topic_rate},
      //     success:function(resp) {
      //       console.log(resp.data);
      //       if(resp.status == 'success') {
      //         if(resp.data !=null && resp.data.is_percent == 1) {
      //           obj.closest("tr").find(".rate_type").text('प्रतिशत ');
      //           obj.closest("tr").find(".qty_title").text('रकम');
      //           obj.closest("tr").find(".percent_rate").val(1);
      //           obj.closest("tr").find(".topic_fixed_rate").val(resp.data.rate);
      //           obj.closest("tr").find(".topic_qty").val(0);
      //           obj.closest("tr").find(".topic_rate").val(0);
      //           obj.closest("tr").find(".notifiy_percent").text('कृपया रकम प्रविष्ट गर्नुहोस्');
      //           $('.btn_save_nagadi').attr('disabled');
      //         } else {
      //           obj.closest("tr").find(".rate_type").text('दर/रकम');
      //           obj.closest("tr").find(".topic_fixed_rate").val(resp.data.rate);
      //           obj.closest("tr").find(".topic_qty").val(0);
      //           obj.closest("tr").find(".topic_rate").val(resp.data.rate);
      //           $('.t_total').val(resp.data.rate);
      //            obj.closest("tr").find(".notifiy_percent").text('');
      //         }
             
      //         var sum = 0;
      //         $(".topic_rate ").each(function(){
      //             sum += +$(this).val();
      //         });
      //         $(".t_total").val(sum);

      //       }
      //     }
      //   });
      // });

      $(document).on('change', '.main_title', function(){
        obj = $(this);
        var topic_rate = obj.val();
        if(topic_rate == "others") {
          obj.closest("tr").find('.other_title_section').show();
          obj.closest("tr").find('.other_title').attr('required', true);
          obj.closest("tr").find('.other_title').val('');
          obj.closest("tr").find('.topic_fixed_rate').removeAttr('readonly');
        } else {
          $.ajax({
            method:"POST",
            url:base_url+"NagadiRasid/getTopicRateDetails",
            data: {topic_rate:topic_rate},
            success:function(resp) {
              if(resp.status == 'success') {
                if(resp.data.is_percent == 1) {
                  obj.closest("tr").find('.other_title').attr('required', false);
                  obj.closest("tr").find('.other_title_section').hide();
                  obj.closest("tr").find(".rate_type").text('प्रतिशत ');
                  obj.closest("tr").find(".qty_title").text('रकम');
                  obj.closest("tr").find(".percent_rate").val(1);
                  obj.closest("tr").find(".topic_fixed_rate").val(resp.data.rate);
                  obj.closest("tr").find(".topic_qty").val(0);
                  obj.closest("tr").find(".topic_rate").val(0);
                  obj.closest("tr").find(".notifiy_percent").text('कृपया रकम प्रविष्ट गर्नुहोस्');
                  $('.btn_save_nagadi').attr('disabled');
                } else {
                  obj.closest("tr").find('.other_title_section').hide();
                  obj.closest("tr").find('.other_title').attr('required', false);
                  obj.closest("tr").find(".rate_type").text('दर/रकम');
                  obj.closest("tr").find(".topic_fixed_rate").val(resp.data.rate);
                  obj.closest("tr").find(".topic_qty").val(1);
                  obj.closest("tr").find(".percent_rate").val(0);

                  obj.closest("tr").find(".topic_rate").val(resp.data.rate);
                  obj.closest("tr").find('.qty_title').text('परिमाण/रकम');
                  $('.t_total').val(resp.data.rate);
                   obj.closest("tr").find(".notifiy_percent").text('');
                }
               
                var sum = 0;
                $(".topic_rate ").each(function(){
                    sum += +$(this).val();
                });

                // sum other total value to net total

                other_final_total_amount = 0;
                $( ".other_topic_rate" ).each( function(){
                  other_final_total_amount += parseFloat( $( this ).val() ) || 0;
                });
                var net_total = sum + other_final_total_amount;
                $(".t_total").val(net_total.toFixed(2));

              }
            }
          });
        }
      });

      $(document).on('input','.topic_fixed_rate', function(){
        obj = $(this);
        var topic_fixed_rate = obj.val();
        var final_total = 0;
        var qty = obj.closest("tr").find('.topic_qty').val();
        var total = qty * topic_fixed_rate;
        obj.closest("tr").find(".topic_rate").val(total.toFixed(2));
        var sum = 0;
        $(".topic_rate ").each(function(){
            sum += +$(this).val();
        });
        $(".t_total").val(sum.toFixed(2));
      });



      $(document).on('change', '.npl_state', function() {
        obj = $(this);
        var state = obj.val();
        var name = $('#land_owner_name_en').val();
        var ganapa = $('.lo_gapanapa').val();
        var ward = $('.address_ward').val();
        $.ajax({
          url:base_url+'PersonalProfile/getDistrictByState',
          method:"POST",
          data:{state:state, name:name,gapana:ward,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
          success : function(resp){
            if(resp.status == 'success') {
              $('.npl_districts').html(resp.option);
            }
          }
        });
      });
      
      $(document).on('change', '.npl_districts', function() {
        obj = $(this);
        var district = obj.val();

        $.ajax({
          url:base_url+'PersonalProfile/getGapanapaByDistricts',
          method:"POST",
          data:{district:district,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
          success : function(resp){
            if(resp.status == 'success') {
              $('.npl_gapana').html(resp.option);
            }
          }
        });
      });


      $(document).on('input', '.discount_amount', function(){
        obj =$(this);
        var final_total = 0
        var discount = obj.val();

        var qty = obj.closest("tr").find('.topic_qty').val();
        var rate = obj.closest("tr").find('.topic_fixed_rate').val();
        var is_percent = obj.closest("tr").find(".percent_rate").val();
       // alert(qty);
        if(is_percent == 1) {
          // alert(is_percent);
          var p = rate/100;
          var total = qty * p;
          discount_calc = discount/100 * total;
          total_rate =  total - discount_calc;
          obj.closest("tr").find('.topic_rate').val(total_rate.toFixed(2));
         
         } else {
          trp = qty*rate;
          discount_calc = discount/100 * trp;
          //alert(discount_calc);
          total_rate =  trp - discount_calc;
          obj.closest("tr").find('.topic_rate').val(total_rate.toFixed(2))
         }
        $( ".topic_rate" ).each( function(){
          final_total += parseFloat( $( this ).val() ) || 0;
        });
        //var net_total = final_total + other_final_total_amount;
        $('#t_total').val(final_total.toFixed(2));
      });


      $("#quantity").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          //display error message
          $("#errmsg").html("Digits Only").show().fadeOut("slow");
          return false;
        }
      });
      // $(document).on('change', '.main_title', function(){
      //   obj = $(this);
      //   var topic_rate = obj.val();
      //  // alert(topic_rate);
      //   $.ajax({
      //     method:"POST",
      //     url:base_url+"NagadiRasid/getTopicRateDetails",
      //     data: {topic_rate:topic_rate},
      //     success:function(resp) {
      //      // console.log(resp.data);
      //       if(resp.status == 'success') {
      //         obj.closest("tr").find(".topic_fixed_rate").val(resp.data.rate);
      //         obj.closest("tr").find(".topic_qty").val(1);
      //         obj.closest("tr").find(".topic_rate").val(resp.data.rate);
      //         $('.t_total').val(resp.data.rate);
      //         var sum = 0;
      //         $(".topic_rate ").each(function(){
      //             sum += +$(this).val();
      //         });
      //         $(".t_total").val(sum);

      //       }
      //     }
      //   });
      // });

    });//end dom
  </script>
  