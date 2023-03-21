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
		<div class="title">
			<h1>Корзина</h1>
		</div>
		<div class="basket">
<?
		$id_tovar=$_POST['id'];
		$query="SELECT * FROM `tovar` WHERE `id`='$id_tovar'";
		//echo $query;
		$result=mysqli_query($conn,$query);

		while($row=mysqli_fetch_row($result)) 
		{
			$name=$row[1];
			$img=$row[2];
			$about=$row[5];
			$kolvo=1;
			$price=$row[3];
			$user=$_SESSION['login'];
			$id_tov=$row[0];

			$query3="SELECT * FROM `korzina` WHERE `id_tov`='$id_tov' ";
			$result3=mysqli_query($conn,$query3);
			$num=mysqli_num_rows($result3);

			if ($num>0) {
				$kolvo=$kolvo+1;
				$query2="UPDATE `korzina` SET `kolvo`='$kolvo' WHERE `id_tov`='$id_tov' ";
			}
			else{
				$query2="INSERT INTO `korzina`(`id_tov`,`name`, `img`, `about`, `kolvo`, `price`, `user`) 
								   VALUES ('$id_tov','$name','$img','$about','$kolvo','$price','$user')";
			}

			$result2=mysqli_query($conn,$query2);

		}	
		if ($_POST['plus']=='+') {
			$id_tov=$_POST['id_tov'];
			$kolvo=$_POST['kolvo']+1;
					$query2="UPDATE `korzina` SET `kolvo`='$kolvo' WHERE `id_tov`='$id_tov' ";
		//echo $query;
			$result2=mysqli_query($conn,$query2);

		}
		if ($_POST['minus']=='-') {
			$id_tov=$_POST['id_tov'];
			if ($_POST['kolvo']==1){
				$query2="DELETE FROM `korzina` WHERE `id_tov`='$id_tov' ";
			}
			else{
				$kolvo=$_POST['kolvo']-1;
				$query2="UPDATE `korzina` SET `kolvo`='$kolvo' WHERE `id_tov`='$id_tov' ";
			}
			$result2=mysqli_query($conn,$query2);

		}

		$user=$_SESSION['login'];
		$query="SELECT * FROM `korzina` WHERE `user`='$user' ";
		//echo $query;
		$result=mysqli_query($conn,$query);

		while($row=mysqli_fetch_row($result)) {
?>
			<div class="basket-content">
				<div class="basketItem-content">
					<div class="basketItem-img">
						<a href="" class="basketItem-img-link">
						<img src="img/<? echo $row[3]; ?>">
					</a>
					</div>
					<div class="basketItem-info">
						<a href="" class="basketItem-link"><? echo $row[2]; ?></a>
						<p><? echo $row[4]; ?></p>
					</div>
				</div>
				<div class="basketItem-buttons">
					<div class="basket-buttons">
						<form method="POST" action="basket.php">
							<input type="hidden" name="kolvo" value="<? echo $row[5]; ?>">
							<input type="hidden" name="id_tov" value="<? echo $row[1]; ?>">
							<div class="basket-buttons-style">
								<input type="submit" name="plus" value="+">
							</div>
						</form>
						<label> <? echo $row[5]; ?></label>
						<form method="POST" action="basket.php">
							<input type="hidden" name="kolvo" value="<? echo $row[5]; ?>">
							<input type="hidden" name="id_tov" value="<? echo $row[1]; ?>">
							<div class="basket-buttons-style">
								<input type="submit" name="minus" value="-">
							</div>
						</form>
					</div>
				</div>
				<div class="basketItem-price">
					<label><? echo $sum = $row[6]*$row[5]; ?></label>
					<?
                        $summa=$summa+$sum;
                    ?>
				</div>
			</div>
<? } ?>


			<div class="basket-info">
				<div class="basket-info-container">
					<div class="basket-info-wrapper">
						<h2>ИТОГО</h2>
						<h2><?
                                echo $summa;
                            ?></h2>
					</div>
					<div class="basket-info-button-container">
						<button>Оформить заказ</button>
					</div>
				</div>
			</div>
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