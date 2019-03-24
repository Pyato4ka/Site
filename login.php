<?php 
	require 'db.php';

	$data = $_POST;
	if ( isset($data['do_login']) )
	{
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ( $user )
		{
			
			if ( password_verify($data['password'], $user->password) )
			{
				
				$_SESSION['logged_user'] = $user;
				echo '<div style="color:dreen;">Jūs esat pieteicies!<br/> Varat iet uz <a href="Main.html">mājas lapu</a>.</div><hr>';
			}else
			{
				$errors[] = 'Nepareizi ievadīta parole!';
			}

		}else
		{
			$errors[] = 'Lietotājs ar tādu lietotājvārdu nav atrasts!';
		}
		
		if ( ! empty($errors) )
		{
			
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}

?>

<html>
<head>
	<meta charset="utf-8">
	<title>Konskurss</title>
	<link rel="stylesheet" type="text/css" href="Navigation.css">
	<link rel="stylesheet" type="text/css" href="Common.css">
</head>
<body>
	<div class="navmove">
	<ul class="nav">
		<li><a href="Main.html">Sākums</a></li><li><a href="About.html">Par Mums</a></li><li><a href="Contacts.html">Kontakti</a></li>
		<!-- <form class="container-form" action="search.php" method="get">
			  <input class="search" type="text" id="search-form" name="search" placeholder="Meklēt">
			  <button class="button">
			  	<img class="image" src="Images/search.png" style="width: 16px; height: 16px">
			  </button>
		</form> -->
	</ul>
</div>
<form action="login.php" method="POST">
	<meta charset="UTF-8">
	<strong>Lietotājvārds</strong>
	<input type="text" name="login" value="<?php echo @$data['login']; ?>"><br/>

	<strong>Parole</strong>
	<input type="password" name="password" value="<?php echo @$data['password']; ?>"><br/>

	<button type="submit" name="do_login">Ieiet</button><button><a href="signup.php" class="regb">Reģistrēties</a></button>
</form>
</body>
</html>
