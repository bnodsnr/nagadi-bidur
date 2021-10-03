<form action="<?php echo base_url()?>OverAllReport/WardWiseReport" method="post" class="form save_post">
<section id="main-content">
	<section class="wrapper site-min-height">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a> 
				</li>
				<li class="breadcrumb-item"><a href="<?php echo base_url()?>OverAllReport"> रिपोर्ट - प्रतिवेदन </a></li>
				<li class="breadcrumb-item"><a href="javascript:;"><i class=""></i> समग्र रिपोर्ट</a></li>
			</ol>
		</nav>
		<div class="col-sm-12">
			<section class="card">
				<header class="card-header">
					समग्र वडागत रिपोर्ट
					<span class="tools pull-right">
						<a href="javascript:;" class="fa fa-chevron-down"></a>
						<a href="javascript:;" class="fa fa-times"></a>
					</span>
				</header>
				<table  class="display table table-bordered table-striped" id="dynamic-table">
				</section>
				<div class="row">
					<div class="col-sm-12">
						<table class="display table table-bordered" id="hidden-table-info">
							<thead>
								<tr>
									<th>सि.नं</th>
									<th>आम्दानी शिर्षक</th>
									<th class="hidden-phone">शिर्षक नं</th>
									<th class="hidden-phone">रकम रु</th>
									<th class="hidden-phone">कैफियत</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($main_topic)) : 
									$i=1; foreach($main_topic as $mt):
									?>
									<td><?php echo $i?></td>
									<td><?php echo $mt['topic_name']?></td>
									<td><?php echo $mt['topic_no']?></td>
									<td></td>
									<td></td>
								</tbody>
								<?php $i++; endforeach; endif;?>
								<tfoot>
									<tr>
										<td colspan="2"></td>
										<td>जम्मा रु:</td>
										<td></td>
									</tr>
									<tr>
										<td colspan="5">अक्षरुपी :</td>
									</tr>
								</tfoot>
							</table>
						</section>
					</section>
