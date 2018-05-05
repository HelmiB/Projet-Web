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

                <form class="navbar-form pull-right" action="departement.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Rechercher..." name="search" >
                    </div>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> </button>
                </form>
                <br/> <br/> <br/>



                <!----------------   Affichage Tableau commence ici   --------------->
                                <ul class="nav nav-tabs">
                    <li id="button1"><a class="active"  href="#"><strong>Liste Des Departements</strong></a></li>
                    <li id="button2"><a href="ajouterdepartement.php" ><strong>Ajouter Departement</strong></a></li>
                </ul>
                 <table class="table table-bordered table-hover" id="myTable">
                    <tr class="active">
                          <td width="160"><strong>Département ID </strong> <button class="btn btn-link" style="alignment:right" onclick="sortTable(0)" ><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></button>
                        </td>
                        <td width="180"><strong>Nom Département </strong><button class="btn btn-link" style="alignment:right" onclick="sortTable(1)"  ><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></button>
                        </td>
                        <td><strong>Description Département</strong> </td>
                        <td width="150" style="text-align:center"><strong>Modifier</strong></td>
                    </tr>
                    <?php
                    $_bdd= db_connect();
                    if(!empty( $_POST['UpdateName'])||!empty( $_POST['UpdateDescription'])){
                        $upreq= $_bdd->prepare("UPDATE departement set nom_departement=:val1,description=:val2 WHERE id_departement=:val3");
                        $upreq->execute(array('val1'=>$_POST['UpdateName'],'val2'=>$_POST['UpdateDescription'],'val3'=>$_POST['UpdateId']));
                    }
                    if(isset($_POST['search']) && !empty($_POST['search']))
                        $req="SELECT * from departement d where id_departement like '%".$_POST['search']."%' OR nom_departement like '%".$_POST['search']."%' OR description like '%".$_POST['search']."%'";
                    else $req="SElECT * FROM departement d";

                    $reponse= $_bdd->query($req);
                    while($row=$reponse->fetch(PDO::FETCH_ASSOC)) {
                        $ID = $row['id_departement'];
                        $nom = $row['nom_departement'];
                        $description = $row['description'];

                        echo '<tr>';
                        echo '<td style="text-align:center">' . $row['id_departement'] . '</td>';
                        echo '<td>' . $row['nom_departement'] . '</td>';
                        echo '<td>' . $row['description'] . '</td>';
                        $id=$row['id_departement'];
                        $nom=$row['nom_departement'];
                        $prenom=$row['description'];
                        echo '<td style="text-align:center">'
                        ?>
                              <button class="btn btn-link" style="alignment: center"    data-toggle="modal" data-target="#myModal" onclick="edit('<?php echo $row['id_departement']?>','<?php echo $row['nom_departement']?>')"  ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                           </tr>

                    <?php } ?>
                </table>
            </div>
            <script>
                function edit(data1,data2) {
                    $('input#id').val(data1);
                    $('input#nom').val(data2);
                    //$('input#description').val(data3);
                }
            </script>
  <script>
                function sortTable(n) {
                    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                    table = document.getElementById("myTable");
                    switching = true;

                    dir = "asc";
                    while (switching) {
                        switching = false;
                        rows = table.getElementsByTagName("TR");
                        for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("TD")[n];
                            y = rows[i + 1].getElementsByTagName("TD")[n];
                            if (dir == "asc") {
                                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                    shouldSwitch= true;
                                    break;
                                }
                            } else if (dir == "desc") {
                                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                    shouldSwitch= true;
                                    break;
                                }
                            }
                        }
                        if (shouldSwitch) {
                            /*If a switch has been marked, make the switch
                            and mark that a switch has been done:*/
                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                            //Each time a switch is done, increase this count by 1:
                            switchcount ++;
                        } else {
                            /*If no switching has been done AND the direction is "asc",
                            set the direction to "desc" and run the while loop again.*/
                            if (switchcount == 0 && dir == "asc") {
                                dir = "desc";
                                switching = true;
                            }
                        }
                    }
                }
            </script>
            <!----------------   Display Department Data List ends   --------------->
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog" >
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="panel panel-default">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"></button>
                                <h4 class="modal-title" style="text-align:center">  modifier les informations du département </h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="#" method="post">

                                    <div class="form-group">
                                        <label  class="col-sm-4 control-label">Department ID</label>
                                        <div class="col-sm-6">
                                                <input readonly type="text" class="form-control" name="UpdateId" id="id">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-4 control-label">Nom Département</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="UpdateName" placeholder="Enter Nom de Département"  id="nom"   >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Description de Département</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="UpdateDescription" placeholder="Enter Description de Département ..." id="description"  >
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-6 col-sm-10">
                                            <button type="submit" class="btn btn-primary" type="submit"> Update </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <!----------------   Panel Body Ends   --------------->
    </div>
    <!-----------  Content Menu Tab Ends   ------------>

    
</div>
<!-------   Content Area Ends  --------->
<script src="js/bootstrap.min.js"></script>
</body>
</html>