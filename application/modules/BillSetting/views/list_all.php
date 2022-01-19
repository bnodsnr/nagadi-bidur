<style type="text/css">
  i {
    color: #d6d8d9;
  }
</style>
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>BillSetting"> रसिद विवरण </a></li>
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

        <?php $success_message = $this->session->flashdata("MSG_WARN");
        if (!empty($success_message)) { ?>
          <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span> <?php echo $success_message; ?> </span>
          </div>
        <?php } ?>
        <section class="card">
          <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-info-circle pr-2"></i>नगदी रसिद</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-info-circle pr-2"></i> सम्पति/भुमि कर रसिद</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-info-circle pr-2"></i> RESERVED BILLS</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="alert alert-dark" role="alert">
                  <h3 class="text-center">नगदी रसिद (आ .वा: <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?>) </h3>
                </div>

                <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "ADD")) { ?>
                  <a class="btn btn-secondary btn-sm mb-2" style="color:#FFF" href="<?php echo base_url() ?>BillSetting/add"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                <?php } ?>

                <table class=" table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th text-aligh="right">#</th>
                      <th>वडा नं </th>
                      <th>रसिद विवरण</th>
                      <th>रसिद अवस्था</th>
                      <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "EDIT") || $this->authlibrary->HasModulePermission('BILL-SETTING', "DELETE")) { ?>
                        <th class="hidden-phone">.....</th>
                      <?php } ?>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if (!empty($nagadi_bills)) :
                      $i = 1;
                      foreach ($nagadi_bills as $key => $value) : ?>
                        <tr class="gradeX" <?php if ($value['status'] == 1) {
                                              echo 'style="background-color:green; color:#fff"';
                                            } ?>>
                          <td><?php echo $this->mylibrary->convertedcit($i++) ?></td>
                          <td><?php if ($value['ward'] == 0) {
                                echo "नगरपालिका";
                              } else {
                                echo 'वडा नं ' . $this->mylibrary->convertedcit($value['ward']);
                              } ?>( <?php echo $value['name'] ?>)</td>
                          <td><?php echo $value['bill_from'] . '-' . $value['bill_to'] ?></td>
                          <td><?php if ($value['status'] == 1) {
                                echo 'सक्रिय';
                              } else {
                                echo 'निश्क्रिय';
                              } ?></td>
                          <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "EDIT") || $this->authlibrary->HasModulePermission('BILL-SETTING', "DELETE")) { ?>
                            <td class="center hidden-phone">
                              <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "DELETE")) { ?>
                                <?php if ($value['status'] == 1) {
                                ?>
                                  <a href="<?php echo base_url() ?>BillSetting/closeNagadi/<?php echo $value['id'] ?>" class="btn btn-secondary btn-sm" title="close bill" onclick="return confirm('Are you sure want to close?')"><i class='fa fa-times'></i></a>

                                  <button data-url='<?php echo base_url() ?>BillSetting/delete' class='btn btn-danger btn-sm btn-delete' data-id="<?php echo $value['id'] ?>"><i class='fa fa-trash-o'></i></button>
                                <?php } ?>
                              <?php } ?>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php endforeach;
                    else : ?>
                      <tr>
                        <td colspan="4">
                          <div class="alert alert-danger">चालु आर्थिक वर्षको नगदी रसिद नं दाखिला गरिएको छैन.<br><br>
                            <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "ADD")) { ?>
                              <a class="btn btn-secondary btn-sm" style="color:#FFF" href="<?php echo base_url() ?>BillSetting/add"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                            <?php } ?>
                          </div>
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="alert alert-dark" role="alert">
                  <h3 class="text-center">नगदी रसिद (आ .वा: <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?>) </h3>
                </div>

                <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "ADD")) { ?>
                  <a class="btn btn-secondary btn-sm mb-2" style="color:#FFF" href="<?php echo base_url() ?>BillSetting/add"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                <?php } ?>

                <table class=" table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th text-aligh="right">#</th>
                      <th>वडा नं </th>
                      <th>रसिद विवरण</th>
                      <th>रसिद अवस्था</th>
                      <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "EDIT") || $this->authlibrary->HasModulePermission('BILL-SETTING', "DELETE")) { ?>
                        <th class="hidden-phone">.....</th>
                      <?php } ?>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if (!empty($sampati_bills)) :
                      $i = 1;
                      foreach ($sampati_bills as $key => $value) : ?>
                        <tr class="gradeX" <?php if ($value['status'] == 1) {
                                              echo 'style="background-color:green; color:#fff"';
                                            } ?>>
                          <td><?php echo $this->mylibrary->convertedcit($i++) ?></td>
                          <td><?php if ($value['ward'] == 0) {
                                echo "नगरपालिका";
                              } else {
                                echo 'वडा नं ' . $this->mylibrary->convertedcit($value['ward']);
                              } ?>( <?php echo $value['name'] ?>)</td>
                          <td><?php echo $value['bill_from'] . '-' . $value['bill_to'] ?></td>
                          <td><?php if ($value['status'] == 1) {
                                echo 'सक्रिय';
                              } else {
                                echo 'निश्क्रिय';
                              } ?></td>
                          <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "EDIT") || $this->authlibrary->HasModulePermission('BILL-SETTING', "DELETE")) { ?>
                            <td class="center hidden-phone">
                              <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "DELETE")) { ?>
                                <?php if ($value['status'] == 1) {
                                ?>
                                  <a href="<?php echo base_url() ?>BillSetting/closeSampati/<?php echo $value['id'] ?>" class="btn btn-secondary btn-sm" title="close bill" onclick="return confirm('Are you sure want to close?')"><i class='fa fa-times'></i></a>

                                  <button data-url='<?php echo base_url() ?>BillSetting/delete' class='btn btn-danger btn-sm btn-delete' data-id="<?php echo $value['id'] ?>"><i class='fa fa-trash-o'></i></button>
                                <?php } ?>
                              <?php } ?>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php endforeach;
                    else : ?>
                      <tr>
                        <td colspan="4">
                          <div class="alert alert-danger">चालु आर्थिक वर्षको सम्पति कर रसिद नं दाखिला गरिएको छैन.<br><br>
                            <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "ADD")) { ?>
                              <a class="btn btn-secondary btn-sm" style="color:#FFF" href="<?php echo base_url() ?>BillSetting/add"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                              < <?php } ?></div>
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>


              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="alert alert-dark" role="alert">
                  <h3 class="text-center">Reserved Bills (आ .वा: <?php echo $this->mylibrary->convertedcit(get_current_fiscal_year()) ?>) </h3>
                </div>
                <table class="display table table-bordered table-striped">
                  <thead style="background: #1b5693; color:#fff">
                    <tr>
                      <th text-aligh="right">#</th>
                      <th>वडा नं </th>
                      <th>रसिद विवरण</th>
                      <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "EDIT") || $this->authlibrary->HasModulePermission('BILL-SETTING', "DELETE")) { ?>
                        <th class="hidden-phone">.....</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($reserved_bills)) :
                      $i = 1;
                      foreach ($reserved_bills as $key => $value) : ?>
                        <tr class="gradeX">
                          <td><?php echo $this->mylibrary->convertedcit($i++) ?></td>
                          <td><?php echo 'वडा नं ' . $this->mylibrary->convertedcit($value['ward']); ?></td>
                          <td><?php echo $value['bill_from'] . '-' . $value['bill_to'] ?></td>
                          <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "EDIT") || $this->authlibrary->HasModulePermission('BILL-SETTING', "DELETE")) { ?>
                            <td class="center hidden-phone">
                              <?php if ($this->authlibrary->HasModulePermission('BILL-SETTING', "DELETE")) { ?>
                                <button data-url='<?php echo base_url() ?>BillSetting/delete' class='btn-danger btn-sm btn-delete' data-id="<?php echo $value['id'] ?>"><i class='fa fa-trash-o'></i></button>
                              <?php } ?>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php endforeach;
                    else : ?>
                      <td colspan="4">
                        <div class="alert alert-danger">No reserverd bill found for current fiscal year.
                      </td>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>


  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '.btn-delete', function(e) {
        //e.preventDefault();
        var id = $(this).data('id'); //Fetch id from modal trigger button

        var url = $(this).data('url');
        if (confirm("Are you sure want to delete?") == true) {
          $(this).closest('tr').css('backgroundColor', 'red');
          $.ajax({
            type: 'POST',
            url: url, //Here you will fetch records 
            data: {
              id: id,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            }, //Pass $id
            success: function(resp) {
              console.log(resp);
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