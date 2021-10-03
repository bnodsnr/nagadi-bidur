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
            शिर्षक थप्नुहोस्
          </header>
          <div class="card-body">
            <form action="<?php echo base_url()?>SetTitle/saveNewTopicDetails" method="post" class="form">
                 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                    <!-- <select class="form-control set_fiscal_year_frm" name="fiscal_year" id = "set_fiscal_year_frm">
                      <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                      <?php
                      if(!empty($fiscal_year)) : 
                        foreach ($fiscal_year as $key => $value) : ?>
                          <option value="<?php echo $value['year']?>" <?php if($value['year'] ==$this->session->userdata('add_fiscal_year')){ echo 'selected';} ?>><?php echo $value['year']?></option>
                        <?php endforeach;endif?>
                      </select> -->
                      <input type="text" class="form-control" name="fiscal_year" required="required" value="<?php echo current_fiscal_year()?>" readonly>
                  </div>
                </div>
                <!-- <div class="col-md-6">
                  <div class="form-group">
                    <label>मुख्य शिर्षक नं<span style="color:red">*</span></label>
                    <input type="number" class="form-control" placeholder=""  name="topic_no" required="required" value="">
                  </div>
                </div> -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>मुख्य शिर्षक <span style="color:red">*</span></label>
                   <!--  <input type="text" class="form-control" placeholder=""  name="main_topic" required="required" value=""> -->
                   <div class="input-group">
                          <div class="input-group-prepend">
                            <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="मुख्य शिर्षक किसिम थप्नुहोस्" data-url="<?php echo base_url()?>SetTitle/addMainTopic"><i class="fa fa-plus"></i></button>
                          </div>
                          <select class="form-control" name="main_topic" id = "" required="required">
                            <option value="">मुख्य शिर्षक गर्नुहोस्</option>
                            <?php
                            $selected = '';
                            if(!empty($row['id'])) {
                              $selected = $row['land_area_type'];
                            }
                            if(!empty($main_topic)) : 
                              foreach ($main_topic as $key => $type) : ?>
                                <option value="<?php echo $type['id']?>" 
                                  <?php 
                                  if(!empty($row['id'])) {
                                    if($row['land_area_type'] == $type['id']) {
                                      echo 'selected';
                                    }
                                  } ?>
                                  >
                                  <?php echo $type['topic_name'].'-'.$type['topic_no']?></option>
                                <?php endforeach;endif?>
                              </select>
                            </div>
                  </div>
                </div>
                <table class="table" id="add_new_subtopic">
                  <thead>
                    <tr>
                      <th>शिर्षक </th>
                      <th> <button type="button" class="btn btn-primary btnAddNew btn-sm"><i class="fa fa-plus"></i> नयाँ थप्नुहोस्</button></th>
                    </tr>
                  </thead>
                  <tr>
                    <td>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder=""  name="sub_topic[]" required="required" value="">
                      </div>
                    </td>
                    <td style="width:217px;">
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title=""><span class="fa fa-times" tabindex="-1"></span> हटाउनुहोस्</button>
                    </td>
                  </tr>
                </table>
              </div>
              <hr>
              <div class="col-md-12 text-center">
                <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
                <a href="<?php echo base_url()?>SetTitle" class="btn btn-danger btn-xs" data-toggle="tooltip" title="रद्द गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</a>
              </div>
            </form>
          </div>
        </section>
      </div>
      <!-- page end-->
    </section>
  </section>

  <script type="text/javascript">
    $(document).ready(function() {
      //add new row
      $('.btnAddNew').click(function(e) {
        e.preventDefault();
        var trOneNew = $('.nagadi_rasid_frm').length+1;
        var new_row = 
        '<tr>'+
          '<td><input type="text" name="sub_topic[]" value="" class="form-control" required>'+
        '</td>'+
        '<td style="width:217px;">'+
            '<button type="button" class="btn btn-danger btn-sm remove-row" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-times" tabindex="-1"></span> हटाउनुहोस्</button>'
          '</td>'+
        '<tr>'

        $("#add_new_subtopic").append(new_row);
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

    });
  </script>