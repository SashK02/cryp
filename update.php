



<?php 
    

    $host = "dsr.feri.um.si";
    $uporabniskoIme = "dsr_2022_saso_krepek";
    $geslo = "1002519055";
    $imePodatkovneBaze = "dsr_2022_saso_krepek";

    $povezava = new PDO('mysql:host='.$host.';dbname='.$imePodatkovneBaze.';charset=utf8mb4', $uporabniskoIme, $geslo);
    
    $json_string = file_get_contents('php://input');
    $obj = json_decode($json_string);


    #$name = $obj->name;
    #$id = $obj->id;
    $name = $_POST['name'];
    $id = $_POST['id'];
   
    $poizvedba = $povezava->prepare("UPDATE _user SET ime = :name WHERE id = :id");
   
    
    $poizvedba->bindValue(':id', $id);
    $poizvedba->bindValue(':name', $name);
    #$poizvedba->bindValue(':pass', "$hash");
    
    $poizvedba->execute();
    $res->status = "200 <br>";
    $res->text = "Uspesno spremenjeno ime na";
    $res->name = $name;
    echo json_encode($res);
    
    
   


?>
