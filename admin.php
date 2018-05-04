 <?php  if ((isset($_SESSION['user']))&&($_SESSION['user']!="admin")) 
header("Refresh:1; url=authentification/authentification.php"); ?>
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
            <li ><a href="admin.php">&nbsp Réceptionnistes </a></li>
        </ul>
    </div>
    <!----- fin Menu ------>

    <!-----------  Début Contenu ------------>
    <div class="col-md-10 contenu">
        <br> <br>

        <div class="panel panel-info contentinside">
            <!----------------   Panel Head   --------------->
            <div class="panel-heading"><strong>Gestion des receptionnistes</strong></div>
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
                    <li id="button1"><a class="active"  href="#"><strong>Liste Des Réceptionnistes</strong></a></li>
                    <li id="button2"><a href="#" ><strong>Ajouter Receptionniste</strong></a></li>
                </ul>
                <div id="affichage">
                <table class="table table-bordered table-hover">
                    <tr class="active ">
                        <td ><strong>Id receptionniste</strong></td>
                        <td ><strong>Nom du receptionniste</strong></td>
                        <td ><strong>Prenom du receptionniste</strong></td>
                        <td><strong>Sexe</strong></td>
                        <td><strong>Date de naissance</strong></td>
                        <td><strong>Date de debut de travail</strong></td>
                        <td><strong>username</strong></td>
                        <td><strong>password</strong></td>
                        <td style="text-align:center"><strong>Modifier</strong></td>
                    </tr>
                    <?php
                    try{
                        $bdd2= new PDO('mysql:host=localhost;dbName=hopital', 'root', '');
                    }
                    catch (PDOException$e) { print"Erreur : " . $e->getMessage();die(); }
                    $bdd2->query("USE hopital");
                    if((isset($_GET["search"]))AND(!empty($_GET["search"]))){
                        $reponse= $bdd2->query('select * from receptionniste WHERE nom LIKE "'.$_GET["search"].'%"');
                    }
                    else{
                        $reponse= $bdd2->query('select * from receptionniste ORDER by id_receptionniste ASC ');
                    }
                    if($reponse){
                        $resultat = $reponse->fetchAll(PDO:: FETCH_OBJ );
                        foreach($resultat as $res) :
                            echo '<tr><td>';
                            echo $res->id_receptionniste;
                            $x=$res->id_receptionniste;
                            echo '<td>';
                            echo $res->nom;
                            echo '<td>';
                            echo $res->prenom;
                            echo '<td>';
                            echo $res->sexe;
                            echo '<td>';
                            echo $res->date_naissance;
                            echo '<td>';
                            echo $res->date_debuttravail;
                            echo '<td>';
                            echo $res->user;
                            echo '<td>';
                            echo $res->pass;
                            echo '<td>';
                            echo '<a href="deletereceptionniste.php?id='.$x.'"><button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>';
                        endforeach;
                        $reponse->closeCursor();
                    }
                    ?>
                </table>
                </div>
                <div id="formulaire" style="display: none">
                            <form method="post" action="addreceptionniste.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" placeholder="" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">LastName</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="lastname" placeholder="" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Sexe</label>
                                  
                                 <div class="col-sm-10">
                                        <input type="text" class="form-control" name="sexe" placeholder="" required="required">
                                    </div>
                                  
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Date de naissance</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="Dn" placeholder="" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Date de debut de travail</label>
                                    <div class="col-sm-10">
                                <input type="date" class="form-control" name="Dt" placeholder="" required="required">
                                
                                    </div>
                                       <div class="form-group">
                                    <label  class="col-sm-2 control-label">username</label>
                                    <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" placeholder="" required="required">
                                
                                    </div>
                                           <div class="form-group">
                                    <label  class="col-sm-2 control-label">password</label>
                                    <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="" required="required">
                                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Add Réceptionniste</button>
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
<script src="js/scriptmed.js"> </script>
</body>
</html>
