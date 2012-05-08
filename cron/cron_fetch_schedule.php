#!/usr/bin/php -q
<?php

  require_once("includes/Sky.php");
  require_once("includes/SkyMongo.php");
  
  // get the list of channels 
  $channelList = json_decode(Sky::getChannelList());
  
  foreach($channelList->channels as $c) {
    $channels->insert($c);
  }
  
  // remove all programmes
  $programmes->remove(array());
  
  // get the programme listings for a few channels
  $channels = implode(",", array(Sky::BBC1_HD,Sky::BBC2,Sky::ITV1_HD,Sky::CHANNEL4_HD,Sky::CHANNEL5_HD,Sky::FILM4));
  
  // calculate today at midnight
  $start_ts = strtotime(date("Y-m-d 00:00:00"));
  
  for($i=0;$i<7;$i++) {
    
    // calculate date
    $ts = strtotime(sprintf("+%d day",$i),$start_ts);
    $day = date("Ymd0000",$ts);
    printf("Day = %s\n",$day);
    $listings = Sky::getListings($channels,24*60,$day);
    $listings = json_decode($listings);

    // save each listing to Mongo
    foreach($listings->channels as $c) {
     print($c->title."\n");
     foreach($c->program as $p) {
       $programmes->insert($p);
     }
    }
  }

// print_r($listings);
 

?>
