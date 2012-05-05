#!/usr/bin/php -q
<?php

  require_once("../skyphp.php");
  
  $channels = implode(",", array(SkyPHP::BBC1_HD,SkyPHP::BBC2,SkyPHP::ITV1_HD,SkyPHP::CHANNEL4_HD));
  echo SkyPHP::getListings($channels);

?>
