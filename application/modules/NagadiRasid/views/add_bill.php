<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">गृहपृष्ठमा जानुहोस</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>NagadiRasid">नगदी रशिद सूचीमा जानुहोस</a></li>
        <li class="breadcrumb-item"><a href="javascript:;"> नयाँ थप्नुहोस् </a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <section class="card">
          <header class="card-header" style="background: #1b5693;color:#FFF">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            नगदी रशिद
          </header>
          <div class="card-body">

            <?php if ($this->session->flashdata('MSG_WARNING')) { ?>
              <div class="alert alert-warning"><?php echo $this->session->flashdata('MSG_WARNING'); ?></div>
            <?php } ?>

            <?php $success_message = $this->session->flashdata("MSG_ERR");
            if (!empty($success_message)) { ?>
              <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span> <?php echo $success_message; ?> </span>
              </div>
            <?php } ?>
            <form role="form" action="<?php echo base_url() ?>NagadiRasid/saveNagadiRasid" method="post" class="save_post">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>करदाताको विवरण प्रविष्ट गर्नुहोस्</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="">प्रदेश </label>
                                <!--<input type="text" class="form-control" name="pradesh" value="<?php //echo STATENAME
                                                                                                  ?>" readonly="readonly" tabindex="-1">-->
                                <select class="form-control dd_select npl_state" name="pradesh" required id="province">
                                  <option value="">छान्नुहोस्</option>
                                  <?php if (!empty($provinces)) :
                                    foreach ($provinces as $key => $p) : ?>
                                      <option value="<?php echo $p['ID'] ?>" <?php if ($p['ID'] == STATE) {
                                                                                echo 'selected';
                                                                              } ?>><?php echo $p['Title'] ?></option>
                                  <?php endforeach;
                                  endif; ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="">जिल्ला</label>
                                <!--<input type="text" class="form-control" name="" value="<?php //echo DISTRICT
                                                                                            ?>" readonly="readonly" tabindex="-1">-->
                                <!--<input type="hidden" class="form-control" name="district" value="<?php //echo DID
                                                                                                      ?>" readonly="readonly" tabindex="-1">-->
                                <select class="form-control dd_select npl_districts" id="district" required name="district">
                                  <option value=""></option>
                                  <?php if (!empty($districts)) :
                                    foreach ($districts as $d) : ?>
                                      <option value="<?php echo $d['id'] ?>" <?php if ($d['id'] == DID) {
                                                                                echo 'selected';
                                                                              } ?>><?php echo $d['name'] ?></option>
                                  <?php endforeach;
                                  endif; ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="">ग.पा / न. पा
                                </label>
                                <!-- <select class=" form-control select_option" name="gaunpalika_nagarpalika">-->
                                <!--   //if(!empty($gapana)) : -->
                                <!--    //foreach ($gapana as $key => $gn) : ?>-->
                                <!--      <option value="<?php //echo $gn['id']
                                                          ?>" <?php //if($userdetails->gapa_napa == $gn['id']){ echo 'selected';}
                                                              ?>><?php //echo $gn['name']
                                                                  ?></option>-->
                                <!--    <?php //endforeach;endif;
                                        ?>-->
                                <!--</select>-->
                                <select class="form-control npl_gapana dd_select select_option" name="gaunpalika_nagarpalika" id="metro" required>
                                  <?php if (!empty($gapana)) :
                                    foreach ($gapana as $key => $gp) : ?>
                                      <option value="<?php echo $gp['id'] ?>" <?php if ($gp['id'] == GID) {
                                                                                echo 'selected';
                                                                              } ?>><?php echo $gp['name'] ?></option>
                                  <?php endforeach;
                                  endif; ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="">वडा </label>
                                <select class="select_option form-control" name="ward_no">
                                  <?php if (!empty($wards)) :
                                    foreach ($wards as $key => $w) : ?>
                                      <option value="<?php echo $w['name'] ?>" <?php if ($this->session->userdata['PRJ_USER_WARD'] == $w['name']) {
                                                                                  echo 'selected';
                                                                                } ?>><?php echo $this->mylibrary->convertedcit($w['name']) ?></option>
                                  <?php endforeach;
                                  endif; ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-2">
                              <div class="form-group">
                                <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="" name="fiscal_year" required="required" value="<?php echo $current_fy['year'] ?>" readonly="readonly">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label>मिति <span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="" name="date" required="required" value="<?php echo convertDate(date('Y-m-d')) ?>" readonly="readonly">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <?php
                                // if($bill > $bill_range['bill_to']) {
                                //   $b  = '';
                                // } else {
                                //   $b = $bill;
                                // }
                                ?>
                                <label> रशिद नं <span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="" name="bill_no" required="required" readonly="readonly" value="<?php echo $bill ?>" tabindex="-1">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label> करदातको नाम <span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="" name="customer_name" required="required" value="" tabindex="1" autofocus>
                              </div>
                            </div>

                            <div class="col-md-2">
                              <div class="form-group">
                                <label> स्थायी लेखा नं </label>
                                <input type="text" class="form-control pan_no number_field" placeholder="" name="pan_no" value="">
                                <div id="num_err"></div>
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
                    <thead>
                      <tr>
                        <th>बिल विवरण प्रविष्ट गर्नुहोस् <button class="btn btn-secondary btnAddNew pull-right" data-toggle="tooltip" title=" नयाँ थप्नुहोस्" tabindex="-1"><i class="fa fa-plus"> </i> नयाँ थप्नुहोस् </button></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($main_topic)) : ?>
                        <tr class="nagadi_rasid_frm">
                          <td>
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="">मुख्य शीर्षक </label>
                                  <select class="main_topic" name="main_topic[]" data-placeholder="मुख्य शीर्षक छनौट गर्नुहोस्" tabindex="0" required="required">
                                    <option value="">मुख्य शीर्षक छनौट गर्नुहोस्</option>
                                    <?php if (!empty($main_topic)) :
                                      foreach ($main_topic as $key => $value) : ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['topic_name'] ?></option>
                                    <?php endforeach;
                                    endif; ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="">सहायक शीर्षक </label>
                                  <select class="select_option sub_topic" name="sub_topic[]" data-placeholder="" tabindex="1" required="required">
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <label class=""> शीर्षक </label>
                                <select class="main_title" name="main_title[]" required="required">
                                </select>
                              </div>
                              <div class="col-md-4 other_title_section" id="other_title">
                                <div class="form-group">
                                  <label class="">अन्य शीर्षक</label>
                                  <input type="text" name="other_title[]" value="" class="form-control other_title" style="height: 30px;">
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="rate_type">दर/रकम</label>
                                  <input type="text" name="rate[]" value="" class="form-control topic_fixed_rate number_field" readonly="readonly" style="height: 30px;">
                                  <input type="hidden" name="percent_rate" class="percent_rate">
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="qty_title">परिमाण/रकम </label>
                                  <input type="text" class="form-control topic_qty decimal_field" placeholder="" name="qty[]" value="" style="height: 30px;" autocomplete="off" required="required">
                                  <span class="notifiy_percent" style="color:red"></span>
                                </div>
                              </div>


                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="">छुट रकम( %प्रतिशतमा ) </label>
                                  <input type="text" class="form-control discount_amount number_field" placeholder="" name="discount_amount[]" value="" style="height: 30px;">
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="">जम्मा </label>
                                  <input type="text" class="form-control topic_rate " placeholder="" name="rates[]" value="" style="height: 30px;" required="required">
                                </div>
                              </div>

                            </div>
                          </td>
                        </tr>
                      <?php else : ?>
                        <tr>
                          <td colspan="4">
                            <div class="alert alert-danger">आनुसुचि भेटिएन</div>
                          </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="">कुल जम्मा </label>
                    <input type="text" class="form-control t_total" placeholder="" name="t_total" id="t_total" required="required" readonly="readonly" tabindex="-1">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="">लिएको रकम </label>
                    <input type="text" class="form-control recieved_amount decimal_field" placeholder="" name="recieved_amount" required="required">
                  </div>
                  <div class="num_err"></div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="">फिर्ता रकम </label>
                    <input type="text" class="form-control return_amount" placeholder="" name="return_amount" readonly="readonly">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="">प्राप्तीकाे माध्यम </label>
                    <select class="form-control" name="payment_mode">
                      <option value="1">नगद</option>
                      <option value="2">चेक</option>
                    </select>
                  </div>
                </div>

              </div>
              <div class="col-md-12 text-center">
                <!-- <div id="floatingBarsG" style="display: none;">
                                <div class="blockG" id="rotateG_01"></div>
                                <div class="blockG" id="rotateG_02"></div>
                                <div class="blockG" id="rotateG_03"></div>
                                <div class="blockG" id="rotateG_04"></div>
                                <div class="blockG" id="rotateG_05"></div>
                                <div class="blockG" id="rotateG_06"></div>
                                <div class="blockG" id="rotateG_07"></div>
                                <div class="blockG" id="rotateG_08"></div>
                              </div> -->
                <hr>
                <button class="btn btn-secondary btn-block btn-save save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit" id="btn_save_details"> सेभ गर्नुहोस्</button>
                <!-- <a href="<?php //echo base_url()
                              ?>NagadiRasid" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a> -->
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
</section>
<script type="text/javascript" src="<?php echo base_url() ?>assets/assets/select2/js/select2.min.js"></script>
<script type="text/javascript">
  $(".main_topic").select2();
  $(document).ready(function() {
    // $('.btn_save_nagadi').click(function()) {
    //   $(this).attr("disabled", true);
    // }

    $('#other_title').hide();
    //add new fields
    $('.select_option').select2();
    $('.main_title').select2();
    var count = 0;
    $('.btnAddNew').click(function(e) {
      if (count < 3) {
        e.preventDefault();
        var trOneNew = $('.nagadi_rasid_frm').length + 1;
        var new_row = '<tr class="nagadi_rasid_frm"><td>' +
          '<div class ="row">' +
          '<div class="col-md-4">' +
          '<div class="form-group">' +
          '<label class="">मुख्य शीर्षक </label>' +
          '<select class="select_option form-control main_topic" name="main_topic[]" data-placeholder="मुख्य शीर्षक छनौट गर्नुहोस्" tabindex="0" required="required"><option value="">मुख्य शीर्षक छनौट गर्नुहोस्</option><?php if (!empty($main_topic)) : foreach ($main_topic as $key => $value) : ?><option value="<?php echo $value['id'] ?>"><?php echo $value['topic_name'] ?></option><?php endforeach;
                                                                                                                                                                                                                                                                                                                                                                                          endif; ?></select>' +
          '</div>' +
          '</div>' +
          '<div class="col-md-4">' +
          '<div class="form-group">' +
          '<label class="">सहायक शीर्षक </label>' +
          '<select class="select_option form-control sub_topic" name="sub_topic[]" required="required"></select>' +
          '</div>' +
          '</div>' +
          '<div class="col-md-4">' +
          '<label class="">शीर्षक </label>' +
          '<select class="main_title " name = "main_title[]" required="required"></select>' +
          '</div></div>' +
          '<div class="row other_space_section">' +

          '<div class="col-md-4 other_title_section" id="other_title_' + trOneNew + '">' +
          '<div class="form-group">' +
          '<label class="">अन्य शीर्षक</label>' +
          '<input type="text" name="other_title[]" value="" class="form-control other_title" style="height: 30px;">' +
          '</div>' +
          '</div>' +

          '<div class="col-md-4">' +
          '<div class="form-group">' +
          '<label class="rate_type">दर </label>' +
          '<input type="text" name="rate[]" value="" class="form-control topic_fixed_rate" readonly="readonly" style="height: 30px;" tabindex="-1">' +
          '<input type = "hidden" name="percent_rate" class="percent_rate">' +
          '</div>' +
          '</div>' +

          '<div class="col-md-4">' +
          '<div class="form-group">' +
          '<label class="qty_title">परिमाण/रकम</label>' +
          '<input type="text" class="form-control topic_qty decimal_field" placeholder="" name="qty[]" value="" style="height: 30px;" autocomplete="off" tabindex="-1" required="required">' +
          '<span class="notifiy_percent" style="color:red"></span>' +
          '</div>' +
          '</div>' +

          '<div class="col-md-2">' +
          '<div class="form-group">' +
          '<label class="">छुट रकम( %प्रतिशतमा ) </label>' +
          '<input type="text" class="form-control discount_amount" placeholder="" name="discount_amount[]"  value="" style="height: 30px;">' +
          '</div>' +
          '</div>' +

          '<div class="col-md-2">' +
          '<div class="form-group">' +
          '<label class="">जम्मा </label>' +
          '<input type="text" class="form-control topic_rate " placeholder="" name="rates[]" id="total_rate_' + trOneNew + '" value="" style="height: 30px;" tabindex="-1" required="required">' +
          '</div>' +
          '</div>' +
          '</div>' + //end not other section
          '<div class="col-md-1 pull-right">' +
          '<div class="form-group">' +
          '<button class="btn btn-danger btn-sm remove-row" data-id = "' + trOneNew + '">हटाउनुहोस्</button>' +
          '</div>' +
          '</div>' +

          '</div>' +

          '</td></tr>';

        $("#add_new_fields").append(new_row);
        $('.select_option').select2();
        $('.main_title').select2();
        $('#other_title_' + trOneNew).hide();
        count++;
      } else {
        alert('एउटा बिलमा केवल तीन विवरणहरू');
        return;
      }
    });


    $("body").on("click", ".remove-row", function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
        var trOneNew = $('.nagadi_rasid_frm').length;

        var amt = $('#total_rate_' + id).val();
        var other_amt = $('.topic_qty' + id).val();
        var t_amt = $('.t_total').val();
        //alert(t_amt);
        var new_amt = t_amt - amt
        $("#t_total").val(new_amt.toFixed(2));
        $(this).parent().parent().parent().remove();
      }
    });

    $(document).on('click', '#first_row_remove', function() {
      alert('यसलाई हटाउन सक्दैन');
    });

    $(document).on('change', '.main_topic', function() {
      obj = $(this);
      var main_topic = obj.val();
      $.ajax({
        method: "POST",
        url: base_url + "NagadiRasid/getSubTopic",
        data: {
          main_topic: main_topic
        },
        success: function(resp) {
          if (resp.status == 'success') {
            obj.closest("tr").find(".sub_topic").html(resp.data);
          }
        }
      });
    });

    $(document).on('input', '.topic_qty', function() {
      obj = $(this);
      var final_total = 0
      var qty = obj.val();
      var rate = obj.closest("tr").find('.topic_fixed_rate').val();
      var is_percent = obj.closest("tr").find(".percent_rate").val();
      if (is_percent == 1) {
        var p = rate / 100;
        var total = qty * p;
        obj.closest("tr").find('.topic_rate').val(total.toFixed(2));

      } else {
        trp = qty * rate;
        obj.closest("tr").find('.topic_rate').val(trp.toFixed(2))
      }
      $(".topic_rate").each(function() {
        final_total += parseFloat($(this).val()) || 0;
      });

      // other_final_total_amount = 0;
      // $( ".other_topic_rate" ).each( function(){
      //   other_final_total_amount += parseFloat( $( this ).val() ) || 0;
      // });

      //var net_total = final_total + other_final_total_amount;
      $('#t_total').val(final_total.toFixed(2));
    });

    $(document).on('input', '.topic_fixed_rate', function() {
      obj = $(this);
      var topic_fixed_rate = obj.val();
      var final_total = 0;
      var qty = obj.closest("tr").find('.topic_qty').val();
      var total = qty * topic_fixed_rate;
      obj.closest("tr").find(".topic_rate").val(total.toFixed(2));
      var sum = 0;
      $(".topic_rate ").each(function() {
        sum += +$(this).val();
      });
      $(".t_total").val(sum.toFixed(2));
    });

    $(document).on('input', '.recieved_amount', function() {

      obj = $(this);
      var rec_amount = obj.val();
      var t_total = $('.t_total').val();
      var return_amount = rec_amount - t_total;
      $('.return_amount').val(return_amount.toFixed(2));

    });

    $(document).on('click', '#btn_save_details', function() {
      var rec_amount = $('.recieved_amount').val();
      var t_total = $('.t_total').val();
      var return_amount = rec_amount - t_total;
      if (parseFloat(t_total.toFixed(2)) > parseFloat(rec_amount.toFixed(2))) {
        $('.rec_err').html('<div class="alert alert-danger">प्राप्त रकम कुल रकम भन्दा कम हुन सक्दैन</div>');
        return false;
      } else {
        $('.rec_err').empty();
      }
      $('.return_amount').val(return_amount);
    });

    //subtopic change
    $(document).on('change', '.sub_topic', function() {
      obj = $(this);

      var subtopic = obj.val();
      //alert(subtopic);
      $.ajax({
        method: "POST",
        url: base_url + "NagadiRasid/getTopicRate",
        data: {
          subtopic: subtopic
        },
        success: function(resp) {
          if (resp.status == 'success') {
            obj.closest("tr").find(".main_title").html(resp.data);
          }
        }
      });
    });


    $(document).on('change', '.main_title', function() {
      obj = $(this);
      var topic_rate = obj.val();
      if (topic_rate == "others") {
        obj.closest("tr").find('.other_title_section').show();
        obj.closest("tr").find('.other_title').attr('required', true);
        obj.closest("tr").find('.topic_fixed_rate').attr('required', true);
        obj.closest("tr").find('.topic_fixed_rate').removeAttr('readonly');
      } else {
        $.ajax({
          method: "POST",
          url: base_url + "NagadiRasid/getTopicRateDetails",
          data: {
            topic_rate: topic_rate
          },
          success: function(resp) {
            if (resp.status == 'success') {
              if (resp.data.is_percent == 1) {
                obj.closest("tr").find('.other_title').attr('required', false);
                obj.closest("tr").find('.other_title_section').hide();
                obj.closest("tr").find(".rate_type").text('प्रतिशत ');
                obj.closest("tr").find(".topic_fixed_rate").attr('readonly', false);
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
                obj.closest("tr").find(".topic_fixed_rate").attr('readonly', true);
                obj.closest("tr").find(".topic_rate").val(resp.data.rate);
                obj.closest("tr").find('.qty_title').text('परिमाण/रकम');
                $('.t_total').val(resp.data.rate);
                obj.closest("tr").find(".notifiy_percent").text('');
              }

              var sum = 0;
              $(".topic_rate ").each(function() {
                sum += +$(this).val();
              });

              // sum other total value to net total

              other_final_total_amount = 0;
              $(".other_topic_rate").each(function() {
                other_final_total_amount += parseFloat($(this).val()) || 0;
              });
              var net_total = sum + other_final_total_amount;
              $(".t_total").val(net_total.toFixed(2));

            }
          }
        });
      }
    });

    $(document).on('input', '.other_rate', function() {
      obj = $(this);
      var topic_rate = obj.val();
      var topic_qty = obj.closest("tr").find('.other_topic_qty').val();
      var total_rate = topic_rate * topic_qty;
      obj.closest("tr").find('.other_topic_rate').val(total_rate.toFixed);

      other_final_total_amount = 0;
      $(".other_topic_rate").each(function() {
        other_final_total_amount += parseFloat($(this).val()) || 0;
      });

      var sum = 0;
      $(".topic_rate ").each(function() {
        sum += +$(this).val();
      });
      var net_total = sum + other_final_total_amount;
      $('#t_total').val(net_total.toFixed(2));
    });


    $(document).on('input', '.other_topic_qty', function() {
      obj = $(this);
      var other_final_total = 0;
      var final_total = 0;
      var qty = obj.val();
      var other_rate = obj.closest("tr").find('.other_rate').val();
      var other_total_value = qty * other_rate;
      var rate = obj.closest("tr").find('.other_topic_rate').val(other_total_value.toFixed(2));

      other_final_total_amount = 0;
      $(".other_topic_rate").each(function() {
        other_final_total_amount += parseFloat($(this).val()) || 0;
      });
      //$('#t_total').val(other_final_total_amount); 

      $(".topic_rate").each(function() {
        final_total += parseFloat($(this).val()) || 0;
      });

      var net_total = other_final_total + final_total;
      $('#t_total').val(net_total.toFixed(2));
    });

    $(document).on('change', '.npl_state', function() {
      obj = $(this);
      var state = obj.val();
      var name = $('#land_owner_name_en').val();
      var ganapa = $('.lo_gapanapa').val();
      var ward = $('.address_ward').val();
      $.ajax({
        url: base_url + 'PersonalProfile/getDistrictByState',
        method: "POST",
        data: {
          state: state,
          name: name,
          gapana: ward,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        success: function(resp) {
          if (resp.status == 'success') {
            $('.npl_districts').html(resp.option);
          }
        }
      });
    });

    $(document).on('change', '.npl_districts', function() {
      obj = $(this);
      var district = obj.val();
      $.ajax({
        url: base_url + 'PersonalProfile/getGapanapaByDistricts',
        method: "POST",
        data: {
          district: district,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        success: function(resp) {
          if (resp.status == 'success') {
            $('.npl_gapana').html(resp.option);
            $('#lo_owner_symbol').val('');
          }
        }
      });
    });


    $(document).on('input', '.discount_amount', function() {
      obj = $(this);
      var final_total = 0
      var discount = obj.val();

      var qty = obj.closest("tr").find('.topic_qty').val();
      var rate = obj.closest("tr").find('.topic_fixed_rate').val();
      var is_percent = obj.closest("tr").find(".percent_rate").val();
      // alert(qty);
      if (is_percent == 1) {
        // alert(is_percent);
        var p = rate / 100;
        var total = qty * p;
        discount_calc = discount / 100 * total;
        total_rate = total - discount_calc;
        obj.closest("tr").find('.topic_rate').val(total_rate.toFixed(2));

      } else {
        trp = qty * rate;
        discount_calc = discount / 100 * trp;
        //alert(discount_calc);
        total_rate = trp - discount_calc;
        obj.closest("tr").find('.topic_rate').val(total_rate.toFixed(2))
      }
      $(".topic_rate").each(function() {
        final_total += parseFloat($(this).val()) || 0;
      });
      //var net_total = final_total + other_final_total_amount;
      $('#t_total').val(final_total.toFixed(2));
    });



    // $(".number_field").keypress(function (e) {
    //   //if the letter is not digit then display error and don't type anything
    //   if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //     //display error message
    //     $("#num_err").html("Digits Only").show().fadeOut("slow");
    //     return false;
    //   }
    // });


    // $('.btn_save_nagadi').click(function(e){
    //   $(this).prop('disabled', true);
    //  // e.preventDefault();
    // });
  }); //end dom
</script>