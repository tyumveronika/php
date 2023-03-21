<?php 
session_start();
if($_POST['vihod']=='выйти') { $_SESSION['login']='';$_SESSION['status']='';}
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
		
	<div class="products">
		<?
		$category=$_POST['category'];
		if ($category=='все товары'){
			$query="SELECT * FROM `tovar`";
		}
		else{
			$query="SELECT * FROM `tovar` WHERE `category`='$category' ";
		}
		
		//echo $query;
		$result=mysqli_query($conn,$query);

		while($row=mysqli_fetch_row($result)) {

		?>
		<div class="product">
					<img src='img/<?php echo $row[2];?>'>
					<div class="text">
						<div class="product-name">
							<h4><?echo $row[1];?></h4>
						</div>
						<div class="about">
							<p><?echo $row[5];?></p>
						</div>
						<h2><?echo $row[3];?>руб.</h2>
					</div>
					<div class="button-fix">
						<form action="single.php" method="post">
							<input type="hidden" name="id" value="<? echo $row[0]; ?>">
							<input type="submit" name="tovar" value="Купить">
						</form>
					</div>
		</div>
		<?
	}
		?>
				
	</div>
	</main>
	<br>
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
	</div>
</body>
</html>