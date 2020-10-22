<?php
echo '<script>';
	echo 'const toggleSwitch = document.querySelector(\'.theme-switch\');';

	echo 'function switchTheme(e) {';
		echo 'if (e.target.checked) {';
			echo 'document.documentElement.setAttribute(\'data-theme\', \'dark\');';
			echo 'localStorage.setItem(\'theme\', \'dark\');';
		echo '}';
		echo 'else {';
			echo 'document.documentElement.setAttribute(\'data-theme\', \'light\');';
			echo 'localStorage.setItem(\'theme\', \'light\');';
		echo '}    ';
	echo '}';
	
	echo 'const currentTheme = localStorage.getItem(\'theme\') ? localStorage.getItem(\'theme\') : null;';

	echo 'if (currentTheme) {';
		echo 'document.documentElement.setAttribute(\'data-theme\', currentTheme);';

		echo 'if (currentTheme === \'dark\') {';
			echo 'toggleSwitch.checked = true;';
		echo '}';
		echo 'else {';
			echo 'toggleSwitch.checked = false;';
		echo '}';
	echo '}';

	echo 'toggleSwitch.addEventListener(\'change\', switchTheme, false);';	
echo '</script>';
?>