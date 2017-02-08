<head>
    <link href="css/materialize.css" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/font.css" rel="stylesheet">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js"></script>


<?php

if (isset($_POST['km']) && isset($_POST['date']) && isset($_POST['infos'])) {

    //Si le formulaire a été envoyé
    enregistrer($_POST['km'], $_POST['date'], $_POST['infos']);

}
elseif(isset($_POST['edit'])){

    //En cas de mofication d'entrée
    $info=$_POST['edit_info'];
    $km = " value= '".$_POST['edit_km']."' placeholder= '".$_POST['edit_km']."' ";
    $date = " value= '".$_POST['edit_date']."' placeholder= '".$_POST['edit_date']."' ";

    //Suppression ancien fichier
    $data_doc_name = "data/".$_POST['edit_date'].$_POST['edit_km'].".xml";
    unlink($data_doc_name);
    print_form($info, $km, $date);
}
else {
    //Afficher le formulaire si il n'a pas déjà été traité
    $info="";
    $km = "";
    $date = "";
    print_form();
}

function print_form($info="", $km="", $date="")
{
    echo '
    <div class="row">
    <form method="post" action ="' . $_SERVER["PHP_SELF"] . '" class="col s12 m6 offset-m3 ">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">directions_car</i>
                <input '.$km.'name="km" id="number" type="text" class="validate" value>
                <label for="icon_prefix">Kilométrage</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">event</i>
                <input '.$date.'name="date"type="date" class="validate">
            </div>
            <div class="input-field col s12">
                <textarea name="infos" id="textarea" class="materialize-textarea">'.$info.'</textarea>
                <label for="textarea">Informations</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>

    </form>
</div>';
}


function enregistrer($km, $date, $infos) {

    $data_doc_name = "data/".$date.$km.".xml";

    $xml_start = "<?xml version='1.0' standalone='yes'?><events>";
    $xml_content = "\n <event><info>$infos</info><km>$km</km><date>$date</date></event>";
    $xml_end = "</events>";

    $xml_full = $xml_start;
    $xml_full .= $xml_content;
    $xml_full .= $xml_end;

    file_put_contents($data_doc_name, $xml_full);

    header('Location: index.php');
}
?>



<script>
    $('#number').on("keyup", function() {
        this.value = this.value.replace(/ /g,"");
        this.value = this.value.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    });
</script>
<?php include('include/footer.php'); ?>
</body>


