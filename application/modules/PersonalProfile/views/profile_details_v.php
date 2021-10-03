

<!--main content start-->

      <section id="main-content">

          <section class="wrapper site-min-height">

            <nav aria-label="breadcrumb">

              <ol class="breadcrumb">

                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>

                  <li class="breadcrumb-item"><a href="javascript:;"> समग्र सङ्कलङ रिपोर्ट  </a></li>

              </ol>

            </nav>

              <!-- page start-->

              <div class="row">

                <div class="col-sm-12">

                  <section class="card" style="margin-bottom: -25px;">

                      <header class="card-header" style="background: #1b5693;color:#FFF">

                     <!--   समग्र नगदि सङ्कलङ रेपोर्त -->
                     	
                        <form class="form">
                       		
                       		<div class="row">
	                     		<div class="col-md-4">
	                     			<input type="text" id="nepaliDateD" class="form-control nepali-calendar" value="" placeholder="मिति" />
	                     		</div>

	                     		<div class="col-md-4">
	                     			<select class="form-control" id="month">
	                     				<option value="">महिना चयन गर्नुहोस</option>
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
	                     		</div>
	                     		<div class="input-group-prepend">
                                	<button type="button" class="btn btn-danger btn-search" title=""><i class="fa fa-search"></i> खोज्नुहोस  </button>
                              </div>
                     		</div>
                        </form>

                     <!--   <span class="tools pull-right">

						<a href="<?php //echo base_url()?>NagadiReport/printOverAllReport" target="_blank" id="print"><img src="<?php //echo base_url()?>assets/img/ppt.png" style="height: 20px;"></a>

						<a href="javascript:;"><img src="<?php //echo base_url()?>assets/img/pdf.png" style="height: 20px;"></a>

						<a href="<?php //echo base_url()?>NagadiReport/exportOverAllReport"><img src="<?php //echo base_url()?>assets/img/xls.png" style="height: 20px;"></a>

					</span> -->

                      </header>

                      <div class="card-body">

                        <div class="search_details">
                        	<!-- <button class="btn btn-sm btn-info print" id="print">प्रिन्ट गर्नुहोस</button> -->
							<table class=" table table-bordered table-responsive print_table" id="hidden-table-info">

							<thead>

								<tr>

						
									<th class="hidden-phone">वडा</th>
									<th class="hidden-phone">रसिद काटिएको प्रोफाइल</th>
									<th class="hidden-phone">रसिद काटिएको प्रोफाइल</th>
									<th class="hidden-phone">जम्मा रु:</th>

								</tr>

							</thead>

							<tbody>

							

                        </div>

                      </div>

                    </section>

                </div>

              </div>

              <!-- page end-->

          </section>

      </section>
   

