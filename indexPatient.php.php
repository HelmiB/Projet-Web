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
            <!----------------   Recherche Par nom   --------------->
                <form class="navbar-form pull-left" method="get" >
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Rechercher par nom" name="search1" >
                    </div>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
                </form>
                <!----------------   Recherche Par Date d'admission  --------------->
                <form class="navbar-form" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Rechercher par date d'admission" name="search2">
                    </div>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
                </form>
                <!----------------   Classement par Departement  --------------->
                <form class="navbar-form pull-right" method="get">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <select class="form-control" name="dep">
                                <option selected="selected">Séléctionner Départment</option>
                                <?php
                                try{
                                    $bdd= new PDO('mysql:host=localhost;dbname=hopital', 'root','');
                                }
                                catch (PDOException$e) { print"Erreur : " . $e->getMessage();die(); }
                                $bdd->query("USE hopital");
                                $reponse2= $bdd->query('select id_departement from departement ');
                                if($reponse2){
                                    $resultat2 = $reponse2->fetchAll(PDO:: FETCH_OBJ );
                                    foreach($resultat2 as $res2) :
                                        echo "<option>";
                                        echo $res2->id_departement;
                                        echo "</option>";
                                    endforeach;
                                    echo"</select>";
                                    $reponse2->closeCursor();
                                }
                                ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
                </form>
            </div>
                <!----------------   Panel Body Start   --------------->
            <div>
                <ul class="nav nav-tabs">
                    <li id="button1"><a  href="#"><strong>Liste patients hospitalisés</strong></a></li>
                    <li id="button2"><a  href="#"><strong>Historique Patients</strong></a></li>
                    <li id="button3"><a  href="#"><strong>Ajouter Patient</strong></a></li>
                </ul>
            </div>
                <!----------------   Affichage Liste Patients commence ici   --------------->
                <div id="listePatient">
                    <table class="table table-bordered table-hover">
                        <tr class="active ">
                            <th >CIN</th>
                            <th >Nom </th>
                            <th >Prénom </th>
                            <th >Date d'admission</th>
                            <th >Numéro téléphone</th>
                            <th >Numéro Chambre</th>
                            <th >Département</th>
                            <th >Fiche Patient</th>
                            <th >Editer</th>
                        </tr>
                        <?php
                        try {
                            $bdd= new PDO('mysql:host=localhost;dbname=hopital', 'root','');
                        } catch (PDOException$e) {
                            print"Erreur de connexion : " . $e->getMessage();
                            die();
                        }
                        $bdd->query("USE hopital");
                        if ((isset($_GET["search1"])) AND (!empty($_GET["search1"]))) {
                            $reponse = $bdd->query('select * from patient WHERE nom LIKE "' . $_GET["search1"] . '%" ORDER by nom ');
                        }
                        else if ((isset($_GET["search2"])) AND (!empty($_GET["search2"]))) {
                            $reponse = $bdd->query('select * from patient where date_hospitalisation LIKE "'.$_GET["search2"].'"');
                        }
                        else if (isset($_GET["dep"])) {
                            $reponse = $bdd->query('select * from patient where  departement='.$_GET['dep'].'');
                        }
                        else {$reponse = $bdd->query('select * from patient where date_sortie is null');}
                        if ($reponse) {
                            $resultat = $reponse->fetchAll(PDO:: FETCH_OBJ);
                            foreach ($resultat as $donnees) :
                                echo '<tr><td>';
                                echo $donnees->id;
                                echo '<td>';
                                echo $donnees->nom;
                                echo '<td>';
                                echo $donnees->prenom;
                                echo '<td>';
                                echo $donnees->date_hospitalisation;
                                echo '<td>';
                                echo $donnees->numero;
                                echo '<td>';
                                echo $donnees->chambre;
                                echo '<td>';
                                echo $donnees->departement;
                                echo '<td align="center">'
                                ?> <a href="<?php echo " Fiche.php?id=" . $donnees->id . " " ?>"
                                      class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"
                                                                    aria-hidden="true"></span></a>
                                <?php echo ' </td>' ?>
                                <?php echo '<td>' ?>
                                <a href="<?php echo " modifier.php?id=" . $donnees->id . " " ?>" class="btn btn-primary"
                                   style="alignment: center"><span class="glyphicon glyphicon-edit"
                                                                   aria-hidden="true"></span></a>
                                <?php echo '</td>' ?>
                            <?php endforeach;
                            $reponse->closeCursor();
                        }
                        ?>
                    </table>
                </div>
                <!----------------   fin Tableau   --------------->
                <!----------------   Affichage Historique commence ici   --------------->
                <div id="historiquePatient" style="display: none">
                    <table class="table table-bordered table-hover" >
                        <tr class="active ">
                            <th >Id Patient</th>
                            <th >Nom </th>
                            <th >Prénom </th>
                            <th >Date d'admission</th>
                            <th >Date de sortie</th>
                            <th >Numéro Chambre</th>
                            <th >Département</th>
                            <th >Dossier Médical</th>
                        </tr>
                        <?php
                        try {
                            $bdd = new PDO('mysql:host=localhost;dbname=hopital', 'root', '');
                        } catch (PDOException$e) {
                            print"Erreur de connexion : " . $e->getMessage();
                            die();
                        }
                        $bdd->query("USE hopital");
                        if ((isset($_GET["search1"])) AND (!empty($_GET["search1"]))) {
                            $reponse = $bdd->query('select * from patient WHERE nom LIKE "' . $_GET["search1"] . '%" ORDER by nom ');
                        }
                        else if ((isset($_GET["search2"])) AND (!empty($_GET["search2"]))) {
                            $reponse = $bdd->query('select * from patient where date_hospitalisation  LIKE "'.$_GET["search2"].'"');
                        }
                        else if (isset($_GET['dep'])) {
                            $num_dep = $_GET['dep'];
                            $reponse = $bdd->query('select * from patient where departement='.$_GET['dep'].'');
                        }
                        else {$reponse = $bdd->query('select * from patient where date_sortie!= "0000-00-00"');}
                        if ($reponse) {
                            $resultat = $reponse->fetchAll(PDO:: FETCH_OBJ);
                            foreach ($resultat as $donnees) :
                                echo '<tr><td>';
                                echo $donnees->id;
                                echo '<td>';
                                echo $donnees->nom;
                                echo '<td>';
                                echo $donnees->prenom;
                                echo '<td>';
                                echo $donnees->date_hospitalisation;
                                echo '<td>';
                                echo $donnees->numero;
                                echo '<td>';
                                echo $donnees->date_sortie;
                                echo '<td>';
                                echo $donnees->chambre;
                                echo '<td>';
                                echo $donnees->departement;
                                echo '<td align="center">'
                                ?> <a href="<?php echo " Fiche.php?id=" . $donnees->id . " " ?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                                <?php echo ' </td>' ?>
                            <?php endforeach;
                            $reponse->closeCursor();
                        }
                        ?>
                    </table>
                </div>
                <!----------------   fin Tableau   --------------->
                <!----------------   Formulaire Ajout Patient commence ici  --------------->
                <div id="FormPatient" style="display: none">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" method="post" action="ajoutPatient.php">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">CIN</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" name="cin" placeholder="CIN" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Nom</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Prénom</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Sexe</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="sexe">
                                            <option value="Homme">Homme</option>
                                            <option value="Femme">Femme</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Date de naissance</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" name="dn" placeholder="Date de naissance" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Numero de telephone</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="num" placeholder="NumeroTel" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Date d'admission</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" name="dh" placeholder="Date d'admission" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Départment</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="dep">
                                            <option selected="selected">Séléctionner Départment</option>
                                            <?php
                                            try{
                                                $bdd = new PDO('mysql:host=localhost;dbname=hopital', 'root','');
                                            }
                                            catch (PDOException$e) { print"Erreur : " . $e->getMessage();die(); }
                                            $bdd->query("USE hopital");
                                            $reponse2= $bdd->query('select id_departement from departement ');
                                            if($reponse2){
                                                $resultat2 = $reponse2->fetchAll(PDO:: FETCH_OBJ );
                                                foreach($resultat2 as $res2) :
                                                    echo "<option>";
                                                    echo $res2->id_departement;
                                                    echo "</option>";
                                                endforeach;
                                                echo"</select>";
                                                $reponse2->closeCursor();
                                            }
                                            ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Antécédents médicaux</label>
                                    <div class="col-sm-4">
                                        <textarea id="antecedents" name="antecedents" cols="40" rows="5" placeholder="Mentionner les antécédents médicaux" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-10">
                                        <button type="submit" name="ok" class="btn btn-primary">Ajouter Patient</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!----------------   fin Formulaire   --------------->
            </div>
            <!----------------   fin Panel   --------------->
        </div>
    </div>
</div>
<!-------   fin Contenu --------->
<script src="js/scriptpatient.js" ></script>
</body>
</html>