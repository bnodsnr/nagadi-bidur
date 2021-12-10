<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;">दैनिक नगदि स .्कलन </a></li>
              </ol>
            </nav>
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
                  <section class="card" style="margin-bottom: -25px;">
                      <header class="card-header">
                        <div class="row">
                          <!-- <form action="<?php echo base_url()?>NagadiReport/SearchWardReport"> -->
                            <div class="col-md-5">
                              <div class="input-group">
                                <select class="form-control" name="month" id="month">
                                  <option>महिना छान्नुहोस्</option>
                                  <option value="1">बैशाख</option>
                                  <option value="2">जेठ</option>
                                  <option value="3">आषाढ</option>
                                  <option value="4">श्रावान</option>
                                  <option value="5">भाद्र</option>
                                  <option value="6">आश्विन</option>
                                  <option value="7">कार्तिक</option>
                                  <option value="8">मङ्सिर</option>
                                  <option value="9">पौष</option>
                                  <option value="10">माघ</option>
                                  <option value="11">फाल्गुन</option>
                                  <option value="12">चैत्र</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-5">
                              <div class="input-group">
                                 <select class="form-control" name="ward" id="ward">
                                  <option>वडा छान्नुहोस्</option>
                                  <?php if(!empty($ward)) :
                                    foreach ($ward as $key => $w) : ?>
                                      <option value="<?php echo $w['name']?>"><?php echo $w['name']?></option>
                                  <?php endforeach;endif;?>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-2">
                              <button type="button" class="input-group-text btn btn-danger btn-search" title="">खोज्नुहोस  </button>
                            </div>
                         <!--  </form> -->
                        </div>
                      </header>
                      <div class="card-body">
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
        
        $(document).on('click', '.btn-search', function(){
          var month = $('#month').val();
          var ward = $('#ward').val();
          var obj = $(this);
          $.ajax({
            url:"<?php echo base_url()?>NagadiReport/SearchWardReport",
            method:"POST",
            data:{month:month, ward:ward,'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
            beforeSend: function () {
              obj.html('<i class="fa fa-spinner fa-spin"></i> खोज्नुहोस');
            },
            success:function(resp){
              if(resp.status == 'success') {
                //console.log(resp);
                $('.adv-table').empty().html(resp.data);
                obj.html('खोज्नुहोस');
              }
            }
          }); 
        });
        
      })
  </script>
    
   