

<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
             <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a> 
				</li>
				<li class="breadcrumb-item"><a href="javascript:;"><i class=""></i> समग्र वडागत सम्पति-भूमि कर  रिपोर्ट</a></li>
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
                              <label>आर्थिक वर्ष</label>
                              <select class="form-control" id="fiscal_year">
                                <option></option>
                                <?php if(!empty($fiscal_year)):
                                  foreach ($fiscal_year as $key => $fy) :?>
                                  <option value="<?php echo $fy['year']?>"><?php echo $fy['year']?></option>
                                <?php endforeach;endif;?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              
                              <label>वडा नं </label>
                              <select class="form-control" id="ward">
                                <option></option>
                                <?php if(!empty($ward)):
                                  foreach ($ward as $key => $w) :?>
                                  <option value="<?php echo $w['name']?>"><?php echo 'वडा नं-'.$w['name']?></option>
                                <?php endforeach;endif;?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <label>मिति </label>
                            <div class="input-group">
                              <input type="text" id="nepaliDateD" class="form-control nepali-calendar" value=""/>
                              <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-1">
                              <button type="button" class="input-group-text btn btn-danger btn-search" title="" style="margin-top: 25px;">खोज्नुहोस  </button>
                          </div>
                        </div>
                      </header>
                      <div class="card-body">
                        <div class="adv-table">
                          <table class=" table table-bordered" id="hidden-table-info">
              							<thead>
              								<tr>
              									<th>सि.नं</th>
              									<th class="hidden-phone">वडा नं</th>
              									<th class="hidden-phone">सम्पतिकर भूमिकर</th>
              								</tr>
              							</thead>
              							<tbody>
              								<?php  $total= 0; $i=1;if(!empty($ward)) :
              									foreach($ward as $key => $w) : ?>
              								<tr>
              									<td><?php echo $this->mylibrary->convertedcit($i++)?></td>
              									<td><?php echo 'वडा नं-'.$this->mylibrary->convertedcit($w['name'])?></td>
              									<td>
              										<?php $total_amount = $this->Reportmodel->getTotalSampatBhumiKarByWard($w['name']);
              											echo !empty($total_amount->total)?$this->mylibrary->convertedcit(number_format($total_amount->total)):$this->mylibrary->convertedcit(0);
                                    $total += $total_amount->total;
              										?>
              									</td>
              								</tr>
              							<?php endforeach;endif;?>
              							</tbody>
              							<tfoot>
              								<tr>
                                <td colspan="2" align="right">जम्मा रु:</td>
                                <td><?php echo $this->mylibrary->convertedcit(number_format($total))?> (अक्षरुपी : <?php echo $this->convertlib->convert_number($total,"मात्र |")."मात्र |";?>)
                                </td>
                            </tfoot>
                          </table>
                        </div>
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
          var fiscal_year = $('#fiscal_year').val();
          var ward_no = $('#ward').val();
          $.ajax({
            url:"<?php echo base_url()?>Report/SearchReport",
            method:"POST",
            data:{date:date,ward_no:ward_no,fiscal_year:fiscal_year},
            beforeSend: function () {
              obj.html('<i class="fa fa-spinner fa-spin"></i> खोज्नुहोस');
            },
            success:function(resp) {
              if(resp.status == 'success') {
                $('.adv-table').empty().html(resp.data);
                obj.html('खोज्नुहोस');
              }
            }
          }); 
        });
        
      })
  </script>
    
   
