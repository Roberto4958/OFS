<?php
session_start();
//error_reporting(0); // stops displaying warning from user end

    require_once '../../Scripts/loginInfo.php';
    require_once '../../Scripts/helperScripts.php';
    
    if(!SessionIsValid()){
        header('Location: ../../signin.php');
    }
    if(!isset($_POST['orderSubmitted'])){ //did user come from check out form
        header('Location: ../');
    }

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Google Maps</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyCHdx-m6xOsxi9Un8XTSvjAZjUzl1qLX6Q" type="text/javascript"></script>
    <script type="text/javascript" src="../../vendor/sweetalert/sweetalert.min.js"></script>
    <script src="epoly.js" type="text/javascript"></script>
</head>

    <body onunload="GUnload()">
        <div align="center">
            <div id="map" style="width: 90%; height: 400px"></div>
                <h1 id="timer"></h1>
                <span class="style1">
    </span></div>

  </body>
</html>
<script type="text/javascript">
    if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GMapTypeControl());
        map.setCenter(new GLatLng(0,0),2);
        var dirn = new GDirections();
        var step = 10; // metres
        var tick = 50; // milliseconds
        var poly;
        var eol;
        var car = new GIcon();
            car.image="caricon.png"
            car.iconSize=new GSize(32,18);
            car.iconAnchor=new GPoint(16,9);
        var marker;
        var k=0;


        function animate(d) {
            
            //Drone Arrived 
            if (d>eol) { 
                swal("Success", "Your Order Has Arrived", "success");
                return;
            }

            var p = poly.GetPointAtDistance(d);
            map.panTo(p);
            marker.setPoint(p);
            setTimeout("animate("+(d+step)+")", tick);
            
            
        }



    GEvent.addListener(dirn,"load", function() {
        poly=dirn.getPolyline();
        eol=poly.Distance();
        map.setCenter(poly.getVertex(0),17);
        map.addOverlay(new GMarker(poly.getVertex(0),G_START_ICON));
        map.addOverlay(new GMarker(poly.getVertex(poly.getVertexCount()-1),G_END_ICON));
        marker = new GMarker(poly.getVertex(0),{icon:car});
        map.addOverlay(marker);
        
        
        //timer logic
        reloadTime = 1000/tick 
        stepdist = dirn.getRoute(0).getDistance().meters;
        steptime = dirn.getRoute(0).getDuration().seconds;
//        stepspeed = ((stepdist/steptime) * 2.24).toFixed(0);
//        step = stepspeed/2.5;
//        step = stepdist/ steptime;
//        startTime(((eol/step)/reloadTime)+2);
        step = (eol/steptime)/ reloadTime;
        startTime((steptime)+2);
        
        setTimeout("animate(0)",2000);  // Allow time for the initial map display          
      });

        
    GEvent.addListener(dirn,"error", function() {
        swal({ title: "Error", text: "Location(s) not recognised. Code: "+dirn.getStatus().code, icon: "error"});
      });
        

    function start() {
        UserAddress = getCookie('userAddress');
        countyAddress = getCookie('countyAddress');
        
        startpoint = countyAddress //"37.336123, -121.895933";
        endpoint = UserAddress;
        
        dirn.loadFromWaypoints([startpoint,endpoint],{getPolyline:true,getSteps:true});
      }
        start()
    }
        
    //Displaying how many seconds are left
    function startTime(timeleft){ 
        timeleft = Math.ceil(timeleft)
        var downloadTimer = setInterval(function(){
            timeleft--;
            
            hours = Math.floor((timeleft/3600) % 60);
            minutes = Math.floor((timeleft/60) % 60);
            seconds = Math.floor(timeleft % 60);
            
            document.getElementById("timer").textContent = "ETA: " + hours + "h "
            + minutes + "m " + seconds + "s";
            if(timeleft <= 0)
                clearInterval(downloadTimer);
        },1000);
    }
    
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    </script>