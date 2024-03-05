<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap"
			rel="stylesheet"
		/>
        <link rel="stylesheet" href="./style/login.css">
        <link rel="apple-touch-icon" href="./img/favicon.ico">
        <meta name="theme-color" content="#8a1668"/>
        <link rel="manifest" href="manifest.json" />
		<title>Login</title>
	</head>
	<body>
            <form action="./backend/login.php" method="post" id="myForm">
            <h1>
                Dr Hibist Pediatrician
            </h1>
            <div class="logo">
                <img src="./img/logo.png" alt="">
            </div>
            <p class="error">
                <?php
                @$msg = $_REQUEST['msg'];
                echo $msg;
                ?>
            </p>
            <p class="succ">
                <?php
                @$lout = $_REQUEST['lout'];
                echo $lout;
                ?>
            </p>
            <div class="formElement">
                <input type="number" min="0" name="phone" id="phone" autocomplete="off" required>
                <label for="phone" class="labelName"><span class="contentName">Phone Number</span></label>
            </div>
            <div class="formElement">
                <input type="password" name="pass" id="pass" autocomplete="on" required>
                <label for="pass" class="labelName"><span class="contentName">Password</span></label>
            </div>
            <div>
                <input type="submit" name="login" value="Login" class="btn btn-primary" name="Login" onclick="login()">
            </div>
        </form>
	</body>
</html>
<script>
    if ("serviceWorker" in navigator) {
  window.addEventListener("load", function() {
    navigator.serviceWorker
      .register("./serviceWorker.js")
      .then(res => console.log("service worker registered"))
      .catch(err => console.log("service worker not registered", err))
  })
}
</script>