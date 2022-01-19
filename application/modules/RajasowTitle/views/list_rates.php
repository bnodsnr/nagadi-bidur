<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i>गृहपृष्ठ</a></li>
        <li class="breadcrumb-item" ><a href="<?php echo base_url()?>RajasowTitle/">राजश्व आम्दानी शिर्षक</a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <section class="card">
          <div class="card-body">
            <strong> <h1 class="text-center"><?php echo !empty($title)?$title['topic_name'].'-'.$this->mylibrary->convertedcit($title['topic_id']):'';?> </h1></strong>
            <div class="row">
              <div class="col-md-12">
                <?php if(!empty($sub_topics)) :?>
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th></th>
                      <th>शिर्षक</th>
                      <th>शिर्षक नं</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; foreach($sub_topics as $item) : ?>
                    <tr>
                      <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                      <td><i class="fa fa-check-circle" style="color:green"></i> <?php echo $item['topic_title']?> (आर्थिक वर्ष-<?php echo $this->mylibrary->convertedcit($item['fiscal_year'])?>)</td>
                      <td><?php echo $this->mylibrary->convertedcit($item['topic_no'])?></td>
                      <td><button type="button" data-toggle="modal" href="#editModel" class="btn btn-primary" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>RajasowTitle/editTopicNo" data-id = "<?php echo $item['id']?>"><i class="fa fa-pencil"></i> शिर्षक नं सम्पादन गर्नुहोस</button></a></td>
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
                <?php else: ?>
                  <div class="alert alert-danger">राजश्व आम्दानी शिर्षक नगदी शिर्षक दाखिला गरिएको छैन</div>
                <?php endif;?>
              </div>
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
  });
</script>