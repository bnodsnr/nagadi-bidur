
<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;"> समग्र नग दि सङ्कलङ रेपोर्त </a></li>
              </ol>
            </nav>
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
                  <section class="card" style="margin-bottom: -25px;">
                      <div class="card-body">
                        <form>
	                      	<div class="row">
	                      		<div class="col-md-3">
	                      			<div class="form-group">
	                      				<label>आर्थिक वर्ष</label>
	                      				<select class="form-control" name="fiscal_year" id="fiscal_year">
	                      					<?php if(!empty($fiscal_year)):
	                      						foreach ($fiscal_year as $key => $fy) :?>
	                      							<option value="<?php echo $fy['year']?>" <?php if($fy['is_current'] == 1){echo 'selected';}?>><?php echo $fy['year']?></option>
	                      					<?php endforeach;endif;?>
	                      				</select>
	                      			</div>
	                      		</div>
	                      		<div class="col-md-2">
	                      			<div class="form-group">
	                      				<label>रशिद नं</label>
	                      				<input type="text" name="" class="form-control" id="bill_no">
	                      			</div>
	                      		</div>
	                      		<div class="col-md-3">
	                      			<label>वडा  नं</label>
	                      			<div class="form-group">
	                      				<select class="form-control" name="ward" id="ward_no">
	                      				<option value=""></option>
	                      				<?php if(!empty($ward)):
	                      						foreach ($ward as $key => $w) :?>
	                      							<option value="<?php echo $w['name']?>" ><?php echo 'वडा  नं-'. $w['name']?></option>
	                      					<?php endforeach;endif;?>
	                      				</select>
	                      			</div>
	                      		</div>
	                      		<div class="col-md-3">
	                      			<label>मिति</label>
	                      			<div class="form-group">
	                      				<input type="text" id="nepaliDateD" class="form-control nepali-calendar" value=""/>
	                      			</div>
	                      		</div>
	                      		
	                      		<div class="col-md-1">
	                      			<div class="form-group">
	                      				<button type = "button" class="btn btn-danger btn-search" style="margin-top: 25px;"> खोज्नुहोस  </button>
	                      			</div>
	                      		</div>
	                      	</div>
                      	</form>
                      </div>
                    </section>
                </div>
              </div>

               <div class="row">
                <div class="col-sm-12">
                  <section class="card">
                     <div class="card-body show_report">
                     	<div class="alert alert-success">रिपोर्ट हेर्न कृपया चयन गर्नुहोस्</div>
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
         
          $.ajax({
            url:"<?php echo base_url()?>NagadiReport/SearchReport",
            method:"POST",
            data:{date:date,bill_no:bill_no,ward_no:ward_no,fiscal_year:fiscal_year},
           
            beforeSend: function () {
              obj.html('<i class="fa fa-spinner fa-spin"></i> प्रशोधनमा');
            },
            success:function(resp){
              if(resp.status == 'success') {
                $('.show_report').empty().html(resp.data);
                obj.html('खोज्नुहोस');
              }
            }
          }); 
        });
        
      })
  </script>

    
