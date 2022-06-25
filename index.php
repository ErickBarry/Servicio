<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/49f2039b91.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
       

</head>
<body class="stretched sticky-responsive-menu" data-loader="7">
    <header>
        
    <div class="navbar-fixed">
    <nav class="cyan darken-4">
      <div class="row">
        <div class="col l2 m2 s2 center">
          <img src="./assets/img/IPNBlancoyNegro.png" class="rensponsive-img"  alt="LogoIPN" width="43%">
        </div>
        <div class="col l8 m8 s8">
          <div class="nav-wrapper">
            <a href="http://localhost/servicio/" class="brand-logo"><i class="fa-solid fa-house-chimney fa-2x"></i></a>
            <a href="" data-target="mobile-demo" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
            <ul class="right hide-on-med-and-down">
              <li><a href="http://localhost/TT2/Conocenos.php">Conócenos</a></li>
            </ul>
          </div>
        </div>
        <div class="col l2 m2 s2 center">
          <img src="./assets/img/escudoESCOM1.png" class="rensponsive-img"  alt="LogoIPN" width="37%">
        </div>
      </div>
    </nav> 
    </div>
    <ul class="sidenav" id="mobile-demo">
          <li><a href="http://localhost/TT2/Conocenos.php">Conócenos</a></li>
          <li><a href="http://localhost/TT2/evaluacion/login.html">Log in</a></li>
          <li><a href="http://localhost/TT2/evaluacion/cuenta/">Crear cuenta</a></li>
          
    </ul> 

    </header>
   
  <!--MENU--> 
  
  <!-- Nav Lateral -->
  <section class="NavLateral">
    <?php include("./html/comunes/lateral.html"); ?>
  </section>
  

    <h1>Hola</h1>


  <!--Footer-->
    <footer class="page-footer grey darken-4">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Polilibro</h5>
                <p class="grey-text text-lighten-4">Escuela Superior de Cómputo - IPN</p>
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="https://www.escom.ipn.mx/"><i class="fas fa-university fa-2x"></i> ESCOM</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i class="fas fa-graduation-cap fa-2x"></i></a></li>
          
                </ul>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Contactos <i class="fa-solid fa-user-group"></i></h5>
                <ul>      
                  <li>Profesora Josefina</li>
                  <li>Porfesor Eduardo</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2022 Copyright
            </div>
          </div>
        </footer>
            




<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script src="./js/index.js"></script>

 

</body>
</html>
