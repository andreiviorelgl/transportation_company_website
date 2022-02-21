<?php
session_start();
require_once 'classes/Token.php';
include_once 'db.php';



if(hash_equals($_SESSION['token'], $_POST['token'])){
  $Localitate_ridicare=$_POST['loc1'];
  $Judet_ridicare=$_POST['jud1'];;
  $Data_ridicare=$_POST['date1'];
  $Localitate_predare=$_POST['loc2'];
  $Judet_predare=$_POST['jud2'];
  $Data_predare=$_POST['date2'];
  $Greutate=$_POST['weight'];
  $Volum=$_POST['volume'];
  $Descriere=$_POST['about'];
  $Tip_client=$_POST['client_type'];
  $Nume_client=$_POST['client_name'];
  $Telefon=$_POST['phone'];
  $clientEmail=$_POST['clientEmail'];
  
 $host="localhost";
  $dbusername="u119597659_13579";
  $dbpassword="3Nokia310!";
  $dbname="u119597659_cereri_oferta";

	$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	
	}
	else{
echo "Connected sucessfully";



	$sql="INSERT INTO cereri(Localitate_ridicare, Judet_ridicare, Data_ridicare, Localitate_predare, Judet_predare,  Data_predare, Greutate, Volum, Descriere, Tip_client, Nume_client , Telefon, Email) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$stmt=$conn->prepare($sql);
	$stmt-> bind_param("ssssssiisssis", $Localitate_ridicare, $Judet_ridicare, $Data_ridicare , $Localitate_predare, $Judet_predare,  $Data_predare, $Greutate, $Volum, $Descriere, $Tip_client, $Nume_client, $Telefon, $clientEmail);
	$stmt -> execute();
 
		$last_id = $conn->insert_id;
		$_SESSION['last_id']=$last_id;
		$_SESSION['last_id']+=1;

		$to='office@uvatime.com'; // Receiver Email ID, Replace with your email ID
		$subject='Cerere Oferta 2020'.$last_id;
		$message="Localitate ridicare :".$Localitate_ridicare."\n"."Judet ridicare :".$Judet_ridicare."\n"."Data ridicare :".$Data_ridicare."\n"."Localitate predare :".$Localitate_predare."\n"."Judet predare :".$Judet_predare."\n"."Data predare :".$Data_predare."\n"."Greutate :".$Greutate."\n"."Volum :".$Volum."\n"."Descriere :".$Descriere."\n"."Client :".$Tip_client."\n".$Nume_client."\n".$Telefon."\n".$clientEmail."\n";
        $emai="UVA GLOBAL Transport Services";
		$headers="From: ".$emai;
		
		if(mail($to, $subject, $message, $headers)){
			echo "<h1>Sent Successfully! Thank you"." ".$Nume_client.", We will contact you shortly!</h1>";
			

		}
		else{
			
		
			echo "Something went wrong!";
		}
		$to=$clientEmail; // Receiver Email ID, Replace with your email ID
		$subject='Oferta servicii de transport pentru '.$Nume_client." Nr. inregistrare: 2020".$last_id;
		$message="Localitate ridicare :".$Localitate_ridicare."\n"."Judet ridicare :".$Judet_ridicare."\n"."Data ridicare :".$Data_ridicare."\n"."Localitate predare :".$Localitate_predare."\n"."Judet predare :".$Judet_predare."\n"."Data predare :".$Data_predare."\n"."Greutate :".$Greutate."\n"."Volum :".$Volum."\n"."Descriere :".$Descriere."\n"."Client :".$Tip_client."\n".$Nume_client."\n".$Telefon."\n".$clientEmail."\n";
        $ema="automated-noreply";
		$headers="From: automated-noreply@uvatime.com";
		
		if(mail($to, $subject, $message, $headers)){
			echo "<h1>Sent Successfully! Thank you"." ".$Nume_client.", We will contact you shortly!</h1>";
			
		
		}
		else{
			
	
			echo "Something went wrong!";
		}
		
	
		$stmt -> close();
		$conn -> close();
	}
	
}
?>
