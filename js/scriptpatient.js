
document.getElementById('button1').onclick = function () {
    document.getElementById('listePatient').style.display="block";
	document.getElementById('historiquePatient').style.display="none";
    document.getElementById('FormPatient').style.display="none";
}

document.getElementById('button2').onclick = function () {
    document.getElementById('listePatient').style.display="none";
	document.getElementById('historiquePatient').style.display="block";
    document.getElementById('FormPatient').style.display="none";
}

document.getElementById('button3').onclick = function () {
    document.getElementById('listePatient').style.display="none";
    document.getElementById('historiquePatient').style.display="none";
    document.getElementById('FormPatient').style.display="block";
}

function myFunction() {
    document.getElementById("myForm").submit();
    }
