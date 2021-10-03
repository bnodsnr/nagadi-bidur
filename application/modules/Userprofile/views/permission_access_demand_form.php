<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <div class="row">
      <form method="post" action="<?php echo base_url()?>Users/saveAccessDemandForm">
        <aside class="profile-info col-lg-12">
          <section class="card">
            <div class="card-body ">
              <div class="row">
                <div class="col-md-3">
                  <div class="npl_gov_stamp"><p class="text-center">नेपाल सरकारको छाप</p></div>
                </div>
                <div class="col-md-8">
                  <div class="npl_gov_body" style="margin-left: 50px;">
                    <p><strong>संघ/प्रदेश/स्थानीय तह</strong></p>
                    <p style="margin-left: -23px;margin-top: -13px;"><strong>......मन्त्रालय/विभाग/कार्यलय</strong></p>
                    <p style="margin-left: 12px;margin-top: -13px;"><strong>कार्यलय कोड नं.</strong></p>
                    <p style="margin-left: -39px;margin-top: -13px;"><strong>विद्युतीय प्रणाली प्रयोगकर्ता विवरण, परिवर्तन र स्थगन माग फारम</strong></p>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="npl_state_stamp"><p  class="text-center">प्रदेश/स्थानीय सरकार</p></div>
                </div>
                <div class="col-md-6">
                  <div class="">
                    <div class="card ui-sortable-handle" >
                      <div class="card-header">विवरण</div>
                      <div class="card-body">
                       <table class="table table-bordered">
                        <tbody>
                          <tr> 
                            <td>प्रयोगकर्ता कर्मचारीको नाम</td>
                            <td><?php echo $query->name?></td>
                          </tr>
                          <tr> 
                            <td>संकेत नं. </td>
                            <td><?php echo $query->symbol_no?></td>
                          </tr>
                          <tr> 
                            <td>पद</td>
                            <td><?php echo $query->designation?></td>
                          </tr>
                          <tr> 
                            <td>शाखा</td>
                            <td><?php echo $query->branch_name?></td>
                          </tr>
                          <tr> 
                            <td>प्रयोजन</td>
                            <td><?php echo $query->designation?></td>
                          </tr>
                          <tr> 
                            <td>सफ्टवेयर/प्रणालीको नाम</td>
                            <td><?php echo $query->designation?></td>
                          </tr>
                          <tr> 
                            <td>सफ्टवेयर विवरण</td>
                            <td><?php echo $query->designation?></td>
                          </tr>
                          <tr> 
                            <td>पहुँच तह Access level</td>
                            <td><?php echo $query->user_group?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="">
                  <div class="card ui-sortable-handle" >
                   <!--  <div class="card-header">विवरण</div> -->
                   <div class="card-body">
                     <table class="table table-bordered">
                      <tbody>
                        <?php 
                        foreach($parentmodules->result() as $menu) { ?>
                          <tr> 
                            <td><input type="checkbox" name = "menu[]" value="<?php echo $menu->menuid?>"></td>
                            <td><?php echo $menu->menu_name?></td>
                          </tr>
                          <?php 
                        } ?>
                      </tbody>
                      <tfoot>
                        <tr rowspan = "2">
                          <td>माग गर्नुपर्ने कारण</td>
                          <td>
                            <textarea class="form-control" name="reason"></textarea>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <hr style="border-top:1px dotted #000;">
              <div class="row">
                <div class="col-md-6">
                  <p>सम्बन्धित कर्मचारीको</p>
                  <p>नाम:- <?php echo $query->name?></p>
                  <p>पद:-<?php echo $query->name?></p>
                  <p>दस्तखत</p>
                </div>

                <div class="col-md-6">
                  <div class="">
                   <p>सिफारिस गर्ने कर्मचारी</p>
                   <p>
                    <select class="form-control refer_by" name ="refer_by">
                      <option value="">select</option>
                      <?php if($users->num_rows()>0) {
                        foreach ($users->result() as $key => $u) { ?>
                         <option value="<?php echo $u->userid?>"><?php echo $u->name?></option>
                       <?php  }
                     } ?>
                   </select>
                 </p>
                 <p>पद: <span id="position"></span></p>
                 <p>दस्तखत: </p>
               </div>
             </div>
           </div>
           <div class="row">
            <div class="col-md-12">
              <hr>
              <div class="text-center">
                <button class="btn btn-primary btn-xs save_button" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Save" type="submit" value="Save"> सेभ गर्नुहोस्</button>
                <a href="<?php echo base_url()?>Setting/SadakKoKisim" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
        </aside> 
      </form>                           
</div>

<!-- page end-->
</section>
</section>

<script type="text/javascript">
  $(document).ready(function(){
    $('.refer_by').on('change', function(){
      var userid = $(this).val();
      $.ajax({
        url:base_url+'Users/getSelectedUserDetails',
        method:"POST",
        data:{userid:userid},
        success: function(resp){
          console.log(resp);
          $('#position').text(resp);
        },
      });
    });
  });
</script>