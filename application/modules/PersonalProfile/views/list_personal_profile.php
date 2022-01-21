<style type="text/css">
  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;
  }

  td.details-control {
    background: url('../resources/details_open.png') no-repeat center center;
    cursor: pointer;
  }

  tr.shown td.details-control {
    background: url('../resources/details_close.png') no-repeat center center;
  }
</style>
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="javascript:;">व्यक्तिगत अभिलेख</a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <?php $success_message = $this->session->flashdata("MSG_SUCCESS");
        if (!empty($success_message)) { ?>
          <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span> <?php echo $success_message; ?> </span>
          </div>
        <?php } ?>
        <section class="card">
          <header class="card-header">
            <div class="mail-option">
              <div class="btn-group hidden-phone">
                <input type="text" class="form-control" id="file_no" placeholder="क्र.स नम्बर:">
              </div>
              <div class="btn-group hidden-phone">
                <input type="text" class="form-control" id="org_name" placeholder="जग्गाधनिको नाम" style="width: 170px;">
              </div>
              <div class="btn-group hidden-phone">
                <input type="text" class="form-control" id="darta_no" placeholder="नगरिकता नं" style="width: 90px;">
              </div>
              <div class="btn-group hidden-phone">
                <input type="text" class="form-control" id="contact_no" placeholder="सम्पर्क नं">
              </div>
              <div class="btn-group hidden-phone">
                <!-- <input type="text" class="form-control" id="contact_no" placeholder="सम्पर्क नं" style="width: 190px;"> -->
                <select class="form-control" id="paid_status">
                  <option value="">अवस्था</option>
                  <option value="2">रसिद नकाटिएको प्रोफाइल</option>
                  <option value="1">रसिद काटिएको प्रोफाइल </option>
                </select>
              </div>
              <div class="btn-group hidden-phone">
                <div class="">
                  <button type="button" class="btn btn-warning" title="खोजी गर्नुहोस्" id="filter">खोजी गर्नुहोस्</button>
                </div>
              </div>
              <?php if ($this->authlibrary->HasModulePermission('PERSONAL-PROFILE', "ADD")) { ?>
                <div class="float-right position">
                  <a class="btn btn-primary " href="<?php echo base_url() ?>PersonalProfile/CreateProfile" style="color:#FFF;margin-top: 2px;"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                </div>
              <?php } ?>
            </div>
            </span>
          </header>
          <div class="card-body">
            <div class="adv-table">

              <div class="alert alert-info">
                <b> नोट:- पुरानो प्रोफाइलमा जग्गा कित्ताकाट वा थप्नु परेमा प्रोफाइलमा गइ जग्गा सम्पादनमा गइ जग्गा थप्नुहोस बाट जुन कित्ता हो त्यसलाई बदर गरि नया कायम कित्ता थप गरि मुल्यांकन गर्न सकिन्छ ( किनबेच , अंशबन्डा , थपघटलाई सोहि अनुसार गर्नुहोस कैफियतमा खुलाएर कारण लेख्नुहोस ) l
                </b>
              </div>
              <table class="display table table-bordered table-striped" id="listtable">
                <thead style="background: #1b5693; color:#fff">
                  <tr>
                    <th text-aligh="right">#</th>
                    <th text-aligh="right">प्रोफाइल बनेको मिति</th>
                    <th> क्र.स नम्बर</th>
                    <th>जग्गाधनिको नाम</th>
                    <th>नगरिकता नं</th>
                    <th>सम्पर्क नं</th>
                    <th>कर तिरेको छ वा छैन ?</th>
                    <th class="hidden-phone"></th>
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
<script type="text/javascript">
  $(document).ready(function() {
    fetch_all_data();

    function fetch_all_data(file_no, org_name, darta_no, contact_no, paid_status) {
      var oTable = $('#listtable').DataTable({
        // "order": [[ 0, "ASC" ]],

        // "columnDefs": [ { type: 'id', 'targets': [4] } ],
        "order": [
          [0, 'desc']
        ],
        "searching": false,
        'lengthChange': false,
        "processing": true,
        "serverSide": true,
        'language': {
          'loadingRecords': '&nbsp;',
          'processing': '<div class="spinner"></div>'
        },
        "ajax": {
          "url": "<?php echo base_url('PersonalProfile/GetProfileList') ?>",
          "dataType": "json",
          "type": "POST",
          "data": {
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
            file_no: file_no,
            org_name: org_name,
            darta_no: darta_no,
            contact_no: contact_no,
            paid_status: paid_status
          }
        },
        "columns": [{
            "data": "sn"
          },
          {
            "data": "date"
          },
          {
            "data": "file_no"
          },
          {
            "data": "org_name"
          },
          {
            "data": "reg_num"
          },
          {
            "data": "contact_no"
          },
          {
            "data": "",
            render: function(data, type, row) {
              if (row.is_paid == "Paid") {
                var res = '<a href="<?php echo base_url() ?>SampatiKarRasid/viewRasid/' + row.file_no_en + '"" class= "btn btn-shadow btn-success btn-sm" target="_blank"><i class="fa fa-check-circle"></i> भुक्तान गरिएको छ</a>';
              } else {
                var res = '<a href="<?php echo base_url() ?>SampatiKarRasid/CreateBills/' + row.file_no_en + '" class= "btn btn-shadow btn-danger btn-sm" target="_blank"><i class="fa fa-times-circle"></i>  रसिद कट्नुहोस</a>';
              }
              return res;
            },
            "bVisible": true,
            "bSearchable": false,
            "bSortable": false
          },
          {
            "data": "",
            render: function(data, type, row) {
              var res = '<div class="btn-group">' +
                '<button type="button" class="btn btn-warning btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                'सम्पादन गर्नुहोस् </button>' +
                '<div class="dropdown-menu">';

              <?php if ($this->authlibrary->HasModulePermission('PERSONAL-PROFILE', 'VIEW')) { ?>
                res += '<a class="dropdown-item" href="<?php echo base_url() ?>PersonalProfile/view/' + row.file_no_en + '"><i class="fa  fa-hand-o-right"></i> प्रोफाइल हेर्नुहोस</a>';
              <?php } ?>

              <?php if ($this->authlibrary->HasModulePermission('PERSONAL-PROFILE', 'EDIT')) { ?>

                res += '<a class="dropdown-item" href="<?php echo base_url() ?>LandDetails/veiwLandDescription/' + row.file_no_en + '"><i class="fa  fa-hand-o-right"></i> जग्गाको विवरण</a>' +
                  '<a class="dropdown-item" href="<?php echo base_url() ?>SanrachanaDetails/veiwDetails/' + row.file_no_en + '"><i class="fa  fa-hand-o-right"></i> संरचनाको विवरण</a>' +
                  '<a class="dropdown-item" href="<?php echo base_url() ?>PersonalProfile/editProfile/' + row.id + '"><i class="fa  fa-hand-o-right"></i> प्रोफाइल सम्पादन </a>' +

                  '<a class="dropdown-item" href="<?php echo base_url() ?>PersonalProfile/transferProfile/' + row.file_no_en + '"><i class="fa  fa-hand-o-right"></i> एकाघरमा नामसारी</a>';
              <?php } ?>
              <?php if ($this->authlibrary->HasModulePermission('PERSONAL-PROFILE', 'DELETE')) { ?>
                res += '<button class="dropdown-item btn-delete" data-url="<?php echo base_url() ?>PersonalProfile/deleteProfile/" data-id = "' + row.file_no_en + '" ><i class="fa  fa-hand-o-right"></i> प्रोफाइल हटाउनुहोस्</button>';
              <?php } ?>
              res += '</div"></div>';

              return res;
            },
            "bVisible": true,
            "bSearchable": false,
            "bSortable": false
          },

        ]
      });
    }

    $('#filter').click(function() {
      var file_no = $('#file_no').val();
      var org_name = $('#org_name').val();
      var darta_no = $('#darta_no').val();
      var contact_no = $('#contact_no').val();
      var paid_status = $('#paid_status').val();

      $('#listtable').DataTable().destroy();
      fetch_all_data(file_no, org_name, darta_no, contact_no, paid_status);
    });

    $(document).on('click', '.btn-delete', function(e) {
      //e.preventDefault();
      var id = $(this).data('id'); //Fetch id from modal trigger button
      var url = $(this).data('url');
      //alert(url);
      if (confirm("Are you sure want to delete?") == true) {
        $.ajax({
          type: 'POST',
          url: url, //Here you will fetch records 
          data: {
            id: id,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          }, //Pass $id
          success: function(resp) {
            //   return;
            if (resp.status == 'success') {
              toastr.options = {
                "closeButton": true,
                "debug": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "200",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              };
              toastr.success(resp.data);
              setTimeout(function() {
                location.reload();
              }, 2000);
            } else {
              toastr.options = {
                "closeButton": true,
                "debug": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              };
              toastr.success(resp.data);
              setTimeout(function() {
                location.reload();
              }, 2000);
            }
          }
        });
      } else {
        return false;
      }
    });
  });
</script>