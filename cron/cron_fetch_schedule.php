#!/usr/bin/php -q
<?php

  require_once("includes/Sky.php");
  require_once("includes/SkyMongo.php");
  
  // get the list of channels 
  $channelList = json_decode(Sky::getChannelList());
  
  foreach($channelList->channels as $c) {
    $channels->insert($c);
  }
  
  // get the programme listings for a few channels
  $channels = implode(",", array(Sky::BBC1_HD,Sky::BBC2,Sky::ITV1_HD,Sky::CHANNEL4_HD,Sky::CHANNEL5_HD));
  $listings = Sky::getListings($channels,24*60,date("Ymd0000"));
  $listings = json_decode($listings);
  
  // save each listing to Mongo
  foreach($listings->channels as $c) {
   print($c->title."\n");
   foreach($c->program as $p) {
     $programmes->insert($p);
   }
  }
// print_r($listings);
 

?>
