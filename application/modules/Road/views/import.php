<form action="<?php echo base_url()?>Road/importData" enctype="multipart/form-data" method="post">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	<input type="file" name="userfile">
	<input type="submit" name="submit" value="submit">
</form>