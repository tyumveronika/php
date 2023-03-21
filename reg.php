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
		<div class="reg">
			<?
				//reg -  имя кнопки "зарегистрироваться"
				if ($_POST['reg']=='Зарегистрироваться') {
					$name1=$_POST['name1'];
					$name2=$_POST['name2'];
					$email=$_POST['email'];
					$login=$_POST['login'];
					$password=$_POST['password'];
					$password2=$_POST['password2'];
					$country=$_POST['country'];
					$city=$_POST['city'];
					$pochta=$_POST['pochta'];
					$street=$_POST['street'];
					$phone=$_POST['phone'];
					$status=0;
					//$img='1.png';

					if ($password == $password2) {
						$query="INSERT INTO `reg`(`name1`, `name2`, `email`, `login`, `password`, `country`, `city`, `pochta`, `street`, `phone`, `status`, `img`) VALUES ('$name1','$name2','$email','$login','$password','$country','$city','$pochta','$street','$phone', '$status', '1.jpg')";
						echo "Вы успешно зарегистрировались, пройдите <a href='auto.php'> авторизацию</a>";		
						$result=mysqli_query($conn,$query);
					}
					else
					{
						echo "Пароли не совпадают";
					}
				}
				else
				{
			?>
			<form name="myForm" id="myForm" action="reg.php" method="POST">
						<h1>Зарегистрироваться</h1>
						<label for="name">*Имя пользователя: </label>
						<input type="text" id="name1" name="name1" required>
						<br>
						<br>
						<label for="name2">*Фамилия пользователя: </label>
						<input type="text" id="name2" name="name2" required>
						<br>
						<br>
						<label for="email">*Введите электронную почту: </label>
						<input type="text" id="email" class="email-input" name="email" required><br><br>
						<label for="login">*Введите логин: </label>
						<input type="text" id="login" class="login-input" name="login" required><br><br>
						<label for="password">*Пароль: </label>
						<input type="password" id="password" class="password-input" name="password" required><br><br>
						<label for="password2">*Повторите пароль: </label>
						<input type="password" id="password2" class="password-input" name="password2" required>
						<br>
						<br>
						<h1>Адрес</h1>
						<label for="country">Страна: </label>
						<select id="country" name="country" >
							<option>Россия</option>
							<option>Украина</option>
							<option>Белоруссия</option>
							<option>Казахстан</option>
						</select><br><br>
						<label for="city">Город: </label>
						<input type="text" id="city" class="city-input" name="city" required><br><br>
						<label for="post">Почтовый индекс (Необязательно): </label>
						<input type="text" id="post" class="post-input" name="pochta"><br><br>
						<label for="street">Улица, дом, квартира: </label>
						<input type="text" id="street" class="street-input" name="street" required><br>
						<br>
						<label for="phone">Номер телефона: </label>
						<input type="text" id="phone" class="phone-input" name="phone" required><br><br>
						<div>
						  <input type="checkbox" id="agree" name="agree">
						  <label for="agree">Согласие на обработку данных</label>
						</div>
						<div class="button-fix">
							<input type="submit" name="reg" value="Зарегистрироваться">
						</div>
			</form>
			<?
		}
			?>
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