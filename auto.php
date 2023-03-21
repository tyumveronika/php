<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="wrapper">
		<header>
			<div class="logo-name">
				<div class="logo">
					<img src="img/sport.png">
				</div>
				<div class="name">
					<h2>СпортТовары</h2>
				</div>
		<div class="menu">
			<div class="menu-item">
				<a href="index.php">главная</a>
			</div>
			<div class="menu-item">
				<a href="reg.php">регистрация</a>
			</div>
			<div class="menu-item">
				<a href="auto.php">войти</a>
			</div>
			<?
			if($_SESSION['login']!='')
			{
			?>
			<div class="menu-item">
				<a href="cabinet.php">личный кабинет</a>
			</div>
			<div class="menu-item">
				<a href="basket.php">корзина</a>
			</div>
			<div class="menu-item">
				<form action="index.php" method="POST">
					<input type="submit" name="vihod" value="выйти">
				</form>
			</div>
			<?}
			if($_SESSION['status']=='1'){
			?>
			<div class="menu-item">
				<a href="admin.php">панель администратора</a>
			</div>
			<?}?>
		</div>
				<div class="information">
				<h5 style="color:white"> Адрес: г. Владивосток, ул. Ленина 1А, оф.304<br>
										Телефон: (4212) 90-42-12<br>
										Email: sotrs@mail.ru<br>
										Режим работы офиса: Пн - Пт: 9.00 - 17.30</h5>
				</div>
			</div>		

	</header>
	<main>
		<?php
		
		$host='localhost';
		$base='vinokurov';
		$name='root';
		$pass='';

		$conn=mysqli_connect($host,$name,$pass,$base);

		?>
		<div class="category">
			<h2>Категории: </h2>
			<div class="button-fix">
				<?

				$query="SELECT * FROM `category`";
				$result=mysqli_query($conn,$query);

				while($row=mysqli_fetch_row($result)) {

				?>
					<form method="post" action="index.php">
						<input type="submit" name="category" value="<?echo $row[1];?>">
					</form>
				<?
				}
				?>
			</div>

			
		</div>
		<div class="auth">
			<?
				if ($_POST['auto']=='Войти') {
					$login=$_POST['login'];
					$password=$_POST['password'];

					$query="SELECT * FROM `reg` WHERE `login`='$login' AND `password` = '$password' ";
							
					$result=mysqli_query($conn,$query);
					$row=mysqli_fetch_array($result);
					$num=mysqli_num_rows($result);
					if ($num == 1) {
						echo "Вы успешно авторизовались, пройдите в <a href='cabinet.php'>личный кабинет</a>";
						$login_s=$_SESSION['login']=$login;
						$password_s=$_SESSION['password']=$password;
						$status_s=$_SESSION['status']=0;
						if ($row['status']==1) {
							echo "<br>Добро пожаловать админ, пройдите в <a href='admin.php'>панель администратора</a>";
							$status_s=$_SESSION['status']=1;
						}
					}else{
						echo "Такого пользователя нет, <a href='auto.php'>повторите попытку</a> или <a href='reg.php'>зарегистрируйтесь</a>";
					}
				}
				else{
			?>
			<form name="myForm" id="myForm" action="auto.php" method="POST">
						<h1>Войти</h1>
						<label for="name">Введите логин: </label>
						<input type="text" id="login" name="login" required>
						<br>
						<br>
						<label for="password">Введите ваш пароль: </label>
						<input type="password" id="password" name="password" class="password-input" required><br><br>
						<br>
						<br>
						<div class="button-fix">
							<input type="submit" name="auto" value="Войти">
						</div>
					</form>
		<?}?>			
		</div>
	</main>
	<footer>
		<div class="menu-footer">
			<div class="menu-item">
				<a href="">главная</a>
			</div>
			<div class="menu-item">
				<a href="">личный кабинет</a>
			</div>
			<div class="menu-item">
				<a href="">регистрация</a>
			</div>
			<div class="menu-item">
				<a href="">войти</a>
			</div>
			<div class="menu-item">
				<a href="">выйти</a>
			</div>
			<div class="menu-item">
				<a href="">корзина</a>
			</div>
		</div>
		<div class="information">
				<h5 style="color:white"> Адрес: г. Владивосток, ул. Ленина 1А, оф.304<br>
										Телефон: (4212) 90-42-12<br>
										Email: sotrs@mail.ru<br>
										Режим работы офиса: Пн - Пт: 9.00 - 17.30</h5>
				</div>
	</footer>
	</div>
</body>
</html>