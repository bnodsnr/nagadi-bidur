 <!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="">शिर्षकगत रिपोर्ट</a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <section class="card">
            <header class="card-header">
              <div class="row">
                <div class="col-md-3">
                 <select class="form-control search_added_ward" style="width:300px;" id="ward_no">
                  <option value="">वडा छानुहोस</option>
                  <?php if(!empty($wards)) : 
                    foreach ($wards as $key => $ward) : ?>
                      <option value="<?php echo $ward['ward']?>"><?php 
                      if($ward['ward'] == '0') {
                        echo 'पालिका';
                      } else {
                        echo $this->mylibrary->convertedcit($ward['ward']);
                      }
                      ?></option>
                    <?php endforeach;endif;?>
                  </select>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                     <input type="text" id="from_date" class="form-control nepali-calendar" value="" placeholder="देखी मिति " />
                    <div class="input-group-prepend">
                      <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button>
                    </div>
                  </div> 
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <input type="text" id="to_date" class="form-control nepali-calendar" value="" placeholder="सम्म मिति" />
                    <div class="input-group-prepend">
                      <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="">
                    <button type="button" class="btn btn-warning" title="खोजी गर्नुहोस्" id="filter"><i class="fa fa-search"></i> खोजी गर्नुहोस्</button>
                  </div>
                </div>
              </div>
              </span>
            </header>
            <div class="card-body">
              <div class="search_div">
                <table class="table table-bordered table-stripe print_table" id="">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>शिर्षक नं</th>
                          <th>शिर्षक</th>
                          <td>रकम</td>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>१</td>
                      <td>११३१३</td>
                      <td>एकीकृत सम्पती कर</td>
                      <td><?php echo $this->mylibrary->convertedcit($sampatikar['sampati_total'] + $sampatikar['ba_amount'] + $sampatikar['fa_amount'] +$sampatikar['oa_amount'])?> </td>
                    </tr>
                    <tr>
                      <td>२</td>
                      <td>११३१४</td>
                      <td>भुमिकर/मालपोत</td>
                      <td><?php echo $this->mylibrary->convertedcit($bhumikar['bhumi_total']) ?> </td>
                    </tr>
                    <?php if(!empty($reports)) :
                      $i =2;
                      $total = 0;
                      foreach($reports as $key => $report): ?>
                    <tr>
                      <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                      <td>--</td>
                    <!--   <td><?php //echo $report['topic_name']?></td> -->
                      <td><?php echo $report['sbutopic']?></td>
                      <td><?php echo $this->mylibrary->convertedcit(round($report['total'],2))?></td>
                      <?php $total += $report['total'] ?>
                    </tr>
                  <?php endforeach;endif;?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3" align="right">जम्मा </td>
                      <td><?php echo $this->mylibrary->convertedcit(round($total + $sampatikar['sampati_total'] + $sampatikar['ba_amount'] + $sampatikar['fa_amount'] +$sampatikar['oa_amount'] +$bhumikar['bhumi_total']))?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
                
            </div>
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
 </section>

 <script type="text/javascript" src="<?php echo base_url('assets/nepali_datepicker/nepali.datepicker.v2.2.min.js')?>"></script>

<script type="text/javascript">

  $(document).ready(function() {
    var date = "<?php echo convertDate(date('Y-m-d'))?>";
    $('#nepaliDateD').nepaliDatePicker({});
    $('.nepali-calendar').nepaliDatePicker({});
      $(document).on('click', '#filter', function(){
        var obj = $(this);
        var from_date = $('#from_date').val();
        var to_date  = $('#to_date').val();
        var search_added_ward = $('.search_added_ward').val();
        var user_id = $('#user_id').val();
        $.ajax({
          method:"POST",
          url:"<?php echo base_url()?>NagadiTitleWiseReport/Search",
          data:{
            from_date:from_date,
            to_date:to_date,
            search_added_ward:search_added_ward,
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
           beforeSend: function () {
            obj.html('<i class="fa fa-spinner fa-spin"></i> <i class="fa fa-search"></i> खोज्नुहोस');
          },
          success:function(resp){
            if(resp.status == 'success') {
              $('.search_div').empty().html(resp.data);
              obj.html(' <i class="fa fa-search"></i> खोज्नुहोस');
            }
          }
        });
      });
    });
  </script>