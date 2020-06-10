<!DOCTYPE html> 
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>four1 Journée</title>

  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
   
  <!-- Navigation -->
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

  <!-- Page Content -->

 <!--  Bootstrap core JavaScript -->
 <!-- <script src="vendor/jquery/jquery.slim.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-------------------------------------------------- choix des différent graphique ------------------------------------------------------------------------------------------------------------------------>
<form  class="form-inline" method="post">
<div class="col-md-7 mb-6">
  <label for="validationCustom04">Choix du grapique voulu:</label>
  </div>
  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="test" onChange="window.location.href=this.value" >
    <div class="col-md-3 mb-3">
    <option selected disabled hidden >Choisir...</option>
    <option  value ="Graphique.php"> T-stockage</option>
    <option  value ="Graphique2.php"> Les Fours</option>
    </div>
  </select>
</form>
  



 <!--  Bootstrap core JavaScript -->
 <!-- <script src="vendor/jquery/jquery.slim.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>
 

 
  <!-------------------------------------------------- graphique en place  ------------------------------------------------------------------------------------------------------------------------>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  
  <!-- moment JS , pour les dates chart JS necessite moment js-->
<!-- Moment.js is an open source library that allows you to parse, validate, manipulate and display dates in JavaScript. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/fr.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/fr.js"></script>

<!-- chart JS BUNDLE visiblement doit contenir momentJS !!! pas si sûr !!!-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script> 
  
  <!--  https://www.chartjs.org/docs/latest/general/responsive.html#important-note -->
    <div id ="div_stockage" style="position: relative; height:40vh; width:80vw">
       <canvas id="graphique"></canvas> <!-- on créé une div canvas qui sert a créé un graph l'id est le nom de notre graphique -->
     </div>
  
  <script>
  $(document).ready(function () {
      ajax_graphique_journee_four1();
      setInterval(ajax_graphique_journee_four1, 10000);
  });

  function ajax_graphique_journee_four1()
  {
      $.ajax({
          type: 'GET',
          url: 'json_graphique_four1.php',
          dataType: 'json',
          timeout: 3000,
          success: function (donnees)
          { // donnees contient le Json renvoyé
//            // on definit une variable qui contient le debut de l'enregistrement, pour mettre en info sur l'axe du temps
           var debut_enregistrement_four1 = donnees['four1'][0]['x'];
            console.log(debut_enregistrement_four1);
        
            // formatage
            moment.locale('fr');
            var debut_enregistrement_four1 = moment(debut_enregistrement_four1).format('dddd, MMM DD -- HH:mm:ss');
            console.log(debut_enregistrement_four1);


            // graphique
            $("#graphique").remove();
            $("#div_stockage").append("<canvas id='graphique'>  </canvas>");
            var ctx1 = document.getElementById('graphique').getContext('2d');
            var scatterChart = new Chart(ctx1, {
              type: 'scatter',
              //type: 'scatter',  points non reliés
              data: {
                  datasets: [{
                    label: 'T four1',
                    hidden: false,
                    //backgroundColor: 'rgba(0, 0, 0, 0.5)',
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderWidth: 2, // 3 par défaut épaisseur de la ligne
                    borderColor: 'darkred', // couleur de la ligne
                    pointStyle : 'star',
                    //borderDash: [10, 5], // ceci sont les traits avec les pointillier
                    radius: 0.5,
                    lineTension: 0.2,
                    showLine : true,
                    data: donnees['four1'],
                    yAxisID: 'L'
                  },
                  {
                    label: 'T entreeFour1 ' ,
                    //backgroundColor: 'rgba(0, 0, 0, 0.5)',
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderWidth: 2, // 3 par défaut épaisseur de la ligne
                    borderColor: 'red', // couleur de la ligne
                    pointStyle : 'star',
                    radius: 0.5,
                    lineTension: 0.2,
                    showLine : true,
                    data: donnees['entree_four1'], 
                    yAxisID : 'L'
                  },
                  {
                    label: 'Puissance fossile' ,
                    //backgroundColor: 'rgba(0, 0, 0, 0.5)',
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderWidth: 2, // 3 par défaut épaisseur de la ligne
                    borderColor: 'blue', // couleur de la ligne
                    pointStyle : 'star',
                    radius: 1,
                    lineTension: 0,
                    showLine : true,
                    data: donnees['puissance_fossile'], 
                    yAxisID : 'R'                     
                 }]
              },
              
              options: {
                animation: {
                    duration: 0 // general animation time
                },
                scales: {
                    yAxes: [{
                       id : 'L',  
                       position : 'left',
                        display: true,
                        ticks: {
                            suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                            // OR //
                            beginAtZero: true, 
                            // minimum value will be 0.
                            suggestedMax: 250, 
                            fontColor: "red",
                            fontStyle : "bold"
                        },
                        scaleLabel: {
                        display: true,
                        labelString: 'températures en °C', 
                        fontColor : 'red',
                        fontStyle : "bold"
                        }
                    }, {
                       id : 'R',
                       position : 'right',
                        display: true,
                        ticks: {
                            suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                            // OR //
                            beginAtZero: true, 
                            // minimum value will be 0.
                            suggestedMax: 150,
                            fontColor: "blue",
                            fontStyle : "bold"
                        },
                        scaleLabel: {
                        display: true,
                        labelString: 'Puissance en kW', 
                        fontColor : 'blue',
                        fontStyle : "bold"
                        }
                    }],
                    xAxes: [{
                        position: 'bottom',
                        type: 'time',
                        time:{
                            tooltipFormat: 'ddd, MMM DD -- HH:mm:ss',  //dans l'infobulle sur chaque mesure !!! pas sur l'axe...
                            //format datetime de mysql 'YYYY-MM-DD hh:mm:ss'

                            // voir https://momentjs.com/docs/#/displaying/format/   pour les formats HH sur 24h hh sur 12h il faut rajouter a pour am ou pm
                            // je ne sais pas que est le format de la date alors je les mets tous au format qui me va
                            displayFormats: {
                               'millisecond': 'DD MMM / HH:mm:ss',
                               'second': 'DD MMM / HH:mm:ss',
                               'minute': 'DD MMM / HH:mm:ss',
                               'hour': 'DD MMM / HH:mm:ss',
                               'day': 'DD MMM / HH:mm:ss',
                               'week': 'DD MMM / HH:mm:ss',
                               'month': 'DD MMM / HH:mm:ss',
                               'quarter': 'DD MMM / HH:mm:ss',
                               'year': 'DD MMM / HH:mm:ss'
                            }
                            },
                          
                        scaleLabel: { // titre de l'axe des abscisses
                        display:     true,
                        labelString: "Début d'enregistrement des données : " +debut_enregistrement_four1,
                        fontColor : 'black',
                        fontStyle : "bold"
                        },
                        ticks: {
                        fontColor: "black",
                        fontStyle : "bold"
                        }
                     }]
                }

              }
             
            });

          }
           //error: function(resultat, statut, erreur){alert('pb');}
      });
    }
</script>
</body>
 