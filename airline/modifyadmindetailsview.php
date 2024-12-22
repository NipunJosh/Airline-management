<?php 
require_once "dbconnection.php";
if(isset($_POST['submit']))
{
	$count=0;
	$catch=$_POST['flightcode'];
	$sql="select * from flight where FLIGHT_CODE='$catch'";
	$res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			if($catch==$row['FLIGHT_CODE'])
			{
				$duration=$row['DURATION'];
				$arrival=$row['ARRIVAL'];
				$departure=$row['DEPARTURE'];
				$economyclass=$row['PRICE_ECONOMY'];
				$businessclass=$row['PRICE_BUSINESS'];
				$count+=1;
			}
			else
			{
				$count=0;
			}
		}
	}
	if($count==0)
	{
		echo "<script>alert('Flight Code not in database')</script>";
		echo "<script>window.location='modifyadmindetails.html'</script>";
	}
	$sql="insert into selected(FLIGHT_CODE) values('$catch')";
	$res=mysqli_query($con,$sql);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		*{
			margin: 0;
			padding: 0;
			font-family: Century Gothic;
		}
		ul{
			float: right;
			list-style-type: none;
			margin-top: 25px;
		}
		ul li{
			display: inline-block;
		}
		ul li a{
			text-decoration: none;
			color: #fff;
			padding: 5px 20px;
			border: 1px solid #fff;
			transition: 0.6s ease;
		}
		ul li a:hover{
			background-color: #fff;
			color: #000;
		}
		ul li.active a{
			background-color: #fff;
			color: #000;
		}
		.title{
			position: absolute;
			top: 20%;
			left: 50%;
			transform: translate(-50%,-50%);	
		}
		.title h1{
			color: #fff;
			font-size: 40px;
		}
		body{
			background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(plane.jpg);
			height: 100vh;
			background-size: cover;
			background-position: center;
		}
		.form-container {
			position:absolute;
            display:grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin:200px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .form-container div {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
			color: #fff;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        input[type="submit"] {
            grid-column: span 4;
            padding: 20px 20px;
            border: none;
            border-radius: 5px;
			color:#000;
            font-size: 16px;
            cursor: pointer;
        }
		input[type=submit]:hover{
			background-color: #fff;
	        color:#000;
		}
	</style>
</head>
<body>
	<div class="main">
			<ul>
				<li class="active"><a href="#">Modify Flight Details</a></li> 
			</ul>
	</div>
	<div class="title">
		<h1>Modify Flight Details</h1>
	</div>
	<form action="modifyflightdetails.php" method="post" class="form-container">
	        <div>
                <label for="departure">Departure</label>
                <input type="text" name="departure" placeholder="<?php echo $departure; ?>">
            </div>
            <div>
                <label for="arrival">Arrival</label>
                <input type="text" name="arrival" placeholder="<?php echo $arrival; ?>">
            </div>
            <div>
                <label for="duration">Duration</label>
                <input type="text" name="duration" placeholder="<?php echo $duration; ?>">
            </div>
            <div>
                <label for="businessclass">Business Class Price</label>
                <input type="number" name="businessclass" placeholder="<?php echo $businessclass; ?>">
            </div>
            <div>
                <label for="economyclass">Economy Class Price</label>
				<input type="number" placeholder=<?php echo $economyclass ?> name="economyclass">
            </div>
            <div>
                <input type="submit" value="Modify" name="submit">
            </div>
        </form>
</body>
</html>



