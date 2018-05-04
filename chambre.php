<?php  
 if (isset($_SESSION['user'])) 
 
header('Location: authentification/authentification.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link href="img/logo.png" rel="icon"/>
    <meta charset="utf-8">
    <title> Système Gestion hôpital</title>
    <link href="css/styles.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>

</head>

<body>
<!--- début header --------->
<div class="row " style="background-color:rgb(51,122,183)">
    <nav class="navbar navbar-expand-sm  navbar-dark ">
        <div class="col-md-10 container-fluid">
            <div class="navbar-header">
                <h2 style="color: white"> &nbsp;&nbsp; Gestion de l'hopital </h2>
            </div>
        </div>
        <div class="col-md-2 ">
            <ul class="nav navbar-nav navbar-right">
                <li>
                <li ><a href="deconnexion.php" class="deconnexion"><span class="glyphicon glyphicon-log-out" aria-hidden="true" ></span> &nbsp; Déconnexion</a></li>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!--- fin header --------->
<!----- début Menu ------>
<div class="row" >

    <div class="col-md-2 sidenav height:700x;" >
        <h1></h1>
        <ul class="nav nav-pills nav-stacked ">
            <li ><a href="indexPatient.php">&nbsp Patients </a></li>
            <li ><a href="medecin.php">&nbsp Docteurs</a></li>
            <li ><a href="departement.php">&nbsp Départements</a></li>
            <li class="active"><a href="#">&nbsp Chambres</a></li>
        </ul>
    </div>
    <!----- fin Menu ------>

    <!-----------  Début Contenu ------------>
    <div class="col-md-10 contenu">
        <br> <br>

        <div class="panel panel-info contentinside">
            <!----------------   Panel Head   --------------->
            <div class="panel-heading"><strong>Gestion des chambres</strong></div>
            <!----------------   Panel Body Start   --------------->
            <div class="panel-body">
                <form class="navbar-form pull-right" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Rechercher..." name="search">
                    </div>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
                </form>
                <br/> <br/> <br/>
                <!----------------   Affichage Tableau commence ici   --------------->
                <ul class="nav nav-tabs">
                    <li id="button1"><a class="active"  href="#"><strong>Liste Des Chambres</strong></a></li>
                </ul>
                <div id="affichage">
                <table class="table table-bordered table-hover">
                    <tr class="active ">
                        <td ><strong>Numero</strong></td>
                        <td ><strong>Departement</strong></td>
                        <td ><strong>Etage</strong></td>
                        <td><strong>Occupee</strong></td>
                    </tr>
                    <?php
                    try{
                        $bdd2= new PDO('mysql:host=localhost;dbName=hopital', 'root', '');
                    }
                    catch (PDOException$e) { print"Erreur : " . $e->getMessage();die(); }
                    $bdd2->query("USE hopital");
                    if((isset($_GET["search"]))AND(!empty($_GET["search"]))){
                        $reponse= $bdd2->query('select * from chambre WHERE numero LIKE "'.$_GET["search"].'%"');
                    }
                    else{
                        $reponse= $bdd2->query('select * from chambre ORDER by numero ASC ');
                    }
                    if($reponse){
                        $resultat = $reponse->fetchAll(PDO:: FETCH_OBJ );
                        foreach($resultat as $res) :
                            echo '<tr><td>';
                            echo $res->numero;
                            $x=$res->numero;
                            echo '<td>';
                            echo $res->departement;
                            echo '<td>';
                            echo $res->etage;
                            echo '<td>';
                            echo $res->occupee;
                        endforeach;
                        $reponse->closeCursor();
                    }
                    ?>
                </table>
                </div>
                <div id="formulaire" style="display: none">
                            <form method="post" action="addmed.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="doctname" placeholder="Name" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">LastName</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="doctlastname" placeholder="LastName" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phon" placeholder="Phone No." required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Department</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="dept">
                                            <option selected="selected">Select Department</option>
                                            <option>
                                                Neurology</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Add Doctor</button>
                                    </div>
                                </div>
                            </form></div>
                <!----------------   fin Tableau   --------------->
            </div>
            <!----------------   fin Panel   --------------->
        </div>
    </div>
</div>
<!-------   fin Contenu --------->
</body>
</html>
