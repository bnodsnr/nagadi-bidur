<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">जग्गा किन बेच </a></li>
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
              <header class="card-header">
               जग्गा किन बेच 
                <span class="tools">
                  <?php if($this->authlibrary->HasModulePermission('BUY-SELL', "ADD")) { ?>
                    <a href = "<?php echo base_url()?>BuySell/addNew" class=" btn btn-primary btn-sm pull-right" title=""><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                  <?php } ?>
                </span>
              </header>
              <div class="card-body">
                <form action ="<?php echo base_url()?>BuySell/save" method="post">
                  <div class="row">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>रेजिस्त्रसन नं<span style="color:red">*</span></label>
                        <input type="text" name="reg_no" value="" class="form-control" required="required">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गा दिनेको क्र.स नम्बर  <span style="color:red">*</span></label>
                        <select name="seller_file_no" class="from-control dd_select"
                          id="file_no" required>
                          <option value="">छान्नुहोस्</option>
                          <?php 
                            if(!empty($profile)) :
                            foreach ($profile as $key => $p) : ?>
                           <option value="<?php echo  $p['file_no']?>"><?php echo  $p['file_no']?></option>
                          <?php endforeach; endif;?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गाको कित्ता नं<span style="color:red">*</span></label>
                         <select name="jk_no" class="from-control dd_select"
                          id="kitta_no" required>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गा क्षेत्रफल<span style="color:red">*</span></label>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="text" name="total_land" class="form-control" id="total_land_area" readonly=""><span>वर्ग फुट</span>
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="j_ropani" class="form-control" id="j_ropani" readonly="">
                            <span>रोपनी</span>
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="j_aana" class="form-control" id="j_aana" readonly="">
                            <span>आना</span>
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="j_paisa" class="form-control" id="j_paisa" readonly="">
                            <span>पैसा</span>
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="j_dam" class="form-control" id="j_dam" readonly="">
                            <span>दाम</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>तोकिएको न्युनतम मुल्य(प्रति रोपनी) <span style="color:red">*</span></label>
                        <input type="text" name="minRate" class="form-control" id="min_land_rate" readonly="">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>कबुल गरेको मुल्य(प्रति रोपनी) <span style="color:red">*</span></label>
                        <input type="text" name="lkAmount" class="form-control" id="t_kubul_amount">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>मूल्याङ्कन रकम <span style="color:red">*</span></label>
                        <input type="text" name="tax_amount" class="form-control" id="t_rate">
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गा लिनेको  क्र.स नम्बर <span style="color:red">*</span>(<a href="<?php echo base_url()?>Profile/addLandOwnerDetails" target="_blank">नयाँ थप्नुहोस् </a>)</label>
                        <select name="buyer_file_no" class="from-control dd_select"
                          id="b_file_no" required>
                          <option value="">छान्नुहोस्</option>
                          <?php 
                            if(!empty($profile)) :
                            foreach ($profile as $key => $p) : ?>
                           <option value="<?php echo  $p['file_no']?>"><?php echo  $p['file_no']?></option>
                          <?php endforeach; endif;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>कित्ता नं<span style="color:red">*</span></label>
                        <input type="text" name="new_kitta_no" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>कबुल गरेको मुल्य(प्रति रोपनी)<span style="color:red">*</span></label>
                        <input type="text" name="new_k_amount" class="form-control" id="new_k_amount">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>क्षेत्रफल(
वर्ग फुट) <!-- [यदि पुरै भएमा <input type="checkbox" name="all_land" class="" id="all_land">] --><span style="color:red">*</span></label>
                       
                        <div class="row">

                          <div class="col-md-4">
                             <input type="text" name="n_land_area" class="form-control" id="new_area">
                            <span>वर्ग फुट</span>
                          </div>

                          <div class="col-md-2">
                            <input type="text" name="n_ropani" class="form-control" id="n_ropani" readonly="">
                            <span>रोपनी</span>
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="n_aana" class="form-control" id="n_aana" readonly="">
                            <span>आना</span>
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="n_paisa" class="form-control" id="n_paisa" readonly="">
                            <span>पैसा</span>
                          </div>
                          <div class="col-md-2">
                            <input type="text" name="n_dam" class="form-control" id="n_dam" readonly="">
                            <span>दाम</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गा दिनेको श्रेस्ताम घट जग्गा तथा  संरचना<span style="color:red">*</span></label>
                        <input type="text" name="r_area" class="form-control" id="r_area">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गा दिनेको घटने मूल्याङ्कन रकम<span style="color:red">*</span></label>
                        <input type="text" name="r_t_amount" class="form-control" id="r_t_amount">
                      </div>
                    </div>

                   <!--  <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गा लिनेको श्रेस्ताम घट जग्गा तथा  संरचना<span style="color:red">*</span></label>
                        <input type="text" name="new_kitta_no" class="form-control">
                      </div>
                    </div> -->


                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गा लिनेको मूल्याङ्कन रकम<span style="color:red">*</span></label>
                        <input type="text" name="new_tax_amount" class="form-control" id="n_t_amount">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>कैफियत<span style="color:red">*</span></label>
                        <textarea class="form-control" name="remarks"></textarea>
                       <!--  <input type="text" name="new_kitta_no" class="form-control"> -->
                      </div>
                    </div>
                    <hr>
                    <div class="col-md-12 text-center">
                      <button class="btn btn-primary btn-xs save_button" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ गर्नुहोस्</button>
                      <a href="<?php echo base_url()?>Setting/SadakKoKisim" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
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
  $(document).ready(function(){
    $('.dd_select').select2();
    $(document).on('change','#file_no', function(){
      obj = $(this);
      var file_no = obj.val();
      $.ajax({
        url:base_url+"BuySell/getLandOwnerDetails",
        type:"POST",
        data:{file_no:file_no},
        success:function(resp){
          if(resp.status == 'success') {
            $('#kitta_no').html(resp.data);
          }
        }
      });
    });

    $(document).on('change', '#kitta_no',function(){
      obj = $(this);
      var kitta_no = obj.val();
      $.ajax({
        url:base_url+"BuySell/getLandDetails",
        type:"POST",
        data:{kitta_no:kitta_no},
        success:function(resp){
          if(resp.status == 'success') {
            console.log(resp);
            $('#total_land_area').val(resp.data.total_square_feet);
            $('#min_land_rate').val(resp.data.min_land_rate);
            $('#t_kubul_amount').val(resp.data.k_land_rate);
            $('#new_k_amount').val(resp.data.k_land_rate);
            if(resp.data.a_ropani != ' ') {
              $('#j_ropani').val(resp.data.a_ropani);
            } else {
              $('#j_ropani').val(0);
            }
            if(resp.data.a_ana !='') {
             $('#j_aana').val(resp.data.a_ana);
            } else {
              $('#j_aana').val(0);
            }

            if(resp.data.a_paisa !='') {
              $('#j_paisa').val(resp.data.a_paisa);
            } else {
              $('#j_paisa').val(0);
            }
            
            if(resp.data.a_dam !='') {
             $('#j_dam').val(resp.data.a_dam);
            } else {
              $('#j_dam').val(0);
            }
            
            $('#t_rate').val(resp.data.t_rate);
          }
        }
      });
    });

    //
    $(document).on('input','#new_area', function(){
      obj = $(this);
      var new_area = obj.val();
      var total_area = $('#total_land_area').val();
      $('#r_area').val(new_area);
      var kubul_rate = $('#new_k_amount').val();
      r = 0;
      var total_value = new_area;
      var one_ropani = 5476;
      var one_aana = 342.25;
      var one_paisa = 85.56;
      var one_dam = 21.39;
      //-----------------------------------------
      var r = total_value - one_ropani;
      var ropani = total_value / one_ropani;
      var a = Math.trunc(ropani);
      var b = a * one_ropani;
      var c = total_value - b;
      var aana = c / one_aana;
      //--------------------------------------------
      var total_aana = Math.trunc(aana);
      var rem_sqft_after_aana = total_aana * one_aana;
      var d = c - rem_sqft_after_aana;
      var t_paisa = d / one_paisa;
      //----------------------------------------
      var t_paisa_p = Math.trunc(t_paisa);
      var rem_t_paisa = t_paisa_p * one_paisa;
      var e = d - rem_t_paisa;
      var t_dam = e / one_dam;
      var tt_ropani = a;
      var tt_aana = total_aana;
      var tt_paisa = Math.trunc(t_paisa);
      var tt_dam = t_dam.toFixed(0);
      //console.log(tt_ropani+'-'+tt_aana+'-'+tt_paisa+'-'+tt_dam);
      var ropani_amount = tt_ropani * kubul_rate;
      var aana_rate = tt_aana / 16;
      var paisa_rate = tt_paisa / 64;
      var dam_rate = tt_dam / 256;
      var aana_amount = aana_rate * kubul_rate;
      var paisa_amount = paisa_rate * kubul_rate;
      var dam_amount = dam_rate * kubul_rate
      var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;
      $('#n_t_amount').val(total_amount);
      $('#r_t_amount').val(total_amount);
      $('#n_ropani').val(tt_ropani);
      $('#n_aana').val(tt_aana);
      $('#n_paisa').val(tt_paisa);
      $('#n_dam').val(tt_dam);
      //console.log(total_amount);

      //console.log(a + '-'+total_aana+'-'+Math.trunc(t_paisa)+'-'+t_dam.toFixed(0))
      // $('.ropani').val(a);
      // //--------------------------
      // $('.aana').val(total_aana);
      // $('.paisa').val(Math.trunc(t_paisa));
      // $('.dam').val(t_dam.toFixed(0));

      // var r_area = parseFloat(total_area) -parseFloat(new_area);
      // console.log(r_area);
    });
    // $(document).on('checked', '#all_land', function(){
    //   console.log('hello');
    // });

    $('#all_land').click(function(){
      if($(this).prop("checked") == true){
          console.log("Checkbox is checked.");
      }
      else if($(this).prop("checked") == false){
          console.log("Checkbox is unchecked.");
      }
    });
  });//END OF DOM
</script>
    
   