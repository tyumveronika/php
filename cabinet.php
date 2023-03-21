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
		<div class="cab">
			<?
					if ($_POST['avatar']=='Изменить аватар') {
						$id=$_POST['id'];
						$img=$_POST['img'];

						$query="UPDATE `reg` SET `img`='$img' WHERE `id`='$id' ";		
						$result=mysqli_query($conn,$query);
					}

					if ($_POST['data']=='Изменить данные') {
						$id=$_POST['id'];
						$name1=$_POST['name1'];
						$name2=$_POST['name2'];
						$email=$_POST['email'];
						$login=$_POST['login'];

						$query="UPDATE `reg` SET `name1`='$name1',`name2`='$name2',`email`='$email',`login`='$login'  WHERE `id`='$id' ";		
						$result=mysqli_query($conn,$query);
					}

					if ($_POST['info']=='Изменить контактные данные') {
						$id=$_POST['id'];
						$country=$_POST['country'];
						$city=$_POST['city'];
						$pochta=$_POST['pochta'];
						$street=$_POST['street'];
						$phone=$_POST['phone'];

						$query="UPDATE `reg` SET `country`='$country',`city`='$city',`pochta`='$pochta',`street`='$street',`phone`='$phone'  WHERE `id`='$id' ";		
						$result=mysqli_query($conn,$query);
					}

				if ($_SESSION['login']=='') {
					echo "Вы не авторизовались, пройдите в <a href='auto.php'>авторизацию</a>";
				}
					else
					{
						$login_s=$_SESSION['login'];
						$password_s=$_SESSION['password'];
						$status_s=$_SESSION['status'];
					$query="SELECT * FROM `reg` WHERE `login`='$login_s' AND `password` = '$password_s' ";
							
					$result=mysqli_query($conn,$query);
					$row=mysqli_fetch_array($result);
					$num=mysqli_num_rows($result);
					if ($num == 1) {
						?>
			<h1>Личный кабинет</h1>
			<div class="avatar">
				
				<img src="img/avatar/<?echo $row[12];?>">
			</div>
			<div class="button-file">
				<form action="cabinet.php" method="POST">
					<input type="hidden" name="id" value="<?echo $row[0];?>">
					<label class="custom-file-upload">
						Выбрать файл
						<input type="file" name="img">
					</label>
					<br>
					<div class="button">
					<input type="submit" name="avatar" value="Изменить аватар">
					</div>
				</form>
			</div>

			<form action="cabinet.php" method="POST">
			<div class="client-info">
				<span>Имя:</span>
				<input type="text" name="name1" value="<?echo $row[1];?>">
			</div>
			<div class="client-info">
				<span>Фамилия:</span>
				<input type="text" name="name2" value="<?echo $row[2];?>">
			</div>
			<div class="client-info">
				<span>Электронная почта:</span>
				<input type="text" name="email" value="<?echo $row[3];?>">
			</div>
			<div class="client-info">
				<span>Логин:</span>
				<input type="text" name="login" value="<?echo $row[4];?>">
			</div>
			<div class="button">
				<input type="hidden" name="id" value="<?echo $row[0];?>">
				<input type="submit" name="data" value="Изменить данные">
			</div>
			</form>
			<h1>Адрес</h1>
			<form action="cabinet.php" method="POST">
				<div class="client-info">
					<span>Страна:</span>
					<input type="text" name="country" value="<?echo $row[6];?>">
				</div>
				<div class="client-info">
					<span>Город:</span>
					<input type="text" name="city" value="<?echo $row[7];?>">
				</div>
				<div class="client-info">
					<span>Почтовый индекс:</span>
					<input type="text" name="pochta" value="<?echo $row[8];?>">
				</div>
				<div class="client-info">
					<span>Улица, дом, квартира:</span>
					<input type="text" name="street" value="<?echo $row[9];?>">
				</div>
				<div class="client-info">
					<span>Номер телефона:</span>
					<input type="text" name="phone" value="<?echo $row[10];?>">
				</div>
				<div class="button">
					<input type="hidden" name="id" value="<?echo $row[0];?>">
					<input type="submit" name="info" value="Изменить контактные данные">
				</div>
			</form>
			<h1>История покупок</h1>
			<table class="table-cab">
		      <tr>
		      	<th>Наименование</th>
		      	<th></th>
		      	<th>Описание</th>
		         <th>Кол-во</th>
		         <th>Стоимость</th>
		         <th>Дата</th>
		      </tr>
<?
$query="SELECT * FROM `zakaz` WHERE `login`='$login_s' ";
							
					$result=mysqli_query($conn,$query);
					while ($row=mysqli_fetch_array($result)) {
?>
		      <tr>
		      	<th><?echo $row[1];?></th>
		      	<td><img src="img/<?echo $row[2];?>"></td>
		      	<th><?echo $row[4];?></th>
		         <th><?echo $row[3];?></th>
		         <th><?echo $row[5];?></th>
		         <th><?echo $row[6];?></th>
		      </tr>
<?
}
?>
		      
			</table>
		</div>
		<?}}?>
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