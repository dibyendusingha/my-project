<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title> Sign up / Login Form</title>
  <link rel="stylesheet" href="{{asset('style.css')}}">

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="post" action="{{url('user-reg')}}">
                @csrf
					<label for="chk" aria-hidden="true" >Sign up</label>
					<input type="text" name="name" placeholder="User name" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button type="submit">Sign up</button>
				</form>
			</div>

			<div class="login">
				<form method="post" action="{{url('user-login')}}">
                @csrf
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="name" placeholder="name" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button type="submit">Login</button>
				</form>
			</div>
	</div>
</body>
</html>
<!-- partial -->
  
</body>
</html>
