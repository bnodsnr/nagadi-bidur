<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="card">
          <div class="card-body">
            <div class="card-body">
              <div class="form-section">
               <form>
                <label>आर्थिक वर्ष || Fiscal Year</label>
                <div class="row">
                  <div clas = "col-md-12">
                     <select class="form-control"  id = "set_fiscal_year">
                      <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                      <?php
                       if(!empty($fiscal_year)) : 
                        foreach ($fiscal_year as $key => $value) :?>
                          <option value="<?php echo $value['year']?>" <?php //if($value['is_current'] ==1){ echo 'selected';} ?>><?php echo $value['year']?></option>
                        <?php endforeach;endif?>
                      </select>
                  </div>
                   <div class="col-md-5">
                    <button type ="button" class="btn btn-info" id = "btn_set_fiscal_year" data-url="<?php echo base_url()?>Setting/SetFiscalYear">Filter</a>
                  </div>
                </div>
                 
                </form>
              </div>
            </div>
          </div>
        </section>

        <section class="card">
          <div class="card-body">
            <div class="notifcation">
              <div class="alert alert-primary" role="alert">
                  कृपया आर्थिक वर्ष चयन गर्नुहोस्
              </div>
            </div>
            <div class="show_form"></div>
          </div>
        </section>
      </div>
    </div>
</div>
</div>
</div>

</div>

<!-- page end-->
</section>
</section>
<!--main content end-->
<script type="text/javascript">
  
  // $(document).ready(function(){
  //   $('#set_fiscal_year').on('click', function(){
  //     var set_fiscal_year = $('#set_fiscal_year').val();
  //     $.ajax({
  //         method:"POST",
  //         url:'<?php echo base_url()?>Setting/SampatiKarView',
  //         data: {set_fiscal_year:set_fiscal_year},
  //         success:function(data) {
  //           if(data.status == 'success') {
  //             $('.notifcation').hide();
  //             $('.show_form').html(data.message);
  //           }
  //           if(data.status == 'error') {
  //             $('.notifcation').hide();
  //             $('.show_form').html('<div class="alert alert-danger">कृपया आर्थिक वर्ष चयन गर्नुहोस् !</div>')
  //           }
  //         } 
  //     });
  //   });
  // })
</script>