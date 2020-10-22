<?php

echo '<!DOCTYPE html>';
echo '<html lang="fr" class="dyn-body">';

	include_once('include/header.php');

	echo '<body class="Accueil dyn-body">';
			echo '<label id="switch" class="switch">';
				echo '<input type="checkbox" class="theme-switch" checked="true" id="slider">';
				echo '<span class="slider round"></span>';
			echo '</label>';			
			echo '<div class="col-10 col-md-8">';
				echo '<h4>Registration</h4>';
				echo '<form class="text-center" action="index.php?page=register" method="POST">';
				echo '<div class="row">';
					echo '<div class="col-6 form-group">';
						echo '<input type="text" class="form-control" id="logName" name="logName" placeholder="Last Name" required>';
					echo '</div>';
					echo '<div class="col-6 form-group">';
						echo '<input type="text" class="form-control" id="logFirstName" name="logFirstName" placeholder="First Name" required>';
					echo '</div>';
				echo '</div>';
					echo '<div class="form-group">';
						echo '<input type="email" class="form-control" id="logMail" name="logMail" placeholder="Example@email.com" required>';
					echo '</div>';
					echo '<div class="form-group">';
						echo '<input type="password" class="form-control" id="logPass" name="logPass" placeholder="Password" required>';
					echo '</div>';
					echo '<button type="submit" class="btn mt-1">Sign up</button>';
				echo '</form>';
			echo '</div>';
			echo '<div class="background-image"></div>';
	echo '</body>';

	//Partie en javascript
	include_once('include/js.php');
	include_once('include/theme.php');
		
	echo '<script>';
		echo 'const bg = document.querySelector(\'.background-image\');';
		echo 'const windowWidth = window.innerWidth / 5;';
		echo 'const windowHeight = window.innerHeight / 5 ;';

		echo 'bg.addEventListener(\'mousemove\', (e) => {';
		  echo 'const mouseX = e.clientX / windowWidth;';
		  echo 'const mouseY = e.clientY / windowHeight;';
		  
		  echo 'bg.style.transform = `translate3d(-${mouseX}%, -${mouseY}%, 0)`;';
		echo '});';		
	echo '</script>';
	
echo '</html>';
?>