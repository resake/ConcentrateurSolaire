  <?php  /*  érreure 3 secu marche sur rasp, mais pas en local
session_start();
if ($_GET['deconnexion'] == true) {
  unset($_SESSION['id']);
}
if (!isset($_SESSION['id'])) {
    echo "Attention : vous n'avez pas accès à cette page, vous devez être connecté";             
    echo '<br/>';
    echo '<a href="projet1/index.php">Se connecter</a>';
    die();
}
*/?>  

<!-- PAGE DU SYNOPTIQUE -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
 
  <title>Concetrateur Solaire</title>

    <!-- Bootstrap  CSS via leurs lien https qui sert à la mise en place de la bande noir du menu, ainsi qu'a la disposition -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

 <link rel="stylesheet" href="css/style.css" type="text/css">
  <script src="script.js"></script>

</head>

<body onload="getData()" >

  <!-- Navigation -->
  <!-- on se retrouve dans le menu en haut, ou nous écrivons les menus clicable qui nous redirigent vers les pages voulues comme :
   Accueil.php, Historique.php, RepresentationSpatiale.php, GraphiqueCapteur.php -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Menu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="accueil.php">Accueil
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Historique.php">Historique</a> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Graphique.php">Representation spatiale</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="CapteurGraph.php">Graphique Capteur</a>
          </li>
          <li class="nav-item">
          <?php if (isset($_SESSION['id'])) { ?>
              <a class="btn btn-outline-primary" href="index.php?deconnexion=true"> Déconnexion</a>   
          <?php } ?>
        </li>
        </ul>
      </div>
    </div>
  </nav>
</nav>

  <!-- placement des points pour le synoptique -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="wrapper" onload="getData()">

          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 998 660.5">
         <defs>
       <linearGradient id="Degrade_storage" x1="798" y1="239" x2="798" y2="97" gradientUnits="userSpaceOnUse">
          <stop id="deg1" offset="0.0556" stop-color="#787878" />
          <stop id="deg2" offset="0.1668" stop-color="#787878" />
          <stop id="deg3" offset="0.278" stop-color="#787878" />
          <stop id="deg4" offset="0.3892" stop-color="#787878" />
          <stop id="deg5" offset="0.5" stop-color="#787878" />
          <stop id="deg6" offset="0.6116" stop-color="#787878" />
          <stop id="deg7" offset="0.7228" stop-color="#787878" />
          <stop id="deg8" offset="0.834" stop-color="#787878" />
          <stop id="deg9" offset="0.9452" stop-color="#787878" />
        </linearGradient>
        <linearGradient id="Degrade_scale" x1="872" y1="97" x2="872" y2="239" gradientUnits="userSpaceOnUse">
          <stop offset="0.04" stop-color="#8d0005" />
          <stop offset="0.14" stop-color="#ff1811" />
          <stop offset="0.15" stop-color="#ff1f12" />
          <stop offset="0.25" stop-color="#ff7f22" />
          <stop offset="0.28" stop-color="#ff9928" />
          <stop offset="0.37" stop-color="#fff93e" />
          <stop offset="0.43" stop-color="#bcfb5b" />
          <stop offset="0.5" stop-color="#70fe7d" />
          <stop offset="0.57" stop-color="#32ffc3" />
          <stop offset="0.63" stop-color="#01fffa" />
          <stop offset="0.72" stop-color="#00a2f9" />
          <stop offset="0.77" stop-color="#0079f8" />
          <stop offset="0.84" stop-color="#003ff7" />
          <stop offset="0.89" stop-color="#001cf7" />
          <stop offset="0.92" stop-color="#0017d6" />
          <stop offset="0.97" stop-color="#000e95" />
          <stop offset="1" stop-color="#000a7c" />
        </linearGradient>
      </defs>
      <title></title>
      <g id="Calque_2" data-name="Calque 2">
        <g id="Calque_1-2" data-name="Calque 1">
          <rect class="mirror" x="85" y="336" width="530" height="57" />
          <polygon id="sec1" class="section-1" points="4 240 24 240 24 355 679 355 679 375 4 375 4 240" />
          <polygon id="sec2" class="section-2"
            points="745 355 745 375 825 375 825 428 845 428 845 375 905 375 905 428 925 428 925 355 808 355 808 328 788 328 788 355 745 355" />
          <rect id="sec4" class="section-4" x="825" y="494" width="20" height="46" />
          <rect id="sec3" class="section-3" x="905" y="494" width="20" height="46" />
          <rect id="sec5" class="section-5" x="788" y="242" width="20" height="20" />
          <polygon id="sec6" class="section-6"
            points="788 94 808 94 808 59 858 59 858 39 738 39 738 59 788 59 788 94" />
          <polygon id="van1" class="vanne-1" points="682 351 712 365 742 351 742 379 712 365 682 379 682 351" />
          <polygon id="van2" class="vanne-2" points="812 265 798 295 812 325 784 325 798 295 784 265 812 265" />
          <polygon id="van5" class="vanne-5" points="849 431 835 461 849 491 821 491 835 461 821 431 849 431" />
          <polygon id="van6" class="vanne-6" points="929 431 915 461 929 491 901 491 915 461 901 431 929 431" />
          <polygon id="van3" class="vanne-3" points="921 62 891 48 861 62 861 34 891 48 921 34 921 62" />
          <rect id="sec8" class="section-8" x="924" y="38" width="38" height="20" />
          <rect id="sec7" class="section-7" x="634" y="39" width="38" height="20" />
          <polygon id="van4" class="vanne-4" points="735 63 705 49 675 63 675 35 705 49 735 35 735 63" />

          <g id="Fan" data-name="Fan">
            <path
              d="M25.71,209H2.29A2.28,2.28,0,0,0,0,211.29v23.42A2.28,2.28,0,0,0,2.29,237H25.71A2.28,2.28,0,0,0,28,234.71V211.29A2.28,2.28,0,0,0,25.71,209ZM2.29,210.71a.58.58,0,0,1,0,1.15.58.58,0,0,1,0-1.15Zm0,24.58a.58.58,0,1,1,.57-.58A.58.58,0,0,1,2.29,235.29ZM14,234.37A11.37,11.37,0,1,1,25.37,223,11.37,11.37,0,0,1,14,234.37Zm11.72.92a.58.58,0,1,1,.57-.58A.58.58,0,0,1,25.72,235.29Zm0-23.43a.58.58,0,1,1,.57-.57A.58.58,0,0,1,25.72,211.86Z" />
            <g id="fan_propeller-1">
              <path
                d="M24,220.94a1.1,1.1,0,0,0-.39-.65c-1.73-1.43-4.13-1.34-7.2.29a3.69,3.69,0,0,0-.66-.52q3.16-2.85,5.78-2.39a.57.57,0,0,0,.55-.91,9.82,9.82,0,0,0-2.47-2.3,1.09,1.09,0,0,0-.74-.19c-2.24.22-3.87,2-4.89,5.3a3.85,3.85,0,0,0-.83.1c.15-2.84.95-4.76,2.4-5.78a.57.57,0,0,0-.25-1,10.09,10.09,0,0,0-3.38.12,1.1,1.1,0,0,0-.65.39c-1.43,1.73-1.34,4.14.29,7.21a3.36,3.36,0,0,0-.52.66c-1.9-2.12-2.69-4.05-2.39-5.79a.57.57,0,0,0-.91-.55,10,10,0,0,0-2.3,2.47,1,1,0,0,0-.18.74q.32,3.36,5.29,4.89a3.85,3.85,0,0,0,.1.83q-4.24-.22-5.78-2.4a.57.57,0,0,0-1,.26A10,10,0,0,0,4,225.06a1.1,1.1,0,0,0,.39.65c1.74,1.43,4.14,1.34,7.21-.29a3.36,3.36,0,0,0,.66.52q-3.18,2.85-5.79,2.39a.57.57,0,0,0-.55.91,9.7,9.7,0,0,0,2.48,2.3,1.05,1.05,0,0,0,.73.19c2.24-.22,3.87-2,4.89-5.3a3.85,3.85,0,0,0,.83-.1c-.15,2.84-.95,4.76-2.4,5.78a.57.57,0,0,0,.26,1,10,10,0,0,0,3.37-.12,1.1,1.1,0,0,0,.65-.39c1.43-1.73,1.34-4.14-.28-7.21a3,3,0,0,0,.51-.66q2.85,3.18,2.39,5.79a.57.57,0,0,0,.91.55,9.82,9.82,0,0,0,2.3-2.47,1.09,1.09,0,0,0,.19-.74c-.22-2.24-2-3.87-5.3-4.89a3.31,3.31,0,0,0-.1-.83c2.84.15,4.76,1,5.78,2.4a.57.57,0,0,0,1-.26A10,10,0,0,0,24,220.94Zm-10,4.92A2.86,2.86,0,1,1,16.86,223,2.86,2.86,0,0,1,14,225.86Z" />
            </g>
          </g>

          <g id="Fan-2">
            <path
              d="M990.71,34H967.29A2.28,2.28,0,0,0,965,36.29V59.71A2.28,2.28,0,0,0,967.29,62h23.42A2.28,2.28,0,0,0,993,59.71V36.29A2.28,2.28,0,0,0,990.71,34Zm-23.42,1.71a.58.58,0,0,1,0,1.15.58.58,0,0,1,0-1.15Zm0,24.58a.58.58,0,1,1,.57-.58A.58.58,0,0,1,967.29,60.29ZM979,59.37A11.37,11.37,0,1,1,990.37,48,11.37,11.37,0,0,1,979,59.37Zm11.72.92a.58.58,0,1,1,.57-.58A.58.58,0,0,1,990.72,60.29Zm0-23.43a.58.58,0,1,1,.57-.57A.58.58,0,0,1,990.72,36.86Z" />
            <g id="fan_propeller-2">
              <path
                d="M989,45.94a1.1,1.1,0,0,0-.39-.65c-1.73-1.43-4.13-1.34-7.2.29a3.69,3.69,0,0,0-.66-.52q3.16-2.85,5.78-2.39a.57.57,0,0,0,.55-.91,9.82,9.82,0,0,0-2.47-2.3,1.09,1.09,0,0,0-.74-.19c-2.24.22-3.87,2-4.89,5.3a3.85,3.85,0,0,0-.83.1c.15-2.84,1-4.76,2.4-5.78a.57.57,0,0,0-.25-1,10.09,10.09,0,0,0-3.38.12,1.1,1.1,0,0,0-.65.39c-1.43,1.73-1.34,4.14.29,7.21a3.36,3.36,0,0,0-.52.66c-1.9-2.12-2.69-4.05-2.39-5.79a.57.57,0,0,0-.91-.55,10,10,0,0,0-2.3,2.47,1,1,0,0,0-.18.74q.32,3.36,5.29,4.89a3.85,3.85,0,0,0,.1.83q-4.24-.22-5.78-2.4a.57.57,0,0,0-1,.26,10,10,0,0,0,.12,3.37,1.1,1.1,0,0,0,.39.65c1.74,1.43,4.14,1.34,7.21-.29a3.36,3.36,0,0,0,.66.52q-3.18,2.85-5.79,2.39a.57.57,0,0,0-.55.91,9.7,9.7,0,0,0,2.48,2.3,1.05,1.05,0,0,0,.73.19c2.24-.22,3.87-2,4.89-5.3a3.85,3.85,0,0,0,.83-.1c-.15,2.84-1,4.76-2.4,5.78a.57.57,0,0,0,.26,1,10,10,0,0,0,3.37-.12,1.1,1.1,0,0,0,.65-.39c1.43-1.73,1.34-4.14-.28-7.21a3,3,0,0,0,.51-.66q2.85,3.18,2.39,5.79a.57.57,0,0,0,.91.55,9.82,9.82,0,0,0,2.3-2.47,1.09,1.09,0,0,0,.19-.74c-.22-2.24-2-3.87-5.3-4.89a3.31,3.31,0,0,0-.1-.83c2.84.15,4.76.95,5.78,2.4a.57.57,0,0,0,1-.26A10,10,0,0,0,989,45.94Zm-10,4.92A2.86,2.86,0,1,1,981.86,48,2.86,2.86,0,0,1,979,50.86Z" />
            </g>
          </g>

          <rect class="storage" x="757" y="97" width="82" height="142" />
          <rect class="scale" x="862" y="97" width="20" height="142" />
          <line class="hyphen" x1="882" y1="133" x2="886" y2="133" />
          <line class="hyphen" x1="882" y1="97" x2="886" y2="97" />
          <line class="hyphen" x1="882" y1="168" x2="886" y2="168" />
          <line class="hyphen" x1="882" y1="204" x2="886" y2="204" />
          <line class="hyphen" x1="882" y1="239" x2="886" y2="239" />
          <text class="txtscale" transform="translate(886.04 99)">250°C</text>
          <text class="txtscale" transform="translate(886.04 135)">190°C</text>
          <text class="txtscale" transform="translate(886.04 170)">140°C</text>
          <text class="txtscale" transform="translate(886.04 206)">78°C</text>
          <text class="txtscale" transform="translate(886.04 241)">20°C</text>
          <rect id="ov1" class="oven-1" x="805.5" y="543" width="62" height="102" />
          <rect id="ov2" class="oven-2" x="883.5" y="543" width="62" height="102" />
          <path id="flam1" class="flame-1"
            d="M850.41,623.42c-.45-6-3.23-9.71-5.68-13-2.27-3-4.23-5.69-4.23-9.58a.84.84,0,0,0-1.32-.68,21.23,21.23,0,0,0-7.82,11.31,36.41,36.41,0,0,0-.86,8.45c-3.4-.72-4.17-5.81-4.18-5.86a.83.83,0,0,0-1.19-.63c-.17.08-4.37,2.21-4.62,10.73,0,.28,0,.57,0,.85a15,15,0,0,0,15,15h0a15,15,0,0,0,15-15C850.5,624.58,850.41,623.42,850.41,623.42ZM835.5,638.34a5.18,5.18,0,0,1-5-5.33v-.32A6.83,6.83,0,0,1,831,630a3,3,0,0,0,2.75,2,.84.84,0,0,0,.84-.83,16.37,16.37,0,0,1,.32-3.79,8.11,8.11,0,0,1,1.68-3.2,10.77,10.77,0,0,0,1.72,3.15,9.53,9.53,0,0,1,2.14,5.21c0,.14,0,.29,0,.44A5.18,5.18,0,0,1,835.5,638.34Z" />
          <path id="flam2" class="flame-2"
            d="M930.41,623.42c-.45-6-3.23-9.71-5.68-13-2.27-3-4.23-5.69-4.23-9.58a.84.84,0,0,0-1.32-.68,21.23,21.23,0,0,0-7.82,11.31,36.41,36.41,0,0,0-.86,8.45c-3.4-.72-4.17-5.81-4.18-5.86a.83.83,0,0,0-1.19-.63c-.17.08-4.37,2.21-4.62,10.73,0,.28,0,.57,0,.85a15,15,0,0,0,15,15h0a15,15,0,0,0,15-15C930.5,624.58,930.41,623.42,930.41,623.42ZM915.5,638.34a5.18,5.18,0,0,1-5-5.33v-.32A6.83,6.83,0,0,1,911,630a3,3,0,0,0,2.75,2,.84.84,0,0,0,.84-.83,16.37,16.37,0,0,1,.32-3.79,8.11,8.11,0,0,1,1.68-3.2,10.77,10.77,0,0,0,1.72,3.15,9.53,9.53,0,0,1,2.14,5.21c0,.14,0,.29,0,.44A5.18,5.18,0,0,1,915.5,638.34Z" />
          <rect class="mirror" x="85" y="295" width="530" height="36" />
          <rect class="mirror" x="85" y="257.5" width="530" height="32" />
          <rect class="mirror" x="85" y="224.5" width="530" height="28" />
          <rect class="mirror" x="85" y="195.5" width="530" height="24" />
          <rect class="mirror" x="85" y="397.5" width="530" height="36" />
          <rect class="mirror" x="85" y="439" width="530" height="32" />
          <rect class="mirror" x="85" y="476" width="530" height="28" />
          <rect class="mirror" x="85" y="509" width="530" height="24" />
          <line class="hyphen" x1="757" y1="239" x2="751" y2="239" />

          <polygon class="boxdisplay" points="753.5 231 744.5 227 744.5 224 698.5 224 698.5 238 744.5 238 744.5 235 753.5 231"/>
          <foreignObject x="699" y="224" width="49" height="20">
            <div id="stockT1" class="textdivstorage" onmouseover="hovertxt('stockT1')" onmouseout="nonehoverstorage()">
              <p>error</p>
            </div> 
          </foreignObject>
          <polygon class="boxdisplay" points="753.5 215 744.5 211 744.5 208 698.5 208 698.5 222 744.5 222 744.5 219 753.5 215"/>
          <foreignObject x="699" y="208" width="49" height="20">
            <div id="stockT2" class="textdivstorage" onmouseover="hovertxt('stockT2')" onmouseout="nonehoverstorage()">
              <p>error</p>
            </div> 
          </foreignObject>
          <polygon class="boxdisplay" points="753.5 199.2 744.5 195.2 744.5 192.2 698.5 192.2 698.5 206.2 744.5 206.2 744.5 203.2 753.5 199.2"/>
          <foreignObject x="699" y="191.6" width="49" height="20">
            <div id="stockT3" class="textdivstorage" onmouseover="hovertxt('stockT3')" onmouseout="nonehoverstorage()">
              <p>error</p>
            </div> 
          </foreignObject>
          <polygon class="boxdisplay" points="753.5 183.3 744.5 179.3 744.5 176.3 698.5 176.3 698.5 190.3 744.5 190.3 744.5 187.3 753.5 183.3"/>
          <foreignObject x="699" y="176.4" width="49" height="20">
            <div id="stockT4" class="textdivstorage" onmouseover="hovertxt('stockT4')" onmouseout="nonehoverstorage()">
              <p>error</p>
            </div> 
          </foreignObject>
          <polygon class="boxdisplay" points="753.5 167.5 744.5 163.5 744.5 160.5 698.5 160.5 698.5 174.5 744.5 174.5 744.5 171.5 753.5 167.5"/>
          <foreignObject x="699" y="160.4" width="49" height="20">
            <div id="stockT5" class="textdivstorage" onmouseover="hovertxt('stockT5')" onmouseout="nonehoverstorage()">
              <p>error</p>
            </div> 
          </foreignObject>
          <polygon class="boxdisplay" points="753.5 151.5 744.5 147.5 744.5 144.5 698.5 144.5 698.5 158.5 744.5 158.5 744.5 155.5 753.5 151.5"/>
          <foreignObject x="699" y="144" width="49" height="20">
            <div id="stockT6" class="textdivstorage" onmouseover="hovertxt('stockT6')" onmouseout="nonehoverstorage()">
              <p>error</p>
            </div> 
          </foreignObject>
          <polygon class="boxdisplay" points="753.5 135.5 744.5 131.5 744.5 128.5 698.5 128.5 698.5 142.5 744.5 142.5 744.5 139.5 753.5 135.5"/>
          <foreignObject x="699" y="128.4" width="49" height="20">
            <div id="stockT7" class="textdivstorage" onmouseover="hovertxt('stockT7')" onmouseout="nonehoverstorage()">
              <p>error</p>
            </div> 
          </foreignObject>
          <polygon class="boxdisplay" points="753.5 119.5 744.5 115.5 744.5 112.5 698.5 112.5 698.5 126.5 744.5 126.5 744.5 123.5 753.5 119.5"/>
          <foreignObject x="699" y="112" width="49" height="20">
            <div id="stockT8" class="textdivstorage" onmouseover="hovertxt('stockT8')" onmouseout="nonehoverstorage()">
              <p>error</p>
            </div> 
          </foreignObject>
          <polygon class="boxdisplay" points="753.5 103.5 744.5 99.5 744.5 96.5 698.5 96.5 698.5 110.5 744.5 110.5 744.5 107.5 753.5 103.5"/>
          <foreignObject x="699" y="96" width="49" height="20">
            <div id="stockT9" class="textdivstorage" onmouseover="hovertxt('stockT9')" onmouseout="nonehoverstorage()">
              <p>error</p>
            </div> 
          </foreignObject>
          <line class="hyphen" x1="757" y1="221.8" x2="751" y2="221.8" />
          <line class="hyphen" x1="757" y1="206.2" x2="751" y2="206.2" />
          <line class="hyphen" x1="757" y1="190.6" x2="751" y2="190.6" />
          <line class="hyphen" x1="757" y1="174" x2="751" y2="174" />
          <line class="hyphen" x1="757" y1="158.4" x2="751" y2="158.4" />
          <line class="hyphen" x1="757" y1="142.8" x2="751" y2="142.8" />
          <line class="hyphen" x1="757" y1="127.2" x2="751" y2="127.2" />
          <line class="hyphen" x1="757" y1="111.6" x2="751" y2="111.6" />
          <line class="hyphen" x1="757" y1="97" x2="751" y2="97" />

          <polygon class="boxdisplay"
            points="532.5 334.5 582.5 334.5 582.5 356.5 563.5 356.5 557.5 365.5 551.5 356.5 532.5 356.5 532.5 334.5" />
          <foreignObject x="532.5" y="334.5" width="49" height="20">
            <div id="rcptT4" class="textdiv" onmouseover="hovertxt('rcptT4')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <polygon class="boxdisplay"
            points="619.5 334.5 669.5 334.5 669.5 356.5 650.5 356.5 644.5 365.5 638.5 356.5 619.5 356.5 619.5 334.5" />
          <foreignObject x="619.5" y="334.5" width="49" height="20" >
            <div id="rcptTS" class="textdiv" onmouseover="hovertxt('rcptTS')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <polygon class="boxdisplay"
            points="328.5 334.5 378.5 334.5 378.5 356.5 359.5 356.5 353.5 365.5 347.5 356.5 328.5 356.5 328.5 334.5" />
          <foreignObject x="328.5" y="334.5" width="49.2" height="20">
            <div id="rcptT3" class="textdiv" onmouseover="hovertxt('rcptT3')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <polygon class="boxdisplay"
            points="116.5 334.5 166.5 334.5 166.5 356.5 147.5 356.5 141.5 365.5 135.5 356.5 116.5 356.5 116.5 334.5" />
          <foreignObject x="116.5" y="334.5" width="49" height="20">
            <div id="rcptT2" class="textdiv" onmouseover="hovertxt('rcptT2')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <polygon class="boxdisplay"
            points="30.5 334.5 80.5 334.5 80.5 356.5 61.5 356.5 55.5 365.5 49.5 356.5 30.5 356.5 30.5 334.5" />
          <foreignObject x="30.5" y="334.5" width="49" height="20">
            <div id="rcptTE" class="textdiv" onmouseover="hovertxt('rcptTE')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <polygon class="boxdisplay"
            points="838.5 529.5 848.5 523.5 848.5 520.5 897.5 520.5 897.5 538.5 848.5 538.5 848.5 535.5 838.5 529.5" />
          <foreignObject x="848.5" y="520.5" width="50" height="17">
            <div id="oven1TE" class="textdivhorizon" onmouseover="hovertxt('oven1TE')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <polygon class="boxdisplay"
            points="917.5 529.5 927.5 523.5 927.5 520.5 976.5 520.5 976.5 538.5 927.5 538.5 927.5 535.5 917.5 529.5" />
          <foreignObject x="927.5" y="520.5" width="50" height="17">
            <div id="oven2TE" class="textdivhorizon" onmouseover="hovertxt('oven2TE')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <polygon class="boxdisplay"
            points="31.5 222.5 41.5 216.5 41.5 212.5 114.5 212.5 114.5 232.5 41.5 232.5 41.5 228.5 31.5 222.5" />
          <foreignObject x="41.5" y="213.5" width="72.2" height="18" >
            <div id="fandeb1" class="textdivhorizonlarg" onmouseover="hovertxt('fandeb1')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>
          
          <polygon class="boxdisplay"
            points="942 0.5 1015 0.5 1015 22.5 985.5 22.5 979.5 31.5 973.5 22.5 942 22.5 942 0.5" />
          <foreignObject x="942.5" y="0.5" width="71" height="20">
            <div id="fandeb2" class="textdivlarg" onmouseover="hovertxt('fandeb2')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <rect class="boxdisplay" x="811" y="568.5" width="50" height="18" />
          <foreignObject x="812" y="568.5" width="50" height="17">
            <div id="oven1T" class="textdivhorizon" onmouseover="hovertxt('oven1T')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <rect class="boxdisplay" x="890" y="568.5" width="50" height="18" />
          <foreignObject x="891" y="568.5" width="50" height="17">
            <div id="oven2T" class="textdivhorizon" onmouseover="hovertxt('oven2T')" onmouseout="nonehovertxt()">
              <p>error</p>
            </div>
          </foreignObject>

          <text class="textoven" transform="translate(816.63 658)">Four 1</text>
          <text class="textoven" transform="translate(896 658)">Four 2</text>
        </g>
      </g>
    </svg>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
