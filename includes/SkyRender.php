<?php

  class SkyRender {
    
    // the height of a programme div if it is one hour long
    const HEIGHT_FOR_ONE_HOUR=200;
    
    public static function renderProgramme($p) {
      
      $ratings_icons= array("U" => "/images/u.png",
                            "PG" => "/images/pg.png",
                            "12" => "/images/12.png",
                            "12a" => "/images/12a.png",
                            "15" => "/images/15.png",
                            "18" => "/images/18.png");
        /* e.g.
      Array
      (
          [_id] => MongoId Object
              (
                  [$id] => 4fa77b75ed8899ee030001de
              )

          [eventid] => 54979
          [channelid] => 2076
          [date] => 07/05/12
          [start] => 1336411800000
          [dur] => 3600
          [title] => Who Do You Think You Are?
          [shortDesc] => 1/10. June Brown: Celebrity genealogy series. National treasure June Brown unravels her Jewish heritage, and discovers how momentous historical events shaped her family's destiny. [HD] [AD,S]
          [genre] => 5
          [subgenre] => 6
          [edschoice] => false
          [parentalrating] => Array
              (
                  [k] => 0
                  [v] => --
              )

          [widescreen] => 
          [sound] => Array
              (
                  [k] => 3
                  [v] => Digital surround sound
              )

          [remoteRecordable] => true
          [record] => 1
          [scheduleStatus] => NOT_STARTED
          [blackout] => false
          [movielocator] => null
      )
    */
      $rating = $p['parentalrating']['v'];
      $rating_icon = "";
      if(array_key_exists($rating,$ratings_icons)) {
        $rating_icon = sprintf("<img class=\"rating\" src=\"%s\" alt=\"%s\" />\n",
                          $ratings_icons[$rating],
                          $rating);
      }
      $html = sprintf("  <div class=\"programme\" style=\"height:%dpx\" onclick=\"showPopup(%d)\">\n".
                      "    <div class=\"programme_title\">%s</div>\n".
                      "    <div class=\"programme_body\">%s</div>\n".
                      "     %s".
                      "  </div>\n",
                      SkyRender::HEIGHT_FOR_ONE_HOUR*$p['dur']/3600,
                      $p['eventid'],
                      $p['title'],
                      $p['shortDesc'],
                      $rating_icon);
      return $html;
    
    }
    
  }

?>