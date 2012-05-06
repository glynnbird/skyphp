#!/usr/bin/php -q
<?php

  require_once("includes/Sky.php");
  require_once("includes/SkyMongo.php");
  
  $channels = implode(",", array(Sky::BBC1_HD,Sky::BBC2,Sky::ITV1_HD,Sky::CHANNEL4_HD,Sky::CHANNEL5_HD));
//$channels = implode(",", array(Sky::CHANNEL4_HD)); 
 $listings = Sky::getListings($channels,24*60,date("Ymd0000"));
 //echo $listings;
 $listings = json_decode($listings);

  
 
 foreach($listings->channels as $c) {
   print($c->title."\n");
   foreach($c->program as $p) {
     $programmes->insert($p);
   }
 }
// print_r($listings);
 

?>
