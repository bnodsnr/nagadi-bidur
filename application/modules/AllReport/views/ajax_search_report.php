<table class=" table table-bordered" id="hidden-table-info">
		<thead>
			<tr>
				<?php if(!empty($fiscal_year)) { ?>
					<th class="hidden-phone">आर्थिक वर्ष</th>
				<?php } ?>
				<?php if(!empty($ward)) { ?>
					<th class="hidden-phone">वडा नं</th>
				<?php } ?>
				<?php if(!empty($date)) { ?>
					<th class="hidden-phone">मिति</th>
				<?php } ?>
				<th class="hidden-phone">नगदी </th>
				<th class="hidden-phone">सम्पतिकर भूमिकर</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php if(!empty($fiscal_year)) { ?>
					<td><?php echo $this->mylibrary->convertedcit($fiscal_year)?></td>
				<?php } ?>
				<?php if(!empty($ward)) { ?>
					<td><?php echo $this->mylibrary->convertedcit($ward)?></td>
				<?php } ?>
				<?php if(!empty($date)) { ?>
					<td><?php echo $this->mylibrary->convertedcit($date)?></td>
				<?php } ?>
				<td><?php echo !empty($nagadi->total)?$this->mylibrary->convertedcit(number_format($nagadi->total)):0?></td>
				<td><?php echo !empty($sambhukar->total)?$this->mylibrary->convertedcit(number_format($sambhukar->total)):0?></td>
			</tr>
		</tbody>
		
  </table>