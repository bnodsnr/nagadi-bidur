<table class="table table-bordered">
	<thead style="background: #1b5693;color:#FFF">
		<tr>
			<th> शिर्षक </th>
			<th> शिर्षक नं </th>
			<th> कर संकलन रकम </th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php if(!empty($main_topic)) : 
				foreach ($main_topic as $key => $value) : ?>
					<tr>
						<td><?php echo $value['topic_name']?></td>
						<td><?php echo $this->mylibrary->convertedcit($value['topic_no'])?></td>
						<?php $totalCollection = $this->Reportmodel->getNagadiMonthlyTotal($month, $ward, $value['id']);?>
						<td><?php echo !empty($totalCollection->total)?$this->mylibrary->convertedcit($totalCollection->total):$this->mylibrary->convertedcit(0)?></td>
						<td><a class="btn btn-warning" href="<?php echo base_url()?>">विवरण हेर्नुहोस</a></td>
					</tr>
			<?php endforeach;endif;?>
		</tr>
	</tbody>
</table>