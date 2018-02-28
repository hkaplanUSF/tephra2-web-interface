<?php
$sessionId = time();
//echo($sessionId . "<br>");

$configFile = $sessionId.'config.txt';
//$myFile = "testfile.txt";
$fileWrite = "";

$gridFile ="";
$windFile = "";

if (file_exists($configFile)) {
  //  echo "The file $configFile exists";
   // file_put_contents($configFile, '');
    unlink($configFile);
} else {
   // echo "The file $configFile does not exist";
    fopen($configFile, "a");
   // file_put_contents($configFile, '');
}
if(isset($_POST['fileWrite']) && !empty($_POST['fileWrite'])) {
  $phValue = $_POST['PlumeHeight'];
  $fileWrite = $_POST['fileWrite'];
  $mGainSize = $_POST['MaxGainSize'];
  $medGainSize = $_POST['MedGainSize'];
  $minGainSize = $_POST['MinGainSize'];
  $stdGainSize = $_POST['StdGainSize'];
  $ventEasting = $_POST['VentEasting'];
  $ventNorthing = $_POST['VentNorthing'];
  $ventElevation = $_POST['VentElevation'];
  $eddyConst = $_POST['EddyConst'];
  $diffCoe = $_POST['DiffCoe'];
  $fallTimeThr = $_POST['FallTimeThr'];
  $lithicDen = $_POST['LithicDen'];
  $pumiceDen = $_POST['PumiceDen'];
  $colSteps = $_POST['ColSteps'];
  $plumeModel = $_POST['PlumeModel'];
  $plumeRatio = $_POST['PlumeRatio'];



  $windFile = $_POST['WindFile'];
  $gridFile = $_POST['GridFile'];
}

if($fileWrite) {
    $fh = fopen($configFile, 'a') or die("can't open file"); //Make sure you have permission
    fwrite($fh, "PLUME_HEIGHT ");
    fwrite($fh, $phValue);
    fwrite($fh, "\r\n");
 
    fwrite($fh, "ERUPTION_MASS ");
    fwrite($fh, $fileWrite);
    fwrite($fh, "\r\n");

    fwrite($fh, "MAX_GRAINSIZE ");
    fwrite($fh, $mGainSize);
    fwrite($fh, "\r\n");

    fwrite($fh, "MEDIAN_GRAINSIZE ");
    fwrite($fh, $medGainSize);
    fwrite($fh, "\r\n");

    fwrite($fh, "MIN_GRAINSIZE ");
    fwrite($fh, $minGainSize);
    fwrite($fh, "\r\n");

    fwrite($fh, "STD_GRAINSIZE ");
    fwrite($fh, $stdGainSize);
    fwrite($fh, "\r\n");

    fwrite($fh, "VENT_EASTING ");
    fwrite($fh, $ventEasting);
    fwrite($fh, "\r\n");

    fwrite($fh, "VENT_NORTHING ");
    fwrite($fh, $ventNorthing);
    fwrite($fh, "\r\n");

    fwrite($fh, "VENT_ELEVATION ");
    fwrite($fh, $ventElevation);
    fwrite($fh, "\r\n");

    fwrite($fh, "EDDY_CONST ");
    fwrite($fh, $eddyConst);
    fwrite($fh, "\r\n");

    fwrite($fh, "DIFFUSION_COEFFICIENT ");
    fwrite($fh, $diffCoe);
    fwrite($fh, "\r\n");

    fwrite($fh, "FALL_TIME_THRESHOLD ");
    fwrite($fh, $fallTimeThr);
    fwrite($fh, "\r\n");

    fwrite($fh, "LITHIC_DENSITY ");
    fwrite($fh, $lithicDen);
    fwrite($fh, "\r\n");

    fwrite($fh, "PUMICE_DENSITY ");
    fwrite($fh, $pumiceDen);
    fwrite($fh, "\r\n");

    fwrite($fh, "COL_STEPS ");
    fwrite($fh, $colSteps);
    fwrite($fh, "\r\n");

    fwrite($fh, "PLUME_MODEL ");
    fwrite($fh, $plumeModel);
    fwrite($fh, "\r\n");

    fwrite($fh, "PLUME_RATIO ");
    fwrite($fh, $plumeRatio);

    fclose($fh);
   // exec('/your/command /dev/null 2>/dev/null &');
  }
 
  // Your file name you are uploading 
  $grid_file_name = $_FILES['GridFile']['name'];
  //$file_name = 'grip.txt'; // New unique file name
  move_uploaded_file($_FILES["GridFile"]["tmp_name"], $sessionId."_{$grid_file_name}");

  $wind_file_name = $_FILES['WindFile']['name'];
  //$file_name = 'grip.txt'; // New unique file name
  move_uploaded_file($_FILES["WindFile"]["tmp_name"], $sessionId."_{$wind_file_name}");

  $outPut = array ();
  exec ("./tephra2 ".$configFile." ".$gridFile." ".$windFile, $outPut);
  print_r ($outPut);
  //These files will stay on the server: config, grid, wind

?>