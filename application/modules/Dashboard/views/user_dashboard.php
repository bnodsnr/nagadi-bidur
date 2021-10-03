<section id="main-content">
  <section class="wrapper site-min-height">
    <section class="">

      <div class="revenue-head">
        <span>
         <img src="<?php echo base_url()?>assets/img/npl.png" style="width: 54px;">
       </span>
       <h3 class="text-center"><?php echo $this->mylibrary->convertedcit($this->session->userdata('PRJ_USER_WARD'))?> नं वडा  कार्यलय - <?php echo GNAME?>  </h3>
       <span class="rev-combo pull-right">

        <div class="input-group">
          <input type="text" name="form_filler_date" class="form-control" value="<?php echo $this->mylibrary->convertedcit(convertDate(date('Y-m-d')))?> <?php echo $this->mylibrary->convertedcit(date('H:i'))?> " readonly="" data-fillr-id="1591891198" data-fillr="bound" autocomplete="off">
          <div class="input-group-prepend">
            <button type="button" class="input-group-text btn btn-danger" title="" style="background: radial-gradient(#ffffff, transparent);border: none"><i class="fa fa-calendar" style="color:#1b5693;background: radial-gradient(#ffffff, transparent);"></i></button>
          </div>
        </div>
      </div>
      <br>

      <div class="row state-overview">
        <div class="col-lg-4 col-sm-6">
          <section class="card">
            <div class="symbol terques">
              <i class="fa fa-user"></i>
            </div>
            <div class="value">
              <h1 class="count"><?php echo !empty($totalProfile)? $this->mylibrary->convertedcit(number_format($totalProfile)):$this->mylibrary->convertedcit(0)?> </h1>
              <a href="<?php echo base_url()?>PersonalProfile" target ="_blank"><b>जग्गाधनी प्रोफाइल</b></a>
            </div>
          </section>
        </div>
         <div class="col-lg-4 col-sm-6">
          <section class="card">
            <div class="symbol yellow">
              <i class="fa fa-user"></i>
            </div>
            <div class="value">
              <h1 class="count"><?php echo !empty($TotalPaidProfile)? $this->mylibrary->convertedcit(number_format($TotalPaidProfile)):$this->mylibrary->convertedcit(0)?> </h1>
              <a href="<?php echo base_url()?>PersonalProfile/paidProfileList"><b>जग्गाधनी प्रोफाइल रसिद काटिएको</b> </a>
            </div>
          </section>
        </div>

        <div class="col-lg-4 col-sm-6">
          <section class="card">
            <div class="symbol blue">
              <i class="fa fa-user"></i>
            </div>
            <div class="value">
              <h1 class="count"><?php echo !empty($TotalUnPaidProfile)? $this->mylibrary->convertedcit(number_format($TotalUnPaidProfile)):$this->mylibrary->convertedcit(0)?> </h1>
              <a href="<?php echo base_url()?>PersonalProfile/unpaidProfieList"> <b>रसिद काट्न बाकी प्रोफाइल</b></a>
            </div>
          </section>
        </div>

        <div class="col-lg-4 col-sm-6">
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
        <div class="col-lg-4 col-sm-6">
          <section class="card">
            <div class="symbol blue">
              <i class="fa fa-info-circle"></i>
            </div>
            <div class="value">
              <h1 class=" count4"><?php echo !empty($totalNagadi)? $this->mylibrary->convertedcit(number_format($totalNagadi->total)):$this->mylibrary->convertedcit(0)?></h1>
              <p> जम्मा नगदी कर संकलन</p>
            </div>
          </section>
        </div>
        <div class="col-lg-4 col-sm-6">
          <section class="card">
            <div class="symbol red">
              <i class="fa fa-info-circle"></i>
            </div>
            <div class="value">
              <h1 class=" count2">
                <?php $total = $totalSampatiBhumiKar->total + $totalNagadi->total;
                $total_collection = $this->mylibrary->convertedcit(number_format($total));
                echo $total_collection;
                ?></h1>
                <p>जम्मा कर संकलन</p>
              </div>
            </section>
          </div>
      </div>


      <div class="row">
        <div class="col-lg-6">
          <!--user info table start-->
          <section class="card">
            <div class="card-body">
              <div class="task-thumb-details">
                <h1><a href="#">दैनिक सङ्कलन</a></h1>
                <p class="label label-success" style="color: #fff"><?php echo $this->mylibrary->convertedcit(convertDate(date('Y-m-d')))?></p>
              </div>
            </div>
            <table class="table table-hover personal-task">
              <tbody>
                <tr>
                  <td>नगदी</td>
                  <td><?php echo !empty($dailyNagadiCollection->dailytotal) ? $this->mylibrary->convertedcit($dailyNagadiCollection->dailytotal) : $this->mylibrary->convertedcit(0)?></td>
                </tr>
                <tr>
                  <td>सम्पतिकर/भूमिकर</td>
                  <td><?php echo !empty($dailySampatiKar->dailytotal) ? $this->mylibrary->convertedcit($dailySampatiKar->dailytotal) : $this->mylibrary->convertedcit(0)?></td>
                </tr>

              </tbody>
            </table>
          </section>
      
          <!--user info table end-->
        </div>

        <div class="col-lg-6">
          <!--user info table start-->
          <section class="card">
            <div class="card-body">
              <div class="task-thumb-details">
                <h1><a href="#">मासिक सङ्कलन</a></h1>
                <?php 
                  $current_date = explode('-',convertDate(date('Y-m-d')));
                  $month = $current_date[1];
                  switch ($month) {
                    case '1':
                    $month = 'वैशाख';
                    break;
                    case '2':
                    $month = 'ज्येष्ठ';
                    break;
                    case '3':
                    $month = 'आषाढ';
                    break;
                    case '4':
                    $month = 'श्रावण';
                    break;
                    case '5':
                    $month = 'भाद्र';
                    break;
                    case '6':
                    $month = 'आश्विन';
                    break;
                    case '7':
                    $month = 'कार्तिक';
                    break;
                    case '8':
                    $month = 'मार्ग';
                    break;
                    case '9':
                    $month = 'पौष';
                    break;
                    case '10':
                    $month = 'माघ';
                    break;
                    case '11':
                    $month = 'फाल्गुन';
                    break;
                    case '12':
                    $month = 'चैत्र';
                  }
                ?>
                  <p class="label label-success" style="color: #fff"><?php echo $month;?></p>
              </div>
            </div>
            <table class="table table-hover personal-task">
              <tbody>
                <tr>
                  <!-- // -->
                  <td>नगदी</td>
                  <td><?php echo !empty($monthlyNagadi->monthlytotal) ? $this->mylibrary->convertedcit($monthlyNagadi->monthlytotal) : $this->mylibrary->convertedcit(0)?></td>
                </tr>
                <tr>
                  <td>सम्पतिकर/भूमिकर</td>
                  <td><?php echo !empty($monthlySampatiKar->monthlytotal) ? $this->mylibrary->convertedcit($monthlySampatiKar->monthlytotal) : $this->mylibrary->convertedcit(0)?> </td>
                </tr>

              </tbody>
            </table>
          </section>
          <!--user info table end-->
        </div>

      </div>

      </section>
    </section>
  </section>