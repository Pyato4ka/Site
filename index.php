<?php 
	require 'db.php';
?>

<?php if ( isset ($_SESSION['logged_user']) ) : ?>
	Pieteicies! <br/>
	Labdien, <?php echo $_SESSION['logged_user']->login; ?>!<br/>

	<a href="logout.php">Iziet</a>

<?php else : ?>
Jūs neesat pieteicies<br/>
<a href="/login.php">Pieteikums</a>
<a href="/signup.php">Reģistrācija</a>
<?php endif; ?>
<meta charset="UTF-8">
