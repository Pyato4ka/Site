<?php 
	require 'db.php';

	$data = $_POST;

	function captcha_show(){
		$questions = array(
			1 => 'Krievijas galvaspilsēta',
			2 => 'ASV galvaspilsēta',
			3 => '2 + 3',
			4 => '15 + 14',
			5 => '45 - 10',
			6 => '33 - 3'
		);
		$num = mt_rand( 1, count($questions) );
		$_SESSION['captcha'] = $num;
		echo $questions[$num];
	}

	
	if ( isset($data['do_signup']) )
	{
    
		$errors = array();
		if ( trim($data['login']) == '' )
		{
			$errors[] = 'Ievadiet lietotājvārdu';
		}

		if ( trim($data['email']) == '' )
		{
			$errors[] = 'Ievadiet e-pastu';
		}

		if ( $data['password'] == '' )
		{
			$errors[] = 'Ievadiet paroli';
		}

		if ( $data['password_2'] != $data['password'] )
		{
			$errors[] = 'Atkārtotā parole ievadīta nepareizi!';
		}

		
		if ( R::count('users', "login = ?", array($data['login'])) > 0)
		{
			$errors[] = 'Lietotājs ar tādu lietotājvārdu jau eksistē!';
		}
    
    
		if ( R::count('users', "email = ?", array($data['email'])) > 0)
		{
			$errors[] = 'Lietotājs ar tādu e-pastu jau eksistē!';
		}

		
		$answers = array(
			1 => 'maskava',
			2 => 'vašingtona',
			3 => '5',
			4 => '29',
			5 => '35',
			6 => '30'
		);
		if ( $_SESSION['captcha'] != array_search( mb_strtolower($_POST['captcha']), $answers ) )
		{
			$errors[] = 'Atbilde uz jautājumu ir nepareiza!';
		}


		if ( empty($errors) )
		{
			
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT); 
			R::store($user);
			echo '<div style="color:dreen;">Jūs esat veiksmīgi iereģistrēts!</div><hr>';
		}else
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
<form action="/signup.php" method="POST">
	<meta charset="UTF-8">
	<strong>Jūsu lietotājvārds</strong>
	<input type="text" name="login" value="<?php echo @$data['login']; ?>"><br/>

	<strong>Jūsu e-pasts</strong>
	<input type="email" name="email" value="<?php echo @$data['email']; ?>"><br/>

	<strong>Jūsu parole</strong>
	<input type="password" name="password" value="<?php echo @$data['password']; ?>"><br/>

	<strong>Atkārtojiet paroli</strong>
	<input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>"><br/>

	<strong><?php captcha_show(); ?></strong>
	<input type="text" name="captcha" ><br/>

	<button type="submit" name="do_signup">Reģistrācija</button>
</form>
</body>
</html>
