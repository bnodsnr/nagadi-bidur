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
        <section class="card">
          <header class="card-header">
            <strong> <h3><?php echo !empty($title)?$title['topic_name'].'-'.$this->mylibrary->convertedcit($title['topic_id']):'';?> </h3></strong>
            <form role="form" action="<?php echo base_url()?>RajasowTitle/EditTopicRates/" method="post" class="form save_post">
              
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <span class="tools pull-right">
                <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
                <a href="<?php echo base_url()?>Users" id="cancel_button" class="btn btn-sm btn-danger " style="color:#FFF"><i class="fa fa-remove"></i> Cancel</a>
              </span>
          </header>
          <div class="card-body">
            <select class="form-control select_option" name="rajasow_title" required="true">
              <option value="">राजश्व आम्दानी शिर्षक छानुहोस </option>
              <?php if(!empty($titles)) :
                foreach ($titles as $key => $title) : ?>
                  <option value="<?php echo $title['topic_id']?>"><?php echo $title['topic_id'].'-'.$title['topic_name']?></option>
              <?php endforeach;endif;?>
            </select>
            <hr>
            <div class="row">
              <?php if(!empty($report)) :
              foreach($report as $key => $items): ?>
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-header"><?php echo $key?></div>
                    <div class="card-body">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th></th>
                            <th>मुख्य शिर्षक</th>
                            <th>सह शिर्षक</th>
                            <th>शिर्षक</th>
                            <th>दर</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($items as $item) : ?>
                            <tr>
                              <td><input type="checkbox" name="rate_id[]" value="<?php echo $item['rate_id']?>">
                              </td>
                              <td><?php echo $item['main_topic_name']?> </td>
                              <td><?php echo $item['subtitle']?> </td>
                              <td><?php echo $item['topic_title']?> </td>
                              <td><?php echo $item['rate']?></td>
                            </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              <?php endforeach; endif;?>
            </div>
          </div>
          <?php echo form_close()?>
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
</section>
<script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('.select_option').select2();
    // $(document).on('change','#rajasow_title', function(){
      
    // });
  });
</script>