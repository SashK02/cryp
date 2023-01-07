



<?php 
    

    $host = "dsr.feri.um.si";
    $uporabniskoIme = "dsr_2022_saso_krepek";
    $geslo = "1002519055";
    $imePodatkovneBaze = "dsr_2022_saso_krepek";

    $povezava = new PDO('mysql:host='.$host.';dbname='.$imePodatkovneBaze.';charset=utf8mb4', $uporabniskoIme, $geslo);
    
    $json_string = file_get_contents('php://input');
    $obj = json_decode($json_string);


    $email = $obj->email;
    $pass = $obj->password;
   
    $poizvedba = $povezava->prepare('SELECT id,email,password FROM  _user WHERE email = :email');
    
    $poizvedba->bindValue(':email', "$email");
    #$poizvedba->bindValue(':pass', "$hash");
    
    $poizvedba->execute();
   
    $rezultat = $poizvedba->fetchAll(\PDO::FETCH_OBJ);
    
    if (password_verify($pass, $rezultat[0]->password)) {
         $rezultat[0]->val = "1";
         unset($rezultat[0]->password);
         unset($rezultat[0]->email);
         echo json_encode($rezultat[0]);
         
    } else {
         $rezultat[0]->val = "0";
         unset($rezultat[0]->password);
         unset($rezultat[0]->email);
         unset($rezultat[0]->id);
         echo json_encode($rezultat[0]);
       
    }
    
    
   


?>
