<?php
	include('control/configall.php');
	include('gui/resource.php');
	$stt = true;
	// check admin to acess this page
	if (!isset($_SESSION['tmp_uname']) || checkAdmin($_SESSION['tmp_uname']) == false) $_need_admin = 1;
		include('control/permission.php');
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<script src="design/js/time.js"></script>
		<link rel="stylesheet" href="design/css/message.css">
		<style>
			input {
				box-shadow: none;
				outline: none;
				border-radius: 4px;
				border: 1px solid #ccc;
				font-size: 14px;
				height: 34px;
				color: #555;
				padding: 6px 12px;
				line-height: 1.42857143;
				margin: 0 0 5px 5px;
			}
			input[type="text"]:focus {
			border: 1px solid gray;
			}
		</style>
		<title>Manage</title>
	</head>
	<body class="fonts1">
		<div id="body-wrapper">
			<?php include('gui/header.php') ?>
			<div id="" class="section" style="background-color: #f0f0f0">
				<div id="" class="container">
					<h1>
					<span class="fontSize" style="font-size: 24px; line-height: 1;">
						<span>
							<span style="color:#696969;">Create Contest</span>
						</span>
					</span>
					</h1>
					<form method="post" action="contest_validate.php">
						<table>
							<tr>
								<td>Contest Name</td>
								<td>
									<input type="text" name="conName" required style="margin: 0 0 5px 5px;">
									<p id="d"></p>
								</td>
							</tr>
							<tr>
								<td>Duration</td>
								<td>
									<input type="number" name="duration" value="10" min="10" max="1000" style="margin: 0 0 5px 5px;">
									<p id="t"></p>
								</td>
							</tr>
							<tr>
								<td>Start time</td>
								<td>
									<input type="date" name="beginDate" style="margin: 0 0 5px 5px;" id="conDate" onchange="validDate()">
									<img src="img/calendar.png" width="20" height="20" />
									<input type="time" name="beginTime" style="margin: 0 0 5px 5px;" id="conTime">
									<img src="img/clock.png" width="20" height="20" />
								</td>
							</tr>
						</table>
						<div>
							<strong>Announcement</strong><br>
							<textarea name="blog" id="ten"></textarea>
							<br>
						</div>
						<button type="submit" class="btn btn-success">Create</button>
						<button class="btn btn-success" onclick="rr();">Reset</button>
						<script>
							function rr() {
								document.getElementById('ten').value = "";
							};
						</script>
					</form>
				</div>
			</div>
		</div>
		<?php include('gui/footer.php') ?>
		<script>CKEDITOR.replace('ten');</script>
		<h1>
			<span class="fontSize" style="font-size: 24px; line-height: 1;">
				<span>
					<span style="color:#696969;">Edit time</span>
					<form action=""></form>
				</span>
			</span>
		</h1>
	</body>
</html>