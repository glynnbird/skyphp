#!/usr/bin/php -q
<?php

  require_once("includes/Sky.php");
  
  $channels = implode(",", array(Sky::BBC1_HD,Sky::BBC2,Sky::ITV1_HD,Sky::CHANNEL4_HD));
  //$channels = implode(",", array(Sky::CHANNEL4_HD)); 
  echo Sky::getListings($channels);

?>
