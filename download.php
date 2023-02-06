<?php

function SortieHack()
{
  echo "<br /> tests de sécurité échoués";
  echo "<br /> FIN";
  exit();
}




//echo "Début";


// on récupère le nom du fichier demandé
$fileName = $_GET['file'];

if(empty($fileName))
{
  echo "<br /> Demande vide";
  SortieHack();
}
else
{
  //echo "<br /> Demande pas vide";
  
  // tests de sécurité
  //echo "<br /> tests de sécurité sur $fileName";
  
  if (strpos($fileName, 'passwd') !== false) {
      //echo "<br /> contient passwd";
      SortieHack();
  }
  elseif (strpos($fileName, 'etc') !== false) {
      //echo "<br /> contient etc";
      SortieHack();
  }
  elseif (strpos($fileName, '..') !== false) {
      //echo "<br /> contient ..";
      SortieHack();
  }
  elseif (strpos($fileName, '=') !== false) {
      //echo "<br /> contient =";
      SortieHack();
  }
  elseif (strpos($fileName, ';') !== false) {
      //echo "<br /> contient ;";
      SortieHack();
  }
  elseif (strpos($fileName, ',') !== false) {
      //echo "<br /> contient ,";
      SortieHack();
  }
  elseif (strpos($fileName, '"') !== false) {
      //echo "<br /> contient "";
      SortieHack();
  }
  elseif (strpos($fileName, '\'') !== false) {
      //echo "<br /> contient \'";
      SortieHack();
  }
  elseif (strpos($fileName, 'select') !== false) {
      //echo "<br /> SQL injection";
      SortieHack();
  }
  elseif (strpos($fileName, 'update') !== false) {
      //echo "<br /> SQL injection";
      SortieHack();
  }
  // dernier test
  elseif (strpos($fileName, '.pdf') == false) {
      //echo "<br /> pas un PDF";
      SortieHack();
  }
  
  
  else {
    // ici normalement tout est ok
    //echo "<br /> OK : on continue";
    
      $filePath = 'cartes/'.$fileName;
      //echo $filePath; Pour tester la mise en forme du chemin
      
      // date-heure courantes
      date_default_timezone_set('Europe/Paris');
      $now = date("Y-m-d H:i:s", time());
      $now_date = date("Y-m-d", time());
      $now_time = date("H:i:s", time());
      // --> 2018-12-17 10:04:19
      
      // on ouvre le fichier et on écrit dedans à la fin
      //  /!\ fin de ligne au format UNIX
      $myfile = fopen("stats.csv", "a");
      fwrite($myfile, $now_date . "," . $now_time . "," . $fileName . "\n");
      fclose($myfile);
      
      
      if(!empty($fileName) && file_exists($filePath)){  //Si ça existe  
          // Define headers
          header("Cache-Control: public");
          header("Content-Description: File Transfer");
          header("Content-Disposition: attachment; filename=$fileName");
          header("Content-Type: application/pdf");
          header("Content-Transfer-Encoding: binary");
          
          // Lecture du fichier 
          readfile($filePath);
          exit();
      }
    
  }
  
  //echo "<br /> FIN traitement";
}

//echo "<br /> FIN FIN";

?>