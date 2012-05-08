<?php
  require_once("includes/Sky.php");
  require_once("includes/SkyMongo.php");
  require_once("includes/SkyRender.php");
  
  require_once("includes/header.php");
  
  // the list of channels to render
  $channelList = array(Sky::BBC1_HD,Sky::BBC2,Sky::ITV1_HD,Sky::CHANNEL4_HD,Sky::CHANNEL5_HD,Sky::FILM4);
  
  
  $day = date("d");
  $month = date("m");
  $year = date("y");
  
  // the date to render
  $date = date("d/m/y");
  $ts= mktime (0,0,0,$month,$day,$year+2000);
  
  
  // channel headers
  print("<div class=\"time_header\">&nbsp;</div>");
  foreach($channelList as $channel) {
    $chan = $channels->findOne(array( "channelid" => $channel));
    printf("<div class=\"channel_header\">%s&nbsp;</div>\n",$chan['title']);
  }
  print("<div class=\"scrollable\">\n");
  
  // hour markers
  print("<div class=\"hour_list\">\n");
  for($i=0;$i<24;$i++){
    printf("<div class=\"hour_marker\" style=\"height:%dpx\"><div class=\"hour_label\">%02d:00</div></div>",SkyRender::HEIGHT_FOR_ONE_HOUR,$i);
  }
  print("</div>\n");
  
  foreach($channelList as $channel) {
    
    // channel header
    print("<div class=\"channel\">\n");

    
    
    // fetch programmes for this channel (sort by start time)
    $cursor = $programmes->find( array( "channelid" => $channel, "date"=>$date) );
    $cursor->sort(array('start' => 1));
    
    // render as list
    $first = true;
    foreach($cursor as $c) {
      // render tail of preceding programme
      if($first) {
        $diff = ($c['start']/1000 - $ts)/3600.0;
        if($diff>0) {
          printf("<div class=\"trunc_programme\" style=\"height:%dpx\"></div>\n",SkyRender::HEIGHT_FOR_ONE_HOUR*$diff);
        }
      }
      print SkyRender::renderProgramme($c);
      $first = false;
    }
    print("</div>\n");
  }
  print("</div>\n");

    require_once("includes/footer.php");
?>