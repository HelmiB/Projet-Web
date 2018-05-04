<?php
if (isset($_SESSION['user']))
    header("Refresh:1; url=authentification/authentification.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="img/logo.png" rel="icon"/>
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
            <li class="active"><a href="indexPatient.php">&nbsp Patients </a></li>
            <li><a href="medecin.php">&nbsp Docteurs</a></li>
            <li ><a href="departement.php">&nbsp Départements</a></li>
            <li><a href="chambre.php">&nbsp Chambres</a></li>
        </ul>
    </div>
    <!----- fin Menu ------>

    <!-----------  Début Contenu ------------>
    <div class="col-md-10 contenu">
        <br> <br>

        <div class="panel panel-info contentinside">
            <!----------------   Panel Head   --------------->
            <div class="panel-heading"><strong>Gestion des patients</strong></div>
            <!----------------   Panel Body Start   --------------->
            <div class="panel-body">
                <div class="row" >

             <!----------------   Formulaire Ajout Visite  --------------->
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div>
                    <form class="navbar-form pull-right">
                        <a  href="Fiche.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary">Retour</a>
                    </form>
                </div>
                <br><br>
                <form class="form-horizontal" method="post" action="ajoutVisite.php?dep=<?php echo $_GET['dep']; ?>&id=<?php echo $_GET['id']; ?>">

                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Type Visite</label>
                        <div class="col-sm-4">
                        <label class="radio-inline"><input type="radio" name="type" value="hospitalé">Patient hospitalisé</label>
                        <label class="radio-inline"><input type="radio" name="type" value="non hospitalisé">Patient non hospitalisé</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Date</label>
                        <div class="col-sm-4">
                            <input type="datetime-local" class="form-control" name="date" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Taille</label>
                        <div class="col-sm-4">
                            <input name="taille"  class="form-control" type="number" placeholder="taille" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Poids</label>
                        <div class="col-sm-4">
                            <input name="poids"  class="form-control" type="number" placeholder="poids" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Diagnostique</label>
                        <div class="col-sm-4">
                            <input name="diag"  class="form-control" type="text" placeholder="diagnostique" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Docteur</label>
                        <div class="col-sm-4">
                            <input name="doc"  class="form-control" type="text" placeholder="docteur" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Départment</label>
                        <div class="col-sm-4">
                            <input name="dep"  class="form-control" type="number" value="<?php echo $_GET['dep']; ?>" disabled="disabled"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <button type="submit" name="ok" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!----------------   fin Formulaire   --------------->
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
