<!Doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Plongée</title>
		
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">  

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	</head>
    <body>


	<form action="signin.php">
		<center>
  		<div class="formulaire">
    		<label for="email"><b>Email</b></label>
    		<input type="text" placeholder="Email" name="email" required>

    		<label for="mdp"><b>Mot de passe</b></label>
    		<input type="password" placeholder="Mot de passe" name="mdp" required>

    		
  			<button class="btn waves-effect waves-light" type="submit" name="action">Se connecter<i class="material-icons right">send</i>
  			</button>

  		</div>
		<div class="mdp">
    		<span class="mdp"><a href="#">Mot de passe oublié ?</a></span>
  		</div>
  	</center>
	</form> 
</body>
</html>