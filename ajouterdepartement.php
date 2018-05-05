<?php
if (isset($_SESSION['user']))

    header('Location: authentification/authentification.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Système Gestion hôpital</title>
    <?php include("db_data.inc.php");?>
    <link href="css/styles.css" rel="stylesheet">
    <link href="img/logo.png" rel="icon"/>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php
    $submit = 0;
    if (!empty($_POST['deptID'])&&!empty($_POST['deptName']))
    {
        $_bdd= db_connect();
        $req= $_bdd->prepare("SELECT * FROM departement d WHERE d.id_departement=:val");
        $req->execute(array('val'=>$_POST['deptID']));
        if($req->rowCount()) $submit=2;
        else
        {
            $req= $_bdd->prepare("SELECT * FROM departement d WHERE d.nom_departement=:val");
            $req->execute(array('val'=>$_POST['deptName']));
            if($req->rowCount()) $submit=3;
            else {
                $req = $_bdd->prepare("INSERT INTO departement (id_departement,nom_departement,description) VALUES (:val1,:val2,:val3)");
                $req->execute(array('val1' => $_POST['deptID'], 'val2' => $_POST['deptName'], 'val3' => $_POST['deptDesc']));
                $submit = 1;
            }

        }
    }
    ?>

</head>

<body>
<!--- Header starts --------->
<div class="row header" style="background-color:rgb(51,122,183)">
    <nav class="navbar navbar-expand-sm  navbar-dark ">
        <div class="col-md-10 container-fluid">
            <div class="navbar-header">
                <h2 style="color: white"> &nbsp;&nbsp; Gestion de l'hopital </h2>
            </div>
        </div>
            <div class="col-md-2 ">
            <ul class="nav navbar-nav navbar-right">
                <li >
                <li ><a href="deconnexion.php" class="deconnexion"><span class="glyphicon glyphicon-log-out" aria-hidden="true" ></span> &nbsp; Déconnexion</a></li>
                </li>
            </ul>
            </div>
    </nav>
</div>


<div class="row" >

    <!----- Menu Area Start ------>
        <div class="col-md-2 sidenav height:700x;" >
            <a href="#"><h1></h1></a>
            <ul class="nav nav-pills nav-stacked ">
                <li ><a href="indexPatient.php">&nbsp Patients </a></li>
                <li><a href="medecin.php">&nbsp Docteurs</a></li>
                <li class="active"><a href="departement.php">&nbsp Départements</a></li>
                <li><a href="chambre.php">&nbsp Chambres</a></li>
            </ul>
        </div>



    <div class="col-md-10 contenu">
        <br> <br>
        <!-----------  Content Menu Tab Start   ------------>
        <div class="panel panel-info contentinside">
            <div class="panel-heading"><strong>Gestion de département</strong></div>

            <!----------------   Panel Body Start   --------------->
            <div class="panel-body">
                <?php if($submit==1) echo '<div class="alert alert-success alert-dismissible fade in">
                        <strong>Success!</strong> <a href="departement.php" >Liste des départements</a>.
                    </div>' ;
                if($submit==2) echo '<div class="alert alert-danger">
                        <strong>Attention!</strong> Cette ID existe déjà .
                    </div>';
                if($submit==3 ) echo '<div class="alert alert-danger">
                        <strong> Le départment de ' .$_POST['deptName'].' existe!</strong> <a href="departement.php" > cliquer ici pour le afficher </a>.
                    </div>'
                ?>




                <!----------------   Add Department Start   --------------->

                <div class="panel panel-default">
                    <div class="panel-body">

                        <form class="form-horizontal" method="post">

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">ID Département</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="deptID" placeholder="Entrez l'ID du département" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Nom du département</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="deptName" placeholder="Entez le nom du Departement" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Description du département </label>
                                <div class="col-sm-4">
                                    <textarea class="form-control" rows="5" id="comment" name="deptDesc" placeholder="Entez la  Description ..."></textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-10">
                                    <button type="submit" class="btn btn-primary" ">Ajouter Departement</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <!----------------   Add Department Ends   --------------->

                </div>



                <!----------------   Panel Body Ends   --------------->
            </div>
            <!-----------  Content Menu Tab Ends   ------------>
        </div>
        <!-------   Content Area Ends  --------->
    </div>


</body>
</html>