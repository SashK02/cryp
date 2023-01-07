
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
    $amount = $obj->amount;
    $current_price = $obj->current_price;
    $time_of_purchase = $obj->time_of_purchase;
    $nakup = $obj->nakup;
    $id = $obj->user_id;
    
   
    $poizvedba = $povezava->prepare('INSERT INTO _investment (name, time, amount, current_price, nakup, user_id) VALUES (:name, :time_of_purchase, :amount, :current_price ,:nakup, :id)');
    
    $poizvedba->bindValue(':name', $name);
    $poizvedba->bindValue(':amount', $amount);
    $poizvedba->bindValue(':current_price', $current_price);
    $poizvedba->bindValue(':time_of_purchase', $time_of_purchase);
    $poizvedba->bindValue(':nakup', $nakup);
    $poizvedba->bindValue(":id",$id);

    
    $poizvedba->execute();
   
   
    
    echo json_encode("Dodan");
    
   


?>
