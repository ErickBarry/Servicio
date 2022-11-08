
<!DOCTYPE html>
<html lang="es">
<html>
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

   

        
</head>
<body>
<?php

session_start();
//obtener los datos de la sesion
$montoNecesitado=$_SESSION["monto"];
return $montoNecesitado;
?>
</body>
</html>