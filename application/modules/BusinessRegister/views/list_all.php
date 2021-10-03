<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item active"><a href="javascript:;" class="bactive">व्यावसायको दर्ता अभिलेख</a></li>
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
                व्यावसायको दर्ता सूची
                  <span class="tools">
                  <?php if($this->authlibrary->HasModulePermission('BUSINESS-REGISTER', "ADD")) { ?>
                    <a href = "<?php echo base_url()?>BusinessRegister/addNew" class=" btn btn-primary btn-sm pull-right" title=""><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                  <?php } ?>
                  
                </span>
              </header>
              <div class="card-body">
                <div class="adv-table">
                  <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead style="background: #1b5693; color:#fff">
                        <tr>
                          <th>#</th>
                          <th>दर्ता नं</th>
                          <th>व्यावसायीको नाम.</th>
                          <th>ठेगाना( हालको )</th>
                          <th>सम्पर्क नं </th>
                          <th>उद्योग / व्यावसायको नाम</th>
                          <th>फोटो</th>
                          <th class="hidden-phone"></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      if(!empty($lists)) :
                        $i = 1;
                        foreach ($lists as $key => $list) : ?>
                          <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                          <td><?php echo $this->mylibrary->convertedcit($list['id'])?></td>
                            <td><?php echo $list['owner_name']?></td>
                          <td><?php echo $list['owner_present_na'].'-'.$list['owner_present_tol'].'-'.$this->mylibrary->convertedcit($list['owner_present_ward'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($list['owner_number'])?></td>
                            <td><?php echo $this->mylibrary->convertedcit($list['firm_name_nepali'])?></td>
                            <td>
                              <?php if(!empty($list['userfile'])){
                                $image_name = $list['userfile'];
                              } else {
                                $image_name = 'owner.png';
                              }?>
                              <img src="<?php echo base_url()?>assets/business_owner/<?php echo $image_name?>" style="height: 50px;width: 50px;">
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>BusinessRegister/ViewDetails/<?php echo $list['id']?>" target="_blank"> विवरण हेर्नुहोस</a>
                            </td>
                          </tr>
                     <?php endforeach; endif;?> 
                    </tbody>
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
  $(document).ready(function(){
    $('#dynamic-table').DataTable({
      "language": {
        "search": "खोज्नुहोस"
      },
      'order': false,
      
    });
  })
</script>
    
   