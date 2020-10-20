<?php
//header
echo '<!DOCTYPE html>';
echo '<html lang="fr" class="dyn-body">';

	include_once('include/header.php');

//Formulaire de connection
	echo '<body class="Accueil dyn-body">';
			echo '<label id="switch" class="switch">';
				echo '<input type="checkbox" class="theme-switch" checked="true" id="slider">';
				echo '<span class="slider round"></span>';
			echo '</label>';
			echo '<div class="col-10 col-md-8">';
				echo '<h4>E-Scrum</h4>';
				echo '<form class="text-center" action="index.php" method="POST">';
					echo '<div class="form-group">';
						echo '<input type="email" class="form-control" name="logMail" id="logMail" placeholder="Example@email.com">';
					echo '</div>';
					echo '<div class="form-group">';
						echo '<input type="password" class="form-control" name="logPass" id="logPass" placeholder="Password">';
					echo '</div>';
					if($error == true){
						echo '<p style="color:red">Wrong e-mail ou password !</p>';
					}
					echo '<button type="submit" class="btn mt-3">Log in</button>';
				echo '</form>';
				echo '<p class="pt-4"><a class="pt-4" id="light" href="index.php?page=register">Not registered? Sign up here !</a></p>';
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