<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
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
		<?php
		
		$host='localhost';
		$base='vinokurov';
		$name='root';
		$pass='';

		$conn=mysqli_connect($host,$name,$pass,$base);
if($_SESSION['status']=='1'){
		?>
	<div class="users">
		<h1>Панель администратора</h1>
		<div class="button">
			<form method="post" action="insert.php">
				<div>
					<input type="submit" name="reg" value="Добавить пользователя">
					<input type="submit" name="tov" value="Добавить товар">
					<input type="submit" name="cat" value="Добавить категорию товара">
				</div>
			</form>
		</div>
		<?
		if ($_POST['data']=='Изменить данные') {
						$id=$_POST['id'];
						$name1=$_POST['name1'];
						$name2=$_POST['name2'];
						$email=$_POST['email'];
						$login=$_POST['login'];
						$country=$_POST['country'];
						$status=$_POST['status'];

						$query="UPDATE `reg` SET `name1`='$name1',`name2`='$name2',`email`='$email',`login`='$login',`country`='$country',`status`='$status'  WHERE `id`='$id' ";		
						$result=mysqli_query($conn,$query);
					}
		if ($_POST['edit']=='Редактировать') {
						$id=$_POST['id'];
						$name=$_POST['name'];
						$about=$_POST['about'];
						$about2=$_POST['about2'];
						$price=$_POST['price'];

						$query="UPDATE `tovar` SET `name`='$name',`about`='$about',`about2`='$about2',`price`='$price'  WHERE `id`='$id' ";		
						$result=mysqli_query($conn,$query);
					}
					
					?>
		<table class="table-admin">
		      <tr>
		      	<th>Аватар</th>
		      	<th>Имя</th>
		      	<th>Фамилия</th>
		      	<th>Логин</th>
		        <th>E-mail</th>
		        <th>Пароль</th>
		        <th>Страна</th>
		        <th>Город</th>
		        <th>Почтовый индекс</th>
		        <th>Улица</th>
		        <th>Телефон</th>
		        <th>Статус</th>
		      </tr>
<?
$query="SELECT * FROM `reg` ";
							
					$result=mysqli_query($conn,$query);
					while ($row=mysqli_fetch_array($result)) {
?>
		      <tr>
		      	<td><img src="img/avatar/<?echo $row[12];?>"></td>
		      	<th><?echo $row[1];?></th>
		         <th><?echo $row[2];?></th>
		         <th><?echo $row[4];?></th>
		         <th><?echo $row[3];?></th>
		         <th><?echo $row[5];?></th>
		         <th><?echo $row[6];?></th>
		         <th><?echo $row[7];?></th>
		         <th><?echo $row[8];?></th>
		         <th><?echo $row[9];?></th>
		         <th><?echo $row[10];?></th>
		         <th><?echo $row[11];?></th>
		         <th>
		         	<form action="insert.php" method="POST">
		         		<input type="hidden" name="id" value="<? echo $row[0];?>">
		         		<input type="submit" name="red_user" value="Редактировать">
		         		<input type="submit" name="del_user" value="Удалить">
		         	</form>
		         </th>
		      </tr>
<?
}
?>
		      
			</table>
	</div>
	<div class="admin-cat">
			<h2>Категории: </h2>
			<table>
				<?
				$query="SELECT * FROM `category`";
				$result=mysqli_query($conn,$query);

				while($row=mysqli_fetch_row($result)) {

				?>
				<tr>
					<th>
					<form method="post" action="admin.php">
						<input type="submit" name="category" value="<?echo $row[1];?>">
					</form>
					
				</th>
				<th>
					<form method="post" action="insert.php">
					<input type="hidden" name="id" value="<? echo $row[0];?>">
					<input type="submit" name="del_cat" value="Удалить">
					</form>
				</th>
				</tr>
				
				<?
				}
				?>
			</table>
	</div>
	<div class="products-admin">
		<table class="table-admin">
		      <tr>
		      	<th></th>
		      	<th>Наименование</th>
		      	<th>Краткое описание</th>
		      	<th>Описание</th>
		         <th>Стоимость</th>
		      </tr>
<?
$category=$_POST['category'];
		if ($category=='все товары'){
			$query="SELECT * FROM `tovar`";
		}
		else{
			$query="SELECT * FROM `tovar` WHERE `category`='$category' LIMIT 20  ";
		}
							
					$result=mysqli_query($conn,$query);

		while($row=mysqli_fetch_row($result)) {
?>
		      <tr>
		      	<td><img src="img/<?echo $row[2];?>"></td>
		         <th><?echo $row[1];?></th>
		         <th><?echo $row[5];?></th>
		         <th><?echo $row[6];?></th>
		         <th><?echo $row[3];?></th>
		         <th>
		         	<form action="insert.php" method="POST">
		         		<input type="hidden" name="id" value="<? echo $row[0];?>">
		         		<input type="submit" name="red_tov" value="Редактировать">
		         		<input type="submit" name="del_tov" value="Удалить">
		         	</form>
		         </th>
		      </tr>
<?
}
?>
		      
			</table>

				
	</div>
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
				<h5 style="color:white "> Адрес: г. Владивосток, ул. Ленина 1А, оф.304<br>
										Телефон: (4212) 90-42-12<br>
										Email: sotrs@mail.ru<br>
										Режим работы офиса: Пн - Пт: 9.00 - 17.30</h5>
		</div>
	</footer>
	<?}
	else{
	echo "У вас нет доступа на эту страницу";?>
	<br>
	<div class="admin-footer">
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
				<h5 style="color:white "> Адрес: г. Владивосток, ул. Ленина 1А, оф.304<br>
										Телефон: (4212) 90-42-12<br>
										Email: sotrs@mail.ru<br>
										Режим работы офиса: Пн - Пт: 9.00 - 17.30</h5>
		</div>
	</div>
		<?}?>
	</div>
</body>
</html>