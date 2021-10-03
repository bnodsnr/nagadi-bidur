<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>SetTitle">शिर्षकको सूची</a></li>
        <li class="breadcrumb-item"><a href="javascript:;"> नयाँ थप्नुहोस् </a></li>
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
          <header class="card-header" style="background: #1b5693;color:#FFF">
           नगदी रशिद  शिर्षक थप्नुहोस्
           <!-- <button class="btn btn-danger btn-sm pull-right btnAddNew">नयाँ थप्नुहोस्</button> -->
          </header>
          <div class="card-body">
            <form role="form" action="<?php echo base_url()?>SetTitle/saveUpdateKarRateDetails" method="post">
                 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="id" value="<?php echo $topic_rate['id']?>">
              <div class="row">
                <table class="table table-bordered" id="add_new_fields">
                  <thead>
                    <tr>
                      <th>आर्थिक वर्ष</th>
                      <th>मुख्य शिर्षक</th>
                      <th>शिर्षकको नाम</th>
                      <th>शिर्षकको नाम</th>
                       <th>दर</th>
                      <th>यदि प्रतिशतमा भएमा मात्रै</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <select class="form-control set_fiscal_year_frm" name="fiscal_year" id = "set_fiscal_year_frm">
                          <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                          <?php
                            if(!empty($fiscal_year)) : 
                              foreach ($fiscal_year as $key => $value) : ?>
                                <option value="<?php echo $value['year']?>" <?php if($value['year'] ==$topic_rate['fiscal_year']){ echo 'selected';} ?>><?php echo $value['year']?></option>
                            <?php endforeach;endif?>
                        </select>
                      </td>
                      <td>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="मुख्य शिर्षक किसिम थप्नुहोस्" data-url="<?php echo base_url()?>SetTitle/addMainTopic"><i class="fa fa-plus"></i></button>
                          </div>
                          <select class="form-control parent_title" name="parent_title" id = "" required="required">
                            <option value="">गर्नुहोस्</option>
                            <?php
                           
                            if(!empty($main_topic)) : 
                              foreach ($main_topic as $key => $type) : ?>
                                <option value="<?php echo $type['id']?>" <?php if($topic_rate['parent_id'] == $type['id']){echo 'selected';}?>> 
                                  <?php echo $type['topic_name'].'-'.$type['topic_no']?></option>
                                <?php endforeach;endif?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <select class="form-control sub_topic" name="sub_topic">
                              <?php if(!empty($s_topic)) {
                                foreach ($s_topic as $key => $st) { ?>
                                  <option value="<?php echo $st['id']?>" <?php if($st['id'] == $topic_rate['sub_topic']){echo 'selected';}?>><?php echo $st['sub_topic']?></option>
                               <?php  } } ?>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="" name="topic_name" required="required" value="<?php echo $topic_rate['topic_title']?>">
                        </div>
                      </td>
                      <!-- <td>
                        <div class="form-group">
                            <label>शिर्षक नं<span style="color:red">*</span></label>
                            <input type="number" class="form-control" placeholder=""  name="topic_number" required="required" value="">
                          </div>
                      </td> -->
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder=""  name="rate" required="required" value="<?php if(!empty($topic_rate['id'])){ echo $topic_rate['rate'];} ?>">
                          
                        </div>
                      </td>

                      <td>
                        <div class="form-group">
                          <input type="checkbox" class="" placeholder=""  name="is_percent"  value="1" <?php if($topic_rate['is_percent'] == 1) {echo 'checked';}?>>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <div class="col-md-12 text-center">
                  <hr>
                  <button class="btn btn-primary btn-xs save_button" data-toggle="tooltip"
                    title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ
                    गर्नुहोस्</button>
                  <a href="<?php echo base_url()?>SetTitle" class="btn btn-danger btn-xs"
                        data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
                </div>
              </div>
            </form>
          </div>
        </section>
      </div>
      <!-- page end-->
    </section>
  </section>

  <script type="text/javascript">
    $(document).ready(function(){
      
      //add new row
      $('.btnAddNew').click(function(e) {
        e.preventDefault();
        var trOneNew = $('.nagadi_rasid_frm').length+1;
        var new_row = 
        '<tr>'+
          '<td><select class="form-control js-example-basic-single  " name="fiscal_year[]" data-placeholder="मुख्य शीर्षक छनौट गर्नुहोस्" id="main_topic'+trOneNew+'" data-id="'+trOneNew+'" required><option value="">मुख्य शीर्षक छनौट गर्नुहोस्</option><?php if(!empty($fiscal_year)) {
            foreach ($fiscal_year as $key => $fy) { ?><option value="<?php echo $fy['year']?>" <?php if($fy['is_current'] == 1){echo 'selected';}?>><?php echo $fy['year']?></option><?php } } ?></select></td>'+
          '<td><div class="input-group"><div class="input-group-prepend"><button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="मुख्य शिर्षक किसिम थप्नुहोस्" data-url="<?php echo base_url()?>SetTitle/addMainTopic"><i class="fa fa-plus"></i></button></div><select class="form-control parent_title" name="parent_title[]" id = "" required="required"><option value="">मुख्य शिर्षक गर्नुहोस्</option><?php $selected = '';
            if(!empty($row['id'])) {
              $selected = $row['land_area_type'];
            }
            if(!empty($main_topic)) : 
              foreach ($main_topic as $key => $type) : ?>
                <option value="<?php echo $type['id']?>" <?php 
                  if(!empty($row['id'])) {
                    if($row['land_area_type'] == $type['id']) {
                      echo 'selected';
                    }
                  } ?>
                  ><?php echo $type['topic_name'].'-'.$type['topic_no']?></option><?php endforeach;endif?>
              </select></div></div></div></td>'+

          '<td> <select class="form-control sub_topic" name="sub_topic[]"><option></option></select</td>'+
          '<td>'+
          '<input type="text" name="topic_name[]" value="" class="form-control" required>'+
          '</td>'+
          '<td>'+
          '<input type="text" name="rate[]" value="" class="form-control" required>'+
          '</td>'+
          '<td>'+
          '<input type="checkbox" class="" placeholder=""  name="is_percent[]"  value="1">'+
          '</td>'+
          '<td><button type="button" class="btn btn-danger btn-sm remove-row" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-times" tabindex="-1"></span></button></td>'+
          '<tr>'

          $("#add_new_fields").append(new_row);
          $('.main_topics-').select2();
        });
        $("body").on("click",".remove-row", function(e){
          e.preventDefault();
          
          if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
           var amt = $(this).closest("tr").find('.topic_rate').val();
           var t_amt = $('#t_total').val();
           var new_amt = t_amt-amt;
           $("#t_total").val(new_amt);
           $(this).parent().parent().remove();
          }
        });
        $(document).on('change','.parent_title', function() {
          obj = $(this);
          var main_topic = obj.val();
          $.ajax({
            method:"POST",
            url:base_url+"SetTitle/getSubTopic",
            data: {main_topic:main_topic},
            success:function(resp) {
              console.log(resp);
              if(resp.status == 'success') {
                obj.closest("tr").find(".sub_topic").html(resp.data);
              }
            }
          });
        });

    });
  </script>
  