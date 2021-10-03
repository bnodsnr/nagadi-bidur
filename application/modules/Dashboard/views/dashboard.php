<section id="main-content">

  <section class="wrapper">

    <section class="">



      <div class="revenue-head">

          <span>

               <img src="<?php echo base_url()?>assets/img/npl.png" style="width: 54px;">

          </span>

          <h3 class="text-center"><?php echo GNAME?> -<?php echo $this->mylibrary->convertedcit(current_fiscal_year())?>   </h3>

          <span class="rev-combo pull-right">

            <!--  आर्थिक वर्ष :- 

          </span> -->



          <div class="input-group">

            <input type="text" name="form_filler_date" class="form-control" value="<?php echo $this->mylibrary->convertedcit(convertDate(date('Y-m-d')))?> <?php echo $this->mylibrary->convertedcit(date('H:i'))?> " readonly="" data-fillr-id="1591891198" data-fillr="bound" autocomplete="off">

            <div class="input-group-prepend">

              <button type="button" class="input-group-text btn btn-danger" title="" style="background: radial-gradient(#ffffff, transparent);border: none"><i class="fa fa-calendar" style="color:#1b5693;background: radial-gradient(#ffffff, transparent);"></i></button>

            </div>

          </div>

      </div>

      <br>

      <div class="row state-overview">

        <div class="col-lg-3 col-sm-6">

            <section class="card">

                <div class="symbol terques">

                    <i class="fa fa-info-circle"></i>

                </div>

                <div class="value">

                    <h1 class="count"><?php echo !empty($totalProfile)? $this->mylibrary->convertedcit(number_format($totalProfile)):$this->mylibrary->convertedcit(0)?> </h1>

                    <a href="<?php echo base_url()?>PersonalProfile/ProfileDetailView"><b>जग्गाधनी प्रोफाइल</b></a>

                </div>

            </section>

        </div>





        <div class="col-lg-3 col-sm-6">

            <section class="card">

                <div class="symbol yellow">

                    <i class="fa fa-info-circle"></i>

                </div>

                <div class="value">

                    <h1 class=" count3"><?php echo !empty($totalSampatiBhumiKar)? $this->mylibrary->convertedcit(number_format($totalSampatiBhumiKar->total)):$this->mylibrary->convertedcit(0)?></h1>

                    <p>जम्मा सम्पति-भूमिकर कर संकलन</p>

                </div>

            </section>

        </div>

        <div class="col-lg-3 col-sm-6">

            <section class="card">

                <div class="symbol blue">

                    <i class="fa fa-info-circle"></i>

                </div>

                <div class="value">
                    <h1 class=" count4">
                      <?php
                        $total_nagadi_sum = 0; 
                        if(!empty($bankDetails)) :
                          foreach ($bankDetails as $key => $value) :
                           // pp($value['total_nagadi']);
                            $total_nagadi_sum += $value['total_nagadi'];
                            //echo $value['total_nagadi'];
                          endforeach; endif;
                      ?>

                         <?php  //echo !empty($totalNagadi)? $this->mylibrary->convertedcit(number_format($totalNagadi->total)):$this->mylibrary->convertedcit(0)
                        echo $this->mylibrary->convertedcit(round($total_nagadi_sum))?></h1>
                    <p> जम्मा नगदी कर संकलन</p>
                </div>
            </section>
        </div>

        <div class="col-lg-3 col-sm-6">

            <section class="card">

                <div class="symbol red">

                    <i class="fa fa-info-circle"></i>

                </div>

                <div class="value">

                    <h1 class=" count2">
                    <?php 
                      $total = $totalSampatiBhumiKar->total + $total_nagadi_sum;
                      $total_collection = $this->mylibrary->convertedcit(number_format($total));
                      echo $total_collection;
                    ?></h1>

                    <p>जम्मा कर संकलन</p>

                </div>

            </section>

        </div>

      </div>

      <div class="row">

        <div class="col-lg-3">

          <div class="card terques-chart">

              <div class="chart-tittle">

                <span class="title">नगदी कर संकलन </span>

              </div>

              <div class="card-body">

                <canvas id="npie" height="295px" width="300px" style="background-color: none;color:#FFF"></canvas>

              </div>

          </div>

        </div>



        <div class="col-lg-3">

          <div class="card red-chart">

              <div class="chart-tittle">

                <span class="title">सम्पति-भूमि कर संकलन</span>

              </div>

              <div class="card-body">

                <canvas id="spie" height="295px" width="300px" style="background-color: none;color:#FFF"></canvas>

              </div>

          </div>

        </div>



        <div class="col-lg-6">

            <!--total earning start-->

            <div class="card green-chart">

              <div class="chart-tittle">

                <span class="title">वडा अनुसार सम्पति-भूमिकर / नगदी कर संकलन </span>

              </div>

              <div class="card-body">

                <canvas id="bar" height="300px" width="709px" style="background-color: none;color:#FFF"></canvas>

              </div>



            </div>

            

            <!--total earning end-->

        </div>

      </div>

      <!-- details widget -->

      <div class="row">

        <div class="col-lg-6">

            <section class="card">

                <header class="card-header bg-primary text-light">

                    जग्गाधनी प्रोफाइल

                </header>

                <div class="card-body">

                     <aside class="profile-nav alt green-border">

                      <section class="card">

                          <ul class="nav nav-pills nav-stacked">

                              <li class="nav-item"><a class="nav-link" href="javascript:;"> <i class="fa fa-info-circle" style="color:#000"></i> जम्मा जग्गाधनी प्रोफाइल <span class="badge badge-primary pull-right r-activity">

                                <?php echo !empty($totalProfile)? $this->mylibrary->convertedcit(number_format($totalProfile)):$this->mylibrary->convertedcit(0)?>

                              </span></a></li>

                              <li class="nav-item"><a class="nav-link" href="javascript:;"> <i class="fa fa-info-circle" style="color:#000"></i> रसिद काटिएको प्रोफाइल<span class="badge badge-info pull-right r-activity">

                                <?php echo !empty($TotalPaidProfile)? $this->mylibrary->convertedcit($TotalPaidProfile):$this->mylibrary->convertedcit(0)?>

                              </span></a></li>

                              <li class="nav-item"><a class="nav-link" href="javascript:;"> <i class="fa  fa-info-circle" style="color:#000"></i> रसिद काट्न बाकि प्रोफाइल<span class="badge badge-warning pull-right r-activity">

                                <?php $dueProfile = $totalProfile - $TotalPaidProfile;

                                    echo !empty($dueProfile)? $this->mylibrary->convertedcit(number_format($dueProfile)):$this->mylibrary->convertedcit(0);

                                ?>

                              </span></a></li>

                          </ul>

                      </section>

                  </aside>

                </div>

            </section>

        </div>

        <div class="col-lg-6">

           <section class="card">

                <header class="card-header bg-primary text-light">

                    जम्मा कर संकलन

                </header>

                <div class="card-body">

                     <aside class="profile-nav alt green-border">

                      <section class="card">

                          <ul class="nav nav-pills nav-stacked">

                              <li class="nav-item"><a class="nav-link" href="javascript:;"><i class="fa fa-info-circle" style="color:#000"></i> दैनिक कर संकलन खाता <span class="badge badge-primary pull-right r-activity">

                                <?php $toady_collection =  $today_sampati_bhumi_collection->total+$today_nagadi_collection->total_nagadi;

                                      echo  $this->mylibrary->convertedcit(number_format($toady_collection))?>

                              </span></a></li>

                              <!-- <li class="nav-item"><a class="nav-link" href="javascript:;">दैनिक वडागत आम्दानी<span class="badge badge-primary pull-right r-activity">19</span></a></li> -->

                              <li class="nav-item"><a class="nav-link" href="javascript:;"><i class="fa fa-info-circle" style="color:#000"></i> मासिक कर संकलन <span class="badge badge-warning pull-right r-activity">

                                <?php $monthly_collection = $monthly_sampati_bhumi_collection->total+ $monthly_nagadi_collection->total_nagadi; 

                                echo $this->mylibrary->convertedcit(number_format($monthly_collection));

                                ?>



                              </span></a></li>

                              <li class="nav-item"><a class="nav-link" href="javascript:;"><i class="fa fa-info-circle" style="color:#000"></i> समग्र नगदी / सम्पति-भूमिकर<span class="badge badge-info pull-right r-activity">

                                <?php $total = $totalSampatiBhumiKar->total + $totalNagadi->total;

                                              $total_collection = $this->mylibrary->convertedcit(number_format($total));

                                          echo $total_collection;

                                ?>



                              </span></a></li>

                          </ul>

                      </section>

                  </aside>

                </div>

            </section>

        </div>

      </div>

      <div class="row">
          <div class="col-lg-12">
             <section class="card">
                  <header class="card-header bg-primary text-light">बैंक दाखिला फारम</header>
                  <div class="card-body">
                       <aside class="profile-nav alt green-border">
                        <section class="card">
                          <table class="table table-hover personal-task">
                            <thead>
                              <tr>
                                <th>वडा </th>
                                <th style="text-align: right">जम्मा संकलन रकम </th>
                                <th style="text-align: right">दाखिला गरेको रकम </th>
                                <th style="text-align: right">दाखिला गर्न बाकी रकम</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              
                              if(!empty($bankDetails)) : 
                              	$due_amount = 0;
                              	$total_collection = 0;
                              	$total_deposit_amount = 0;
                                foreach ($bankDetails as $key => $bank) :
                                	
                                ?>
                                <tr>
                                  <td><?php 
                                  if($bank['ward'] == 0) {
                                    echo 'पालिका';
                                  } else {
                                    echo 'वडा नं '. $this->mylibrary->convertedcit($bank['ward']);
                                  }
                                  ?></td>
                                  <td style="text-align: right"><?php echo $this->mylibrary->convertedcit(round($bank['total_collection']))?></td>
                                  <td style="text-align: right"><?php echo $this->mylibrary->convertedcit(round($bank['deposit_amount']))?></td>

                                  <?php $total_coll_amts = round($bank['total_collection']);
                                      $total_deposit_amts = round($bank['deposit_amount']);
                                      $total_dues = $total_coll_amts - $total_deposit_amts;
                                    ?>


                                  <td style="text-align: right"><?php echo $this->mylibrary->convertedcit($total_dues)?></td>
                                <?php 
                                  $due_amount += $bank['due_amount'];
                              		$total_collection += $bank['total_collection'];
                              		$total_deposit_amount += $bank['deposit_amount'];
                              	?>
                                </tr>
                              <?php endforeach;endif;?>
                            </tbody>
                            <tfoot style="background-color: #007bff;color:#fff">
                            	<tr>
                            		<td>जम्मा </td>
                            		<td style="text-align: right"><?php echo $this->mylibrary->convertedcit(round($total_collection))?></td>
                            		<td style="text-align: right"><?php echo $this->mylibrary->convertedcit(round($total_deposit_amount))?></td>

                                <?php $total_coll_amt = round($total_collection);
                                      $total_deposit_amt = round($total_deposit_amount);
                                      $total_due = $total_coll_amt - $total_deposit_amt;?>
                            		<td style="text-align: right"><?php echo $this->mylibrary->convertedcit($total_due)?></td>
                            	</tr>
                            </tfoot>
                          </table>
                        </section>
                    </aside>
                  </div>
              </section>
          </div>
      </div>

    </section>

  </section>

</section>

<script src="<?php echo base_url()?>assets/js/jquery.sparkline.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/sparkline-chart.js"></script>

<script src="<?php echo base_url()?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/chartjs/dist/Chart.bundle.min.js"></script>

<script type="text/javascript">

  var canvas = $('#npie').get(0).getContext('2d');

  var cData = JSON.parse(`<?php echo $chart_data; ?>`);

  var label = JSON.parse(`<?php echo $ladata;?>`);
  console.log(cData);
  var doughnutChart = new Chart(canvas, {

    type: 'pie',

    data: {

      labels :label.ldata,

      datasets: [{

        data: cData.data,

        backgroundColor: [

          "#000",

          "#473FEB",

          "#FFDC7A",

          "#0F7121",

          "#FF2F1D",

          "#E84865",

          "#5B1F94",

          "#BAC5DE",

          "#516154",

          "#EB5028",

          "#164F28",

          "#52410C",

          "#524C41",

          "#F5E493",

        ],

        hoverBackgroundColor: [

          "#A62A2A",

          "#473FEB",

          "#FFDC7A",

          "#0F7121",

          "#FF2F1D",

          "#E84865",

          "#5B1F94",

          "#BAC5DE",

          "#516154",

          "#EB5028",

          "#164F28",

          "#52410C",

          "#524C41",

          "#F5E493",

        ]

      }]

    },

    options: {

        legend: {

            display: false,

        },

      // In options, just use the following line to show all the tooltips

     showAllTooltips: true

    }

  });

</script>

<!-- sampati kar bhumi kar pie -->

<script type="text/javascript">

  var sData = JSON.parse(`<?php echo $snpchart_data; ?>`);

  var slbl = JSON.parse(`<?php echo $slabel; ?>`);
  // console.log(slbl);
  var canvas = $('#spie').get(0).getContext('2d');

  var doughnutChart = new Chart(canvas, {

    type: 'pie',

    data: {

      labels : slbl.sldata,

      datasets: [{

        data: sData.spdata,

        backgroundColor: [

          "#A62A2A",

          "#473FEB",

          "#F51993",

          "#0F7121",

          "#FF2F1D",

          "#E84865",

          "#5B1F94",

          "#BAC5DE",

          "#516154",

          "#EB5028",

          "#164F28",

          "#000",

          "#524C41",

          "#F5E493",

        ],

        hoverBackgroundColor: [

          "#A62A2A",

          "#473FEB",

          "#FFDC7A",

          "#0F7121",

          "#FF2F1D",

          "#E84865",

          "#5B1F94",

          "#BAC5DE",

          "#516154",

          "#EB5028",

          "#164F28",

          "#52410C",

          "#524C41",

          "#F5E493",

        ]

      }]

    },

    options: {

      labels :label.ldata,

       legend: {

            display: false,

        },

      // In options, just use the following line to show all the tooltips

      showAllTooltips: true

    }

  });

</script>

<script type="text/javascript">

  var ctx = document.getElementById("bar").getContext("2d");

  var cData = JSON.parse(`<?php echo $chart_data; ?>`);

  var sData = JSON.parse(`<?php echo $nchart_data; ?>`);

  var label = JSON.parse(`<?php echo $ladata;?>`);

  

  var data = {

    options: {

        scales: {

            yAxes: [{

                type: 'myScale' // this is the same key that was passed to the registerScaleType function

            }]

        }

    },

    labels :label.ldata,

    datasets: [

      {

        label: "सम्पति-भूमिकर कर",

        backgroundColor: "blue",

        data: sData.sbdata,

      },

      {

        label: "नगदी कर",

        backgroundColor: "red",

        data: cData.data,

      }

    ]

  };

  var myBarChart = new Chart(ctx, {

      type: 'bar',

      data: data,

      options: {

          barValueSpacing: 20,

          scales: {

              yAxes: [

              {

                stacked: false,

                fontColor: "#CCC", // this here

              }]

          },

           legend: {

            labels: {

                fontColor: "white",

                fontSize: 18

            }

        },

      },



  });

</script>