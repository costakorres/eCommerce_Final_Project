<html>
<head><title>Edit a User</title></head><body>
Editing <?php echo $data->username; ?>
<form action='' method='post'>
	Username <input type='text' name='username' value='<?php echo $user->username; ?>' /><br>
	<input type='submit' name='action' value='Save changes' />
</form>

</body></html>

<?php echo $data->species; ?>