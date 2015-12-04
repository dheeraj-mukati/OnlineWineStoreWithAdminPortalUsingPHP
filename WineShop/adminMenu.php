<?php
session_start ();

$username = $_SESSION ['admin_user'];
if (! isset ( $username )) {
	header ( 'Location: index.php' );
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<style type="text/css">
.menu2 {
	background-color: #232f3e;
	height: 150px;
	border: 2px ridge silver;
	width: 100%;
	margin: 0;
	padding: 0;
	background-color: #000 top: 0;
	left: 0;
}

.logo2 {
	position: relative;
	height: 146px;
}

.sub_menu {
    left: 791px;
    top: -49px;
    position: relative;
    font-size: 18px;
    font-family: arial, sans-serif;
    color: white;
}
.menuLabel {
	font-size: 18px;
	font-family: arial, sans-serif;
	color: #f0ad4e;
}

.activeLink {
	color: white;
}
.finalReview {
    display: block;
    width: 100%;
    padding: 0;
    margin-bottom: 20px;
    font-size: 21px;
    line-height: inherit;
    color: #333;
    border: 0;
    border-bottom: 1px solid #e5e5e5;
}
.fontColor {
	
	font-size: 18px;
	font-family: arial, sans-serif;
	color: white;
}
</style>
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<div class="menu2">
		<div>
			<a href="adminHome.php"><img class="logo2" alt="" src="images/logo.jpg"></a>
		</div>
		<div class="sub_menu">

				<ul class="nav navbar-nav">
					<li class="active"><a class="fontColor" href="#">Hello, <?php echo $_SESSION ['admin_user'];?> <span class="sr-only">(current)</span></a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle fontColor"
						data-toggle="dropdown" role="button" aria-haspopup="true"
						aria-expanded="false">Action <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="addWine.php">Add Wine</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="addWinery.php">Add Winery</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="addWineType.php">Add Wine Type</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="addRegion.php">Add Region</a></li>
						</ul></li>
						<li><a class="fontColor" href="index.php?logOutUser=true">Sign Out</a></li>
				</ul>
			</div>
	</div>
</body>
</html>