<style type="text/css">
  .print_table tr:nth-child(odd){
        background-color:#fffdfd
    }
    .print_table tr:nth-child(even){
        background-color:#fffdfd;
        /*color: #FFF;*/
    }
</style>
<!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="">शिर्षकगत रिपोर्ट</a></li>
      </ol>
    </nav>
    <!-- page start-->

    <div class="row">
      <div class="col-sm-12">
        <section class="card">
          <div class="card-header">
            <h1 class="text-center" style="text-decoration: underline;">आम्दानी प्रतिबेदन</h1>
            <form action ="<?php echo base_url()?>RajasowTitleWise/Search" method="post" class="search_report">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="row">
              <div class="col-md-2">
                  <div class="form-group">
                    <select class="form-control dd_select" name="fiscal_year">
                      <option value="">आर्थिक वर्ष छानुहोस </option>
                      <?php if(!empty($fiscal_year)) :
                        foreach($fiscal_year as $fy) :?>
                          <option value="<?php echo $fy['year']?>"  <?php if($fy['year'] == current_fiscal_year()){ echo 'selected';}?>><?php echo $this->mylibrary->convertedcit($fy['year'])?></option>
                        <?php endforeach; endif;?>
                      </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control dd_select" name="month">
                      <option value="">महिना छान्नुहोस्</option>
                      <option value="04">श्रावण</option>
                      <option value="05">भाद्र</option>
                      <option value="06">आश्विन</option>
                      <option value="07">कार्तिक</option>
                      <option value="08">मार्ग</option>
                      <option value="09">पौष</option>
                      <option value="10">माघ</option>
                      <option value="11">फाल्गुन</option>
                      <option value="12">चैत्र</option>
                      <option value="01">वैशाख</option>
                      <option value="02">ज्येष्ठ</option>
                      <option value="03">आषाढ</option>
                    </select>
                  </div>
                </div>
                <?php if($this->session->userdata('PRJ_USER_ID') == 1) { ?>
                 <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control dd_select" name="ward">
                      <option value="">वडा चयन  गर्नुहोस</option>
                      <?php if(!empty($wards)) :
                        foreach($wards as $wn) :?>
                          <option value="<?php if($wn['ward'] == 0){ echo 'PALIKA';} else { echo $wn['ward'];}?>"><?php if($wn['ward'] == 0){ echo TYPE;} else { echo 'वडा नं. ' .$this->mylibrary->convertedcit($wn['ward']);}?></option>
                        <?php endforeach; endif;?>
                      </select>
                  </div>
                </div>
               <?php } ?>
                <div class="col-md-2">
                  <div class="form-group">
                    <button class="btn btn-primary btn-block btn-xs save_button" data-toggle="tooltip" title="   रिपोर्ट खोज्नुहोस" name="Submit" type="submit" value="Save"> <i class="fa fa-search"></i> खोज्नुहोस</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="card-body">
            <div class="search_div">
              <div class="alert alert-info">रिपोर्ट खोज्नुहोस</div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
 </section>

 <script type="text/javascript" src="<?php echo base_url('assets/nepali_datepicker/nepali.datepicker.v2.2.min.js')?>"></script>
 <script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url()?>assets/js/search.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.dd_select').select2();
    var date = "<?php echo convertDate(date('Y-m-d'))?>";
    $('#nepaliDateD').nepaliDatePicker({});
    $('.nepali-calendar').nepaliDatePicker({});
  });
</script>