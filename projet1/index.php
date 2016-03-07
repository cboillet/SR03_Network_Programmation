<html>
<head>
	<title>Trombinoscope SR03</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript">
		function controle(form) {
			var prenom = form.prenom.value;
			var nom = form.nom.value;
			if (!prenom || !nom)
				alert("c'est pas bien");
		}
	</script>
</head>

<header>
	<form name="formulaire" action="index.php" method="post">
		<input type="text" name="prenom" placeholder="Prénom" value="<?php if ($_POST['prenom']) echo $_POST['prenom']; ?>"/>
		<input type="text" name="nom" placeholder="Nom" value="<?php if ($_POST['nom']) echo $_POST['nom']; ?>"/> <br/>
		<input type="submit" value="chercher" onClick="controle(formulaire)"/>
	</form>
</header>

<body>
<?php
	include'utils.php';
	if ($_POST["prenom"] && $_POST["nom"])
	{
		$content = file_get_contents('https://webapplis.utc.fr/Trombi_ws/mytrombi/result?nom='.$_POST["nom"].'&prenom='.$_POST["prenom"]);		
		$result = json_decode($content);

		foreach ($result as $r) {
		    	$urlPhoto = "https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur_mini?username=".$r->login;
			echo "<div>";
				if(checkRemoteFile($urlPhoto) == FALSE)	{
					echo '<img src="https://www.123comparer.fr/images/no-image.jpg"/>';
				}
				else {
					echo '<img src="'.$urlPhoto.'" />';
				}
				echo "<br/>".$r->nom;
			echo "</div>";
		}	
	}
?>
</body>
</html>
