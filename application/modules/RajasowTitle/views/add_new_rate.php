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
                    <td><input type="checkbox" name="rates[]" <?php if($item['sub_topic_no'] == $topic_no){echo 'checked';}?> value="<?php echo $item['rate_id']?>">
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
  <?php echo form_close()?>