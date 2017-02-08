<head>
    <link href="css/materialize.css" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font.css" rel="stylesheet">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js"></script>


<?php
if (isset($_GET['d'])){
    //Suppression objet
    unlink('data/'.$_GET['d']);
    header("Refresh:0; url=..");
}
else {
    index();
}

function index()
{
    echo '  <a class="btn-floating btn-large waves-effect waves-light red" href="new.php"><i class="material-icons">add</i></a>
';

    $data_folder = scandir('data', SCANDIR_SORT_DESCENDING);
    foreach ($data_folder as $data_file) {
        if ($data_file !== "." && $data_file !== "..") {
            $xml = simplexml_load_file("data/" . $data_file);
            $xml = $xml->event;
            echo '
    <div class="row">
        <div class="col s12 m6 offset-m3">
              <div class="card grey lighten-5">

                <div class="card-content">
                  <span class="card-title activator grey-text text-darken-4"><h4>' . $xml->info . '</h4><i class="material-icons right">more_vert</i></span>
                  <div class="card-action activator dessous row ">
                  <div class="col m5 black-text"><i class="material-icons prefix">directions_car</i></br>' . $xml->km . '</div>
                  <div class="col m5 black-text"><i class="material-icons prefix">event</i></br>' . $xml->date . '</div>
                </div>
                </div>
                <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">Options<i class="material-icons right">close</i></span>
                  <div class="col m5">
                    <a href="' . $_SERVER["PHP_SELF"] . '/?d=' . $data_file . '"class="btn halfway-fab waves-effect waves-light grey"><i class="material-icons">delete</i></a>
                  </div>
                  <form method="post" action="new.php">
                  <input name="edit" value="'.$data_file.'" style="display:none">
                  <input name="edit_km" value="'.$xml->km.'" style="display:none">
                  <input name="edit_date" value="'.$xml->date.'" style="display:none">
                  <input name="edit_info" value="'.$xml->info.'" style="display:none">
                      <div class="col m5">
                          <input type="submit" class="btn halfway-fab waves-effect waves-light grey" value="Modifier">
                      </div>
                  </form>
                </div>
              </div>
         
          </div>
        </div>
      </div>
';
        }


    }
}
?>

<?php include('include/footer.php'); ?>
