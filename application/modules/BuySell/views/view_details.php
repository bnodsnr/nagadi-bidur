v_<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
    
    <title></title>
    <style>
   
    body{ 
        font-family: freesans; 
    }
       
      #customers {
          border-collapse: collapse;
          width: 100%;
      }

      #customers td, #customers th {
          border: 1px solid #000;
          padding: 8px;
      }
      #customers tr:hover {background-color: #000;}
      #customers th {
          text-align: left;
          color: #000;
      }

      #customers tbody td {
        font-size: 10px;
      }
      
      .container{
  	position: relative;
}

.container:after {
  content: "";
  display: block;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0px;
  left: 0px;
  background-image: url("http://bmsnep.com/bidur/ngd/assets/img/nepal-govt.png");
  background-size: 100px 100px;
  background-position: 30px 30px;
  background-repeat: no-repeat;
  opacity: 0.7;
}
  </style>
</head>
<body>
  <div id="container">
    <div class="header">
      <div style="height: 100px;width: 100px; margin-left:20px;">
        <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 50px; width: 70px;">
      </div>
      
      <div style="margin-left:300px; margin-top: -130px;">
        <div style="font-size: 12px">अनुसुची - ५</div>
        <div style="margin-left: -20px;margin-top: 5px;font-size: 12px">(दफा १० को उपदफा (४) सँग सम्बन्धित)</div>
        <div style="font-size: 12px">विदुर नगरपालिका</div>
        <div style="margin-left: -20px;margin-top: 5px;font-size: 12px"><b>नगर कार्यपालिकाको कार्यालय</b></div>
        <div style="margin-left: -10; font-size: 12px">कार्यलय कोड नं: <?php echo $this->mylibrary->convertedcit(8032942)?></div>
        <div style="margin-left: -45px; margin-top: 8px; font-size: 12px"><b>जग्गा तथा संरचनाको दाखिला खरेजी टिपोट </b></div>
      </div>

      <div style="height: 100px;width: 310px; margin-top:60px;">
          <div style="margin-top:0px; font-size: 12px;"> जग्गा दिनेको नाम : </div>
          <div style="margin-top: 5px; font-size: 12px;">ठेगाना: </div>
          <div style="margin-top: 5px; font-size: 12px;">जग्गा दिनेको क्र.स नम्बर : </div>
      </div>

      <div style="height: 100px;width: 310px; margin-top:-100px; margin-left:460px">
          <div style="margin-top:0px; font-size: 12px;"> जग्गा लिनेको नाम  : </div>
          <div style="margin-top: 5px; font-size: 12px;">ठेगाना : </div>
          <div style="margin-top: 5px; font-size: 12px;">जग्गा लिनेको क्र.स नम्बर : </div>
      </div>
    </div><!--end of header-->
    <div>
      <table id="customers">
          <tr>
            <th rowspan="2" style="font-size: 12px" align="center">सि. नं</th>
            <th rowspan="2" style="font-size: 12px"align="center">जग्गा दिनेको नाम</th>
            <th rowspan="2" style="font-size: 12px" align="center">जग्गा लिनेको नाम</th>
            <th colspan="3" align="center">थपघटको भएको विवरण </th>
            <th colspan="5" align="center">जग्गाको विवरण</th>
            <th colspan="2" align="center">संरचनाको</th>
           <th rowspan="2" style="font-size: 12px" align="center">जग्गा दिनेको श्रेस्ताम घट जग्गा तथा संरचना</th>
           <th rowspan="2" style="font-size: 12px" align="center">जग्गा दिनेको घटने मूल्याङ्कन रकम</th>
           <th rowspan="2" style="font-size: 12px" align="center">जग्गा लिनेको श्रेस्ताम थप जग्गा तथा संरचना</th>
           <th rowspan="2" style="font-size: 12px" align="center">जग्गा लिनेको मूल्याङ्कन रकम</th>
           <th rowspan="2" style="font-size: 12px" align="center">कैफियत</th>
         </tr>
         <tr>
           <th>जग्गाधनिको क्र.स नम्बर</th>
           <th>रेजिस्त्रसन नं</th>
           <th>मिति</th>

           <th>वडा नं</th>
           <th>जग्गाको रहेको क्षेत्र</th>
           <th>सबिकको कि. नं</th>
           <th>हालको कि. नं</th>
           <th>क्षेत्रफल</th>

           <th>प्रकार</th>
           <th>किसिम</th>
         </tr>
         <?php if(!empty($list)):
          $i = 1;
          foreach($list as $key => $bs) : ?>
          <tr>
            <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
            <td><?php echo $bs['seller_name']?></td>
            <td><?php echo $bs['buyer_name']?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['buyer_file_no'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['reg_no'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['added_on'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['present_ward'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['land_area_type'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['jk_no'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['new_kitta_no'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['n_land_area'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['prakar'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['kisim'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['n_land_area'])?></td>
            <td><?php echo $this->mylibrary->convertedcit(number_format($bs['new_tax_amount']))?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['n_land_area'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['new_tax_amount'])?></td>
            <td><?php echo $this->mylibrary->convertedcit($bs['remarks'])?></td>

          </tr>
          <?php endforeach;endif?>
      </table>
    </div>
  </div> <!--end of container-->

</body>
</html>