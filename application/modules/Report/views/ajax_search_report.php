<table class=" table table-bordered" id="hidden-table-info">
		<thead>
			<tr>
				<th class="hidden-phone">वडा नं</th>
				<th class="hidden-phone">सम्पतिकर भूमिकर</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				
				<td><?php echo 'वडा नं-'.$this->mylibrary->convertedcit($result->added_ward)?></td>
				<td>
					<?php $total_amount = $this->Reportmodel->getTotalSampatBhumiKarByWard($result->total);
						echo !empty($result->total)?$this->mylibrary->convertedcit(number_format($result->total)):$this->mylibrary->convertedcit(0);
					?>
          (अक्षरुपी : <?php echo $this->convertlib->convert_number($result->total,"मात्र |")."मात्र |";?>)
				</td>
			</tr>
		</tbody>
		
  </table>