<?php
$navn = $email = $henvendelse = $besked = "";

function test_input($formdata) {
  $formdata = trim($formdata);
  $formdata = stripslashes($formdata);
  $formdata = htmlspecialchars($formdata);
  return $formdata;
}

$inputerror = "";

    if (empty($_POST["navn"])) {
        $inputerror .= "Udfyld venligst navn";
      } else {
        $navn = test_input($_POST["navn"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$navn)) {
          $inputerror .= "Kun bogstaver og mellemrum i navnet, tak!"; 
        }
      }
    
    if (empty($_POST["email"])) {
        $inputerror .= "Udfyld venligst e-mail";
      } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $inputerror .= "Indtast venligst korrekt e-mail format"; 
        }
      }
    
    if (empty($_POST["henvendelse"])) {
        $inputerror .= "Årsag for henvendelse skal udfyldes";
      } else {
            $henvendelse = test_input($_POST["henvendelse"]);
      }

    if (empty($_POST["besked"])) {
        $inputerror .= "Indtast venligst lidt i tekstfeltet om hvorfor du vil i kontakt med os.";
      } else {
        $besked = test_input($_POST["besked"]);
      }


$modtager = "hej@lassekhauerberg.dk";
$subject = "Besked fra " . $navn . " om " . $henvendelse . " ";
$headers = "From: " . $email . " ";

if($inputerror == ""){
    if($success = mail($modtager, $subject, $besked, $headers)){
        echo "success";
    } else{
        echo "Noget gik galt!";
    } 
} else{
    echo $inputerror;
}
    
?>
