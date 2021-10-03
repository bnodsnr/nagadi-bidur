

 <!--main content start-->

 <section id="main-content">

  <section class="wrapper site-min-height">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>

        </li>

        <li class="breadcrumb-item"><a href="javascript:;">नगदी रसिद सुची </a></li>

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

            <div class="mail-option">

              <div class="btn-group hidden-phone">

                <!-- <input type="text" class="form-control col-md-12" id="name" placeholder="करदाताको नाम" style="width: 200px;"> -->
                <select class="form-control" id="fiscal_year">
                  <option value="">आर्थिक वर्ष छानुहोसr</option>
                  <?php if(!empty($fiscal_year)) :
                    foreach($fiscal_year as $fy) : ?>
                      <option value="<?php echo $fy['year']?>"><?php echo $fy['year']?></option>
                  <?php endforeach;endif;?>
                </select>
              </div>

              <div class="btn-group hidden-phone">

                <input type="text" class="form-control" id="bill_no" placeholder="रसिद नम्बर">

              </div>
              
               <div class="btn-group hidden-phone">

                <input type="text" class="form-control" id="name" placeholder="करदाताको नाम ">

              </div>

              <div class="btn-group hidden-phone">

                <div class="input-group">

                  <input type="text" name="date" class="form-control " value="" placeholder="देखी मिति" autocomplete="off" id="fromdate">

                  <div class="input-group-prepend">

                    <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar" style="color:#1b5693;background: radial-gradient(#ffffff, transparent);"></i></button>

                  </div>

                </div>

              </div>

             

              <div class="btn-group hidden-phone">

                <select class="form-control" name="status" id="status" style="width: 100px;">

                  <option value="">अवस्था</option>

                  <option value="1">सदर</option>

                  <option value="2">बदर</option>

                </select>

              </div>



              <div class="btn-group hidden-phone">

                <div class="">

                  <button type="button" class="btn btn-warning" title="खोजी गर्नुहोस्" id="filter">खोजी गर्नुहोस्</button>

                  <a href="<?php echo base_url()?>NagadiRasid/viewCancelBills" class="btn btn-warning" style="background-color: #e21a1a; color:#FFF;border-radius: 0.25rem;"><i class="fa fa-eye"></i> रद्ध गरिएको रसिदको हेर्नुहोस</a>
                </div>
              </div>
            </div>
          </header>
          <div class="card-body">
            <div class="adv-table ">
              <table class=" table table-bordered table-striped" id="nagadilist">
                <thead>
                  <tr>
                    <th text-aligh="right">#</th>
                    <th>मिति</th>
                    <th>रसिद नम्बर</th>
                    <th>करदाता को नाम</th>
                    <th>कुल जम्मा रु</th>
                   <th>रशिद काट्ने नाम</th> 
                    <th class="hidden-phone">अवस्था</th>
                    <th></th>
                    <?php if($this->session->userdata('PRJ_USER_ID') == 1) { ?>
                      <th></th>
                    <?php } ?>
                  </tr>

                </thead>

              </table>

            </div>

          </div>

        </section>

      </div>

    </div>

    <!-- page end-->

  </section>

 </section>





<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/nepali_datepicker/nepali.datepicker.v2.2.min.js"></script>

<script type="text/javascript">

  $(document).ready(function(){

    $('#fromdate').nepaliDatePicker();

    $('#todate').nepaliDatePicker();

    fetch_all_data();

    function fetch_all_data(name, bill_no, from_date, status,fiscal_year){

      var oTable = $('#nagadilist').DataTable({

        

        "order": [[ 0, "desc" ]],

        "searching": false,

        'lengthChange':false,

        "processing": true,

        "serverSide": true,

        'language': {

            'loadingRecords': '&nbsp;',

            'processing': '<div class="spinner"></div>'

        },

        "ajax":{

          "url": "<?php echo base_url('NagadiRasid/GetBills') ?>",

          "dataType": "json",

          "type": "POST",

          "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', name:name, bill_no:bill_no,from_date:from_date,status:status,fiscal_year:fiscal_year}

          },

        "columns": [

              { "data": "sn" },

              { "data": "date" },

              { "data": "bill_number" },

              { "data": "name" },

              { "data": "total" },

              { "data": "user_name" },

               <?php if($this->authlibrary->HasModulePermission('NAGADI-RASID', 'VIEW')){ ?>

              {

                "data": "", render: function ( data, type, row ) {

                    if(row.status =="सदर") {

                        var res = '<button class="btn btn-success" data-url="<?php echo base_url()?>PersonalProfile/deleteProfile/" data-id = "'+row.id+'" >'+row.status+'</button>';

                        res += '</div"></div>';

                    } else {

                        var res = '<a class="btn btn-danger"  data-toggle="modal" href="#previewModel" data-url="<?php echo base_url()?>NagadiRasid/viewCancelReason" data-id = "'+row.id+'"">'+row.status+'</a>';

                        res += '</div"></div>';

                    }
                  

                  return res;

                },"bVisible": true, "bSearchable": false, "bSortable": false

              },

              {
                "data": "", render: function ( data, type, row ) {
                  var res = '<a class="btn btn-warning" target="_blank" href="<?php echo base_url()?>NagadiRasid/generateBill/'+row.guid+'">'+'रशिद हेर्नुहोस'+'</a>';
                        res += '</div"></div>';
                  return res;
                },"bVisible": true, "bSearchable": false, "bSortable": false
              },

              <?php if($this->session->userdata('PRJ_USER_ID') == 1 ) { ?>
              
                {

                  "data": "", render: function ( data, type, row ) {
                    if(row.status == 'सदर' ) {
                      var res = ' <button type="button" data-toggle="modal" class="btn btn-danger" href="#editModel" title="शिर्षक सम्पादन गर्नुहोस्" data-url="<?php echo base_url()?>NagadiRasid/cancleNagadiBill" data-id = "'+row.id+'"><i class="fa fa-times"></i> रद्द गर्नुहोस्</button>';
                          res += '</div"></div>';
                        } else {
                          var res = '<p class="label label-warning">कार्य उपलब्ध छैन</p>'
                        }
                    return res;
                  },"bVisible": true, "bSearchable": false, "bSortable": false
                },
              
              <?php } ?>
              <?php } ?>

              

           ],

      });

    }

    

    $('#filter').click(function(){

      var name     = $('#name').val();

      var bill_no     = $('#bill_no').val();

      var from_date   = $('#fromdate').val();

      var status      = $('#status').val();
      var fiscal_year = $('#fiscal_year').val();

      $('#nagadilist').DataTable().destroy();

      fetch_all_data(name, bill_no,from_date, status, fiscal_year);

    });





  });

</script>

