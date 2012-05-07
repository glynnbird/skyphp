<html>
  <head>
    <style type="text/css">
      body {
          font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
          margin:0;
          padding:0;
      }
      .programme {
        width: 200px;
        overflow: hidden;
        border-right:1px solid #666;
        font-size:10px;
        padding:3p;
      }
      .programme_title {
        background-color:black;
        color:white;
        font-weight:bold;
        font-size:12px;
        padding:3px;
      }
      .programme_body {
        padding:3px;
      }
      .channel {
        width:200px;
        float:left;
      }
      .trunc_programme {
        width: 200px;
        border-right:1px solid #666;
      }
      .channel_header {
        background-color: #723;
        color:white;
        font-size:16px;
        width:200px;
        float:left;
      }
      .time_header {
        width:50px;
        float:left;
      }
      .scrollable {
        clear:both;
        height:100%;
        overflow:scroll;
        width:100%;
      }
      .hour_marker {
        background-color: #723;
        color:white;
        font-size:16px;
        width:50px;
        border-top:1px solid white;
      }
      .hour_label {
        /* Safari */
        -webkit-transform: rotate(-90deg);
        /* Firefox */
        -moz-transform: rotate(-90deg);
        /* IE */
        -ms-transform: rotate(-90deg);
        /* Opera */
        -o-transform: rotate(-90deg);
        /* Internet Explorer */
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        position:relative;
        top:50px;
      }
      .hour_list {
        width:50px;
        float:left;
      }
    </style>
  </head>
  <body>
