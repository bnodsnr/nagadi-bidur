<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>विद्युतीय प्रणाली प्रयोगकर्ता विवरण, परिवर्तन र स्थगन माग फारम</title>
    <style>
        body { font-family: freesans; }

        #customers {
          /*font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;*/
          border-collapse: collapse;
          width: 100%;
      }

      #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
      }

      #customers tr:nth-child(even){background-color: #f2f2f2;}

      #customers tr:hover {background-color: #ddd;}

      #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #4CAF50;
          color: white;
      }
  </style>
</head>
<body>

    <div id="container">
        <div style="height: 100px;width: 100px; margin-left:20px;margin-top: 60px;">
            <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 95px;
            width: 98px;">
        </div>
        <div style="height: 100px;width: 100px; margin-left:490px;margin-top: -99px;">
            <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 95px;
            width: 98px;">
        </div>
        <div style="height: 100px;width: 110px; margin-left:590px;margin-top: -119px;">
            <p>म.ले.प. फारम नं.९०१</p>
        </div>

        <div style="margin-left:200px; margin-top: -83px;">
            <p>संघ/प्रदेश/स्थानीय तह</p>
            <p style="margin-left:-15px;">......मन्त्रालय/विभाग/कार्यलय</p>
            <p style="margin-left:15px;">कार्यलय कोड नं.</p>
            <p style="margin-left:-20px;">विद्युतीय प्रणाली प्रयोगकर्ता विवरण, परिवर्तन र स्थगन माग फारम</p>
        </div>

        <div>
            <table id ="customers">
                <tbody>
                    <tr border: 1px solid #000> 
                        <td>प्रयोगकर्ता कर्मचारीको नाम</td>
                        <td><?php echo $query->name?></td>
                    </tr>
                    <tr> 
                        <td>संकेत नं. </td>
                        <td><?php echo $query->symbol_no?></td>
                    </tr>
                    <tr> 
                        <td>पद</td>
                        <td><?php echo $query->designation?></td>
                    </tr>
                    <tr> 
                        <td>शाखा</td>
                        <td><?php echo $query->branch_name?></td>
                    </tr>
                    <tr> 
                        <td>प्रयोजन</td>
                        <td><?php echo $query->designation?></td>
                    </tr>
                    <tr> 
                        <td>सफ्टवेयर/प्रणालीको नाम</td>
                        <td><?php echo $query->designation?></td>
                    </tr>
                    <tr> 
                        <td>सफ्टवेयर विवरण</td>
                        <td><?php echo $query->designation?></td>
                    </tr>
                    <tr> 
                        <td>पहुँच तह Access level</td>
                        <td><?php echo $query->user_group?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="">
            <h3>पहुँच परिवर्तन गर्ने</h3>
            <table id ="customers">
                <tbody>

                </tr>
                <?php ?>
                <?php if(!empty($parentmodules->result())) : 
                    foreach($parentmodules->result() as $key=> $menu) : ?>
                        <tr>
                            <td>
                                <?php 
                                if(!empty($pmenu)){
                                    if(in_array($menu->menuid, $pmenu)) {
                                     $checked = 'checked='.'checked';
                                    } else {
                                    $checked ='';
                                    }
                                }
                            ?>
                            <input type ="checkbox" name="menu" value="<?php echo $menu->menuid?>" <?php echo $checked?>>
                            </td>
                            <td><?php  echo $menu->menu_name?></td>
                        </tr>
                    <?php endforeach;endif ?>
                </tbody>
            </table>
        </div>
        <div style="height: 100px;"></div>
        <h3>माग गर्नुपर्ने कारण</h3>
        <div style="height: 150px; border: 1px solid #000"><?php if(!empty($reason->reason_for_access)){ echo $reason->reason_for_access;}?></div>
    <hr style=" border:none;border-top:1px dotted #000;">
    <div class="">

        <b><u>सम्बन्धित कर्मचारीको</u></b><br>
        नाम: <?php echo $query->name?><br>
        पद: <?php echo $query->designation?><br>
        दस्तखत:
    </div>

    <div style="margin-left:500px; margin-top: -87px;">

        <b><u>सम्बन्धित कर्मचारीको</u></b><br>
        नाम: <?php echo $query->name?><br>
        पद: <?php echo $query->designation?><br>
        दस्तखत:
    </div>
</div>
</body>
</html>