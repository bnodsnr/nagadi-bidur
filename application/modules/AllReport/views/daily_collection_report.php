<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">दैनिक संकलन </a></li>
        </ol>
      </nav>
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <section class="card" style="margin-bottom: -25px;">
                <header class="card-header" style="background: #1b5693;color:#FFF">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <select class="form-control" id="fy">
                          <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                          <?php if(!empty($ward)):
                            foreach ($fiscal_year as $key => $fy) :?>
                            <option value="<?php echo $fy['year']?>"><?php echo $fy['year']?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <select class="form-control" id="ward">
                          <option value="">वडा नं चयन गर्नुहोस्</option>
                          <?php if(!empty($ward)):
                            foreach ($ward as $key => $w) :?>
                            <option value="<?php echo $w['name']?>">
                            <?php 
                            
                            echo 'वडा नं-'.$w['name']

                            ?></option>
                          <?php endforeach;endif;?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="input-group">
                        <input type="text" id="nepaliDateD" class="form-control nepali-calendar" value=""/>
                        <div class="input-group-prepend">
                          <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="input-group">
                          <button type="button" class="input-group-text btn btn-danger btn-search" title="">खोज्नुहोस</button>
                      </div>
                    </div>
                  </div>
                </header>
                <div class="card-body">
                  <div class="alert alert-danger">कृपया दिइएको चयन गर्नुहोस् !</div>
                  <div class="adv-table"></div>
                </div>
              </section>
          </div>
        </div>
        <!-- page end-->
    </section>
</section>
<script type="text/javascript" src="<?php echo base_url('assets/nepali_datepicker/nepali.datepicker.v2.2.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
   
<script type="text/javascript">
  $(document).ready(function(){
    var date = "<?php echo convertDate(date('Y-m-d'))?>";
    $('#nepaliDateD').nepaliDatePicker({});

    $(document).on('click', '.btn-search', function(){
      var obj = $(this);
      var date = $('#nepaliDateD').val();
      var fy = $('#fy').val();
      var ward = $('#ward').val();
      $.ajax({
        url:"<?php echo base_url()?>AllReport/searchReport",
        method:"POST",
        data:{date:date,fy:fy,ward:ward},
        // contentType: false,
        // processData: false,
        beforeSend: function () {
          obj.html('<i class="fa fa-spinner fa-spin"></i> खोज्नुहोस');
        },
        success:function(resp){
          if(resp.status == 'success') {
           // console.log(resp);
            $('.adv-table').empty().html(resp.data);
            obj.html('खोज्नुहोस');
          }
        }
      }); 
    });
    
  })
</script>
    
   