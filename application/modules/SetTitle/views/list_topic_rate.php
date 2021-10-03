
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
              <b><?php echo $main_topic['topic_name'].'-'.$s_topic['sub_topic'];?></b>
              <span class="tools">
                <?php if($this->authlibrary->HasModulePermission('SET-TITLE', "ADD")) { ?>
                <a class="btn btn-primary btn-sm pull-right" style="color:#FFF"  href="<?php echo base_url()?>SetTitle/add"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                <?php } ?>
              </span>
              </header>
              <div class="card-body">
                <div class="adv-table">
                  <table  class="able table-bordered table-striped table-condensed display">
                    <thead>
                        <tr>
                          <th text-aligh="right">#</th> 
                          <th>शिर्षक</th>
                          <th>दर</th>
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
                            <td><?php echo $value['topic_title']?></td>
                            <td><?php echo $this->mylibrary->convertedcit($value['rate'])?></td>
                            <?php if($this->authlibrary->HasModulePermission('SET-TITLE', "EDIT") || $this->authlibrary->HasModulePermission('SET-TITLE', "DELETE") ) { ?>
                            <td class="center hidden-phone">
                              <?php if($this->authlibrary->HasModulePermission('SET-TITLE', "EDIT")) { ?>
                                 <a href="<?php echo base_url()?>SetTitle/editSubTopicRate/<?php echo $value['id']?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="शिर्षक सम्पादन गर्नुहोस्"><i class="fa fa-pencil"></i> सम्पादन गर्नुहोस्</a>
                                <?php } ?>
                            </td>
                          <?php } ?>
                        </tr>
                        <?php $i++;endforeach;
                          else : ?>
                                  <td colspan="8"><div class="alert alert-danger">चालु आर्थिक वर्षको मुख्य शिर्षकको दाखिला गरिएको छैन.<br><br><a class="btn btn-secondary" href="#"><i class="fa fa-plus-circle"></i> अगिल्लो आर्थिक वर्षको कपी गर्नुहोस </a></div></td>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#dynamic-table').DataTable({
       'order': false,
    });
  })
</script>