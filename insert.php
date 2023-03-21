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
if($_SESSION['status']=='1'){
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

				if ($_POST['reg']=='Добавить пользователя') {
				?>
					<form name="myForm" id="myForm" action="insert.php" method="POST">
						<h1>Добавление пользователя</h1>
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
						<div class="button-fix">
							<input type="submit" name="user" value="Добавить">
						</div>
					</form>

				<?
				}

				if ($_POST['user']=='Добавить') {
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

					if ($password == $password2) {
						$query="INSERT INTO `reg`(`name1`, `name2`, `email`, `login`, `password`, `country`, `city`, `pochta`, `street`, `phone`, `status`, `img`) VALUES ('$name1','$name2','$email','$login','$password','$country','$city','$pochta','$street','$phone', '$status', '1.jpg')";
						echo "Вы успешно добавили пользователя";		
						$result=mysqli_query($conn,$query);
					}
					else echo "Пароли не совпадают попробуй еще раз <a href='admin.php'>панель администратора</a>";
				}

				if ($_POST['red_tov']=='Редактировать') {
					$id=$_POST['id'];
					$query="SELECT * FROM `tovar` WHERE `id` = '$id' ";
					$result=mysqli_query($conn,$query);

					$row=mysqli_fetch_row($result); 


					?>
					<form name="myForm" id="myForm" action="insert.php" method="POST">
						<h1>Редактирование товара</h1>
						<label for="name">*Название товара: </label>
						<input type="text" name="name" required value="<?echo $row[1];?>">
						<br>
						<br>
						<label for="about">*Краткое описание: </label>
						<input type="text" name="about" required value="<?echo $row[5];?>">
						<br>
						<br>
						<label for="about2">*Описание: </label>
						<input type="text" name="about2" required value="<?echo $row[6];?>">
						<br>
						<br>
						<label for="category">*Категория: </label>
						<select id="category" name="category" >
						<?
							$query2="SELECT * FROM `category`";
							$result2=mysqli_query($conn,$query2);

							$row2=mysqli_fetch_row($result2) 
						?>
						
							<option value="<?echo $row[4];?>"><?echo $row[4];?></option>
							
						</select>
						<br>
						<br>
						<label for="price">*Цена: </label>
						<input type="text" name="price" required value="<?echo $row[3];?>">
						<br>
						<br>
						<div class="button-file">
								<input type="hidden" name="id" value="<?echo $row[0];?>">
								<label class="custom-file-upload">
									Выбрать файл
									<input type="file" name="img">
								</label>
								<br>
								<div class="button">
								<input type="submit" name="save_tovar" value="Сохранить изменения">
								</div>
						</div>
					</form>
					<?
				}

				if ($_POST['save_tovar']=='Сохранить изменения') {
					$name=$_POST['name'];
					$img=$_POST['img'];
					$price=$_POST['price'];
					$category=$_POST['category'];
					$about=$_POST['about'];
					$about2=$_POST['about2'];
					$id=$_POST['id'];
					
					$query="UPDATE `tovar` SET `name`='$name',`img`='$img',`price`='$price',`category`='$category',`about`='$about',`about2`='$about2' WHERE `id` = '$id' ";
					echo $query;
					$result=mysqli_query($conn,$query);
				}

				if ($_POST['red_user']=='Редактировать') {
					$id=$_POST['id'];
					echo $id;
					$query="SELECT * FROM `reg` WHERE `id` = '$id' ";
					$result=mysqli_query($conn,$query);

					$row=mysqli_fetch_row($result);
					?>
					<form name="myForm" id="myForm" action="insert.php" method="POST">
						<h1>Редактирование пользователя</h1>
						<label for="name">*Имя пользователя: </label>
						<input type="text" id="name1" name="name1" required value="<?echo $row[1];?>">
						<br>
						<br>
						<label for="name2">*Фамилия пользователя: </label>
						<input type="text" id="name2" name="name2" required value="<?echo $row[2];?>">
						<br>
						<br>
						<label for="email">*Введите электронную почту: </label>
						<input type="text" id="email" class="email-input" name="email" required value="<?echo $row[3];?>"><br><br>
						<label for="login">*Введите логин: </label>
						<input type="text" id="login" class="login-input" name="login" required value="<?echo $row[4];?>"><br><br>
						<label for="password">*Пароль: </label>
						<input type="password" id="password" class="password-input" name="password" required value="<?echo $row[5];?>"><br><br>
						<label for="password2">*Повторите пароль: </label>
						<input type="password" id="password2" class="password-input" name="password2" required value="<?echo $row[5];?>">
						<br>
						<br>
						<label for="country">Страна: </label>
						<select id="country" name="country" >
							<option>Россия</option>
							<option>Украина</option>
							<option>Белоруссия</option>
							<option>Казахстан</option>
						</select><br><br>
						<label for="city">Город: </label>
						<input type="text" id="city" class="city-input" name="city" required value="<?echo $row[7];?>"><br><br>
						<label for="post">Почтовый индекс (Необязательно): </label>
						<input type="text" id="post" class="post-input" name="pochta" value="<?echo $row[8];?>"><br><br>
						<label for="street">Улица, дом, квартира: </label>
						<input type="text" id="street" class="street-input" name="street" required value="<?echo $row[9];?>"><br>
						<br>
						<label for="phone">Номер телефона: </label>
						<input type="text" id="phone" class="phone-input" name="phone" required value="<?echo $row[10];?>"><br><br>
						<label for="status">Статус пользователя: </label>
						<input type="text" id="status" class="status-input" name="status" required value="<?echo $row[11];?>"><br><br>
						<div class="button-fix">
							<input type="hidden" name="id" value="<?echo $row[0];?>">
							<input type="submit" name="save_user" value="Сохранить изменения">
						</div>
					</form>
					<?
				}
				if ($_POST['save_user']=='Сохранить изменения') {
					$name1=$_POST['name1'];
					$name2=$_POST['name2'];
					$email=$_POST['email'];
					$login=$_POST['login'];
					$password=$_POST['password'];
					$country=$_POST['country'];
					$city=$_POST['city'];
					$pochta=$_POST['pochta'];
					$street=$_POST['street'];
					$phone=$_POST['phone'];
					$status=$_POST['status'];
					$id=$_POST['id'];
					
					$query="UPDATE `reg` SET `name1`='$name1',`name2`='$name2',`email`='$email',`login`='$login',`password`='$password',`country`='$country',`city`='$city',`pochta`='$pochta',`street`='$street',`phone`='$phone',`status`='$status' WHERE `id` = '$id' ";
					echo $query;
					echo $id;
					$result=mysqli_query($conn,$query);
				}

				if($_POST['del_user']=='Удалить'){
					$id=$_POST['id'];
					$query="DELETE FROM `reg` WHERE `id`='$id' ";
						echo "Пользователь удален";		
						$result=mysqli_query($conn,$query);
				}

				if ($_POST['tov']=='Добавить товар') {
				?>
				<form name="myForm" id="myForm" action="insert.php" method="POST">
						<h1>Добавление товара</h1>
						<label for="name">*Название товара: </label>
						<input type="text" name="name" required>
						<br>
						<br>
						<label for="about">*Краткое описание: </label>
						<input type="text" name="about" required>
						<br>
						<br>
						<label for="about2">*Описание: </label>
						<input type="text" name="about2" required>
						<br>
						<br>
						<label for="category">*Категория: </label>
						<select id="category" name="category" >
						<?
							$query2="SELECT * FROM `category`";
							$result2=mysqli_query($conn,$query2);

							while($row2=mysqli_fetch_row($result2)) {
						?>
						
							<option value="<?echo $row2[1];?>"><?echo $row2[1];?></option>
							<?}?>
						</select>
						<br>
						<br>
						<label for="price">*Цена: </label>
						<input type="text" name="price" required>
						<br>
						<br>
						<div class="button-file">
								<input type="hidden" name="id" value="<?echo $row[0];?>">
								<label class="custom-file-upload">
									Выбрать файл
									<input type="file" name="img">
								</label>
								<br>
								<div class="button">
								<input type="submit" name="tovar" value="Добавить">
								</div>
						</div>
					</form>
				<?
				}	
				if ($_POST['tovar']=='Добавить') {
					$name=$_POST['name'];
					$about=$_POST['about'];
					$about2=$_POST['about2'];
					$category=$_POST['category'];
					$price=$_POST['price'];
					$img=$_POST['img'];

						$query="INSERT INTO `tovar`(`name`, `img`, `price`, `category`, `about`, `about2`) VALUES ('$name','$img','$price','$category','$about','$about2')";
						echo "Товар добавлен";		
						$result=mysqli_query($conn,$query);
				}

				if($_POST['del_tov']=='Удалить'){
					$id=$_POST['id'];
					$query="DELETE FROM `tovar` WHERE `id`='$id' ";
						echo "Товар удален";		
						$result=mysqli_query($conn,$query);
				}

				if($_POST['del_cat']=='Удалить'){
					$id=$_POST['id'];
					$query="DELETE FROM `category` WHERE `id`='$id' ";
						echo "Категория удалена";		
						$result=mysqli_query($conn,$query);
				}

				if ($_POST['cat']=='Добавить категорию товара') {
					?>
					<form name="myForm" id="myForm" action="insert.php" method="POST">
						<h1>Добавление категории</h1>
						<label for="name">*Название категории: </label>
						<input type="text" name="name" required>
						<br>
						<br>
						<div class="button-fix">
							<input type="submit" name="category" value="Добавить">
						</div>
					</form>
					<?
				}
				if ($_POST['category']=='Добавить') {
					$name=$_POST['name'];
					$query="INSERT INTO `category`(`name`) VALUES ('$name')";
					echo "Категория добавлена";		
					$result=mysqli_query($conn,$query);
				}
				?>

		</div>
		<?}
	else
	echo "У вас нет доступа на эту страницу";?>
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