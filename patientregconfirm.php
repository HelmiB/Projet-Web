<title>
    L'affectation du patient s'est déroulé avec succès
</title>
<?php
require './ajoutPatient.php';
    $pid=$_POST["id"];
    $sname=$_POST["nom"];
    $oname=$_POST["sexe"];
    $gend=$_POST["cbxGender"];
    $pass = $fcontent;
    copy($raw, "pass.jpg");
    if (regPatient($pid, $sname, $oname, $gend, $pass) == 1){
        echo "L'affectation du patient s'est déroulé avec succès";
    }else {
        echo "Erreur lors de l'affectation du patient ";
        die();
         }   
    
?>


<body>
    <h3>Détails du Patient</h3>
   
    
    Patient ID: <?php echo $pid; ?><br/>
    Surname: <?php echo $sname; ?><br/>
    Other Names: <?php echo $oname; ?><br/>
    Gender: <?php echo $gend; ?><br/><br/>
    <p><a href="patient.php" style="text-decoration:none">Home</a>
</body>
