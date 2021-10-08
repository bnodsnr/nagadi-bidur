<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item" ><a href="<?php echo base_url()?>RajasowTitle/" > राजश्व आम्दानी शिर्षक</a></li>
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
          राजश्व आम्दानी शिर्षक
              <?php if($this->authlibrary->HasModulePermission('RAJASOW-TITLE', "ADD")) { ?>
               <a href="<?php echo base_url()?>RajasowTitle/addRates/"  class="btn btn-warning pull-right" style="margin-left: 20px;"><i class="fa fa-info-circle"></i> राजश्व आम्दानी शिर्षक सम्पादन गर्नुहोस</a>
                <button type="button" data-toggle="modal" href="#addModel" class="btn btn-primary pull-right" title="थप्नुहोस्" data-url="<?php echo base_url()?>RajasowTitle/add" data-id = ""><i class="fa fa-plus-circle"></i> शिर्षक थप्नुहोस्</button>
             <?php } ?>
          
         </header>
         <div class="card-body">
          <div class="adv-table">
            <table  class="table table-inbox table-bordered table-striped">
              <thead style="background: #1b5693; color:#fff">
                <tr>
                  <th text-aligh="right">#</th>
                  <th> शिर्षक नम्बर </th>
                  <th> आम्दानी शिर्षक</th>
                  <th> आनुमनित रकम </th>
                  <th> </th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($datas)) :
                  $i = 1;
                  $total_income = 0;
                  foreach($datas as $key => $value) : 
                    $total_income += $value['annual_income']; 
                  ?>
                    <tr class="gradeX">
                      <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                      <td><a href="<?php echo base_url()?>RajasowTitle/View/<?php echo $value['topic_id']?>"><?php echo $this->mylibrary->convertedcit($value['topic_id'])?></a></td>
                      <td><?php echo $this->mylibrary->convertedcit($value['topic_name'])?></td>
                      <td><?php echo $this->mylibrary->convertedcit(number_format($value['annual_income']))?></td>
                      
                      <?php if($this->authlibrary->HasModulePermission('RAJASOW-TITLE', "EDIT") || $this->authlibrary->HasModulePermission('RAJASOW-TITLE', "DELETE") ) { ?>
                        <td class="center hidden-phone">
                          <?php if($this->authlibrary->HasModulePermission('RAJASOW-TITLE', "EDIT")) { ?>
                            <a href="<?php echo base_url()?>RajasowTitle/View/<?php echo $value['topic_id']?>" class="btn btn-warning"><i class="fa fa-eye"></i> नगदी शिर्षक हेर्नुहोस</a>
                            <button type="button" data-toggle="modal" href="#editModel" class="btn btn-primary" data-url="<?php echo base_url()?>RajasowTitle/edit" data-id = "<?php echo $value['id']?>"><i class="fa fa-edit"></i> राजश्व आम्दानी शिर्षक सम्पादन गर्नुहोस </button>
                          <?php } ?>
                        
                        </td>
                      <?php } ?> 
                    </tr>
                  <?php endforeach;endif; ?>
                  <tr>
                    <td colspan="3">जम्मा आनुमनित रकम</td>
                    <td colspan="2"><?php echo $this->mylibrary->convertedcit(number_format($total_income))?> </td>
                  </tr>
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