
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">भूमिका</a></li>
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
        
            <section class="card" style="margin-bottom: -25px;">
              <header class="card-header">
               भूमिका सूची
                  <span class="tools">
                   <button type="button" data-toggle="modal" class="btn btn-primary btn-sm pull-right" href="#addModel" data-url="<?php echo base_url()?>Groups/AddGroup" data-id = "">नयाँ थप्नुहोस्</button>
                </span>
              </header>
              <div class="card-body">
                <div class="adv-table">
                  <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead style="background: #1b5693; color:#fff">
                        <tr>
                          <th text-aligh="right">#</th> 
                          <th>भूमिका</th>
                          <th class="hidden-phone">.....</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($groups)) :
                        $i = 1;
                        foreach($groups as $key => $value) : ?>
                        <tr class="gradeX">
                            <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                            <td><?php echo $this->mylibrary->convertedcit($value['group_name'])?></td>
                            <td class="center hidden-phone">
                              <button type='button' data-toggle='modal' href='#editModel' class='btn-primary btn-sm' data-url='<?php echo base_url()?>Groups/EditGroup' data-id = "<?php echo $value['groupid']?>">विवरण सम्पादन गर्नुहोस </button>
                             <a href = "<?php echo base_url()?>Groups/EditGroupPerm/<?php echo $value['groupid']?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" >अनुमति प्रबन्ध गर्नुहोस्</a>
                             <!--  <button class="btn btn-warning btn-sm" data-toggle="tooltip" title="मेटाउनुहोस्" data-toggle ="modal" data-target =""><i class="fa fa-trash-o"></i></button> -->
                            </td>
                        </tr>
                        <?php endforeach;endif; ?>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url()?>assets/js/customjs.js"></script>
   