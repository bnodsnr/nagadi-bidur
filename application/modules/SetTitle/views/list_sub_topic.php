
<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>SetTitle"><i class="fa fa-home"></i> शिर्षकहरुको सूची</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;">सह शिर्षक</a></li>
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
                    <?php echo $this->mylibrary->convertedcit($main_topic['topic_no'])?> :-<?php echo $main_topic['topic_name']?>
                    <span class="tools">
                      <?php if($this->authlibrary->HasModulePermission('SET-TITLE', "ADD")) { ?>
                      <a class="btn btn-primary btn-sm pull-right" style="color:#FFF"  href="<?php echo base_url()?>SetTitle/add"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                      <?php } ?>
                    </span>
                    </header>
                    <div class="card-body">
                      <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                          <thead>
                              <tr>
                                <th text-aligh="right">#</th> 
                                <th text-aligh="right">शिर्षकको नाम  </th> 
                                <!-- <th>शिर्षकको नं </th> -->
                                 <?php if($this->authlibrary->HasModulePermission('SET-TITLE', "EDIT") || $this->authlibrary->HasModulePermission('SET-TITLE', "DELETE") ) { ?>
                                  <th class="hidden-phone">.....</th>
                                <?php } ?>
                              </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($sub_topic)) :
                              $i = 1;
                              foreach($sub_topic as $key => $value) : ?>
                              <tr class="gradeX">
                                  <td><?php echo $this->mylibrary->convertedcit($i)?></td>
                                  <td><?php echo $value['sub_topic']?></td>
                                  <!-- <td><?php echo $value['topic_no']?></td> -->
                                  <?php if($this->authlibrary->HasModulePermission('SET-TITLE', "EDIT") || $this->authlibrary->HasModulePermission('SET-TITLE', "DELETE") ) { ?>
                                  <td class="center hidden-phone">
                                    <?php if($this->authlibrary->HasModulePermission('SET-TITLE', "EDIT")) { ?>
                                       <button type="button" data-toggle="modal" class="btn btn-primary btn-sm" href="#editModel" title="शिर्षक सम्पादन गर्नुहोस्" data-url="<?php echo base_url()?>SetTitle/EditSubTopicDetails" data-id = "<?php echo $value['id']?>"><i class="fa fa-pencil"></i> सम्पादन गर्नुहोस्</button>
                                       <a href="<?php echo base_url()?>SetTitle/topicRate/<?php echo $value['id']?>" class="btn btn-warning btn-sm">  शिर्षकहरुको सूची दर</a>
                                      <?php } ?>
                                  </td>
                                <?php } ?>
                              </tr>
                              <?php $i++; endforeach;
                                else : ?>
                                  <td colspan="8"><div class="alert alert-danger">चालु आर्थिक वर्षको सह शिर्षक दाखिला गरिएको छैन.<br><br><a class="btn btn-secondary" href="#"><i class="fa fa-plus-circle"></i> अगिल्लो आर्थिक वर्षको कपी गर्नुहोस </a></div></td>
                              <?php  endif; ?>
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
   
  