



<?php 
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $host = "dsr.feri.um.si";
    $uporabniskoIme = "dsr_2022_saso_krepek";
    $geslo = "1002519055";
    $imePodatkovneBaze = "dsr_2022_saso_krepek";

    $povezava = new PDO('mysql:host='.$host.';dbname='.$imePodatkovneBaze.';charset=utf8mb4', $uporabniskoIme, $geslo);
    
    $json_string = file_get_contents('php://input');
    $obj = json_decode($json_string);

    $name = $obj->name;
    $email = $obj->email;
    $pass = $obj->password;
   
    $hash = password_hash($pass, PASSWORD_DEFAULT);
   

    $poizvedba = $povezava->prepare('INSERT INTO _user (ime,email,password) VALUES (:name, :email, :pass);');
    
    $poizvedba->bindValue(':name', $name);
    $poizvedba->bindValue(':email', $email);
    $poizvedba->bindValue(':pass', $hash);
    
    $poizvedba->execute();
    $obj->password = $hash;
    echo json_encode($obj);
   


?>
