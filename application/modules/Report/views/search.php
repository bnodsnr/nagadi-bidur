 <!--main content start-->

 <section id="main-content">

  <section class="wrapper site-min-height">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>

        </li>

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>Report/DailyReport">दैनिक रिपोर्ट</a></li> 

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>MonthlyReport">मासिक रिपोर्ट</a></li> 

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>Report/Search">रिपोर्ट खोज्नुहोस</a></li> 

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

      

          <!--<header class="card-header" style="background: #1b5693;color:#FFF">-->



          <!--   <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">-->

          <!--       <li class="nav-item">-->
          <!--            <a class="nav-link btn btn-warning"  href="<?php echo base_url()?>Report/DailyReport" >दैनिक रिपोर्ट</a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--            <a class="nav-link  btn btn-warning" id="profile-tab" href="<?php echo base_url()?>MonthlyReport">मासिक रिपोर्ट </a>-->
          <!--        </li>-->
          <!--        <li class="nav-item">-->
          <!--            <a class="nav-link  btn btn-warning active"  href="<?php echo base_url()?>Report/Search" >रिपोर्ट खोज्नुहोस</a>-->
          <!--        </li>-->
          <!--    </ul>-->
          <!--</header>-->

          <div class="card-body">

            <div class="tab-content tasi-tab" id="myTabContent">

                <div class="row">

                    <div class="col-md-12">

                      <div class="alert alert-info"><h3 class="text-center"> रिपोर्ट खोज्नुहोस</h3>

                      </div>

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-2">

                      <div class="input-group">

                        <select class="form-control" id="fiscal_year">
                          <option value="">आर्थिक वर्ष छानुहोस</option>
                          <?php if(!empty($fiscal_year)) : foreach ($fiscal_year as $key => $fy) :?>
                            <option value="<?php echo $fy['year']?>" <?php if($fy['year'] == current_fiscal_year()){echo 'selected';}?>><?php echo $this->mylibrary->convertedcit($fy['year'])?></option>
                          <?php endforeach;endif;?>
                        </select>

                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="input-group">

                        <input type="text" id="from_date" class="form-control nepali-calendar" value="" placeholder="देखी मिति " />

                      </div>

                    </div>



                    <div class="col-md-2">

                      <div class="input-group">

                        <input type="text" id="to_date" class="form-control nepali-calendar" value="" placeholder="सम्म मिति" />

                      </div>

                    </div>



                   <!--  <div class="col-md-2">

                      <select class="form-control" id="month">

                        <option></option>

                        <option value="01">वैशाख</option>

                        <option value="02">ज्येष्ठ</option>

                        <option value="03">आषाढ</option>

                        <option value="04">श्रावण</option>

                        <option value="05">भाद्र</option>

                        <option value="06">आश्विन</option>

                        <option value="07">कार्तिक</option>

                        <option value="08">मार्ग</option>

                        <option value="09">पौष</option>

                        <option value="10">माघ</option>

                        <option value="11">फाल्गुन</option>

                        <option value="12">चैत्र</option>

                      </select>

                    </div> -->

                    <?php if($this->session->userdata('PRJ_USER_ID') ==  1) { ?>

                    <div class="col-md-2">

                      <select class="form-control search_added_ward" id="search_ward_no">

                          <option value="">वडा छान्नुहोस् </option>

                          <?php if(!empty($wards)) :

                            foreach ($wards as $key => $ward) : ?>

                              <option value="<?php echo $ward['ward']?>"><?php 

                                if($ward['ward'] == '0'){ echo 'नगरपालिका';

                              } else { echo 'वडा नं '.$this->mylibrary->convertedcit($ward['ward']);}?></option>

                            <?php endforeach;endif;?>

                        </select>

                    </div>
                    <div class="col-md-2" id="">
                      <select class="form-control user_id" id="user_id">
                        <option value="">प्रोयोगकर्ता छान्नुहोस्</option>
                        <?php if(!empty($user)) {
                          foreach ($user as $key => $value) { ?>
                            <option value="<?php echo $value['userid']?>"><?php echo $value['name']?></option>
                        <?php  }
                        } ?>
                      </select>
                    </div>
                    <?php } ?>
                    
                    <div class="col-md-2">

                      <button class="btn btn-danger report-search"><i class="fa fa-search"></i> खोज्नुहोस </button>

                    </div>

                  </div>

                  <hr>

                  <div class = "search_monthly_report">

                   

                  </div>

              </div>

            </div>

        </section>

      </div>

    </div>

    <!-- page end-->

  </section>

</section>

<script type="text/javascript" src="<?php echo base_url('assets/nepali_datepicker/nepali.datepicker.v2.2.min.js')?>"></script>

<script type="text/javascript">

  $(document).ready(function(){

    var date = "<?php echo convertDate(date('Y-m-d'))?>";

    $('#nepaliDateD').nepaliDatePicker({});

    $('.nepali-calendar').nepaliDatePicker({});



      $(document).on('click', '.report-search', function(){
        var obj = $(this);
        
        var from_date = $('#from_date').val();
        var to_date  = $('#to_date').val();
        var fiscal_year = $('#fiscal_year').val();
        if(from_date.length == 0 && to_date.length == 0 ){
          alert('please select from date & to date');
          return false;
        }
       //($('input:text').val().length == 0) {
        var search_added_ward = $('.search_added_ward').val();
        var user_id = $('#user_id').val();
        $.ajax({
          method:"POST",
          url:"<?php echo base_url()?>Report/Search/AdminSearchReport",
          data:{
            from_date:from_date,
            to_date:to_date,
            search_added_ward:search_added_ward,
            fiscal_year:fiscal_year,
            user_id:user_id,
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          beforeSend: function () {

            obj.html('<i class="fa fa-spinner fa-spin"></i> <i class="fa fa-search"></i> खोज्नुहोस');

          },
          success:function(resp){
            if(resp.status == 'success') {
              $('.search_monthly_report').empty().html(resp.data);

              obj.html(' <i class="fa fa-search"></i> खोज्नुहोस');

            }

          }

        });

      });

    

      $(document).on('change', '#search_ward_no', function(){
        var obj = $(this);
        var ward_no = $('#search_ward_no').val();
        $.ajax({
          url:"<?php echo base_url()?>Report/Search/GetUser",
          method:"POST",
          data:{
            ward_no:ward_no,
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },

          success:function(resp){

            if(resp.status == 'success') {
              $('.user_id').empty().html(resp.option);

            }

          }

        }); 

      });


    });

  </script>