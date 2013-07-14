<div class="bb-item" id="item4">
  <div class="content">
    <div class="scroller">
        <h2><center>Hot? or Not?</center></h2>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  var geocoder;

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
}
//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng)
}
function errorFunction(){
    alert("Geocoder failed");
}
  function initialize() {
    geocoder = new google.maps.Geocoder();
  }

  function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
         alert(results[0].formatted_address)
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
                    break;
                }
            }
        }
        //city data
        var cityname = city.short_name + " " + city.long_name;
        document.write(cityname);

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }
</script>
<?php
    $yql_url = 'http://query.yahooapis.com/v1/public/yql?';
    $query = 'select * from weather.forecast where woeid in (select woeid from geo.places where text="Hyderabad")';
    $url = $yql_url . 'q=' . urlencode($query);
    $xml = simplexml_load_file($url);
    $location = $xml->results->channel->children('yweather', true)->location;
    $city = $location->attributes()->city;
    $country =  $location->attributes()->country;
    // Units
    $units = $xml->results->channel->children('yweather', true)->units;
    $distanceUnits = $units->attributes()->distance;
    $pressureUnits = $units->attributes()->pressure;
    $speedUnits = $units->attributes()->speed;
    $temperatureUnits = $units->attributes()->temperature;
    // Wind
    $wind = $xml->results->channel->children('yweather', true)->wind;
    $chill = $wind->attributes()->chill . $temperatureUnits;
    $direction = $wind->attributes()->direction;
    $speed = $wind->attributes()->speed . $speedUnits;
    // Atmosphere
    $atmosphere = $xml->results->channel->children('yweather', true)->atmosphere;
    $humidity = $atmosphere->attributes()->humidity . $pressureUnits;
    $visibility = $atmosphere->attributes()->visibility;
    $geo = $xml->results->channel->item->children('geo', true);
    $lat = $geo->lat;
    $long = $geo->long;
    // Forecast
    $forecasts = $xml->results->channel->item->children('yweather', true)->forecast;
    $forecasthtml = "<table class='pure-table pure-table-horizontal'>";
    $forecasthtml .= "<tr><th>Date</th><th>Day</th><th>Low</th><th>High</th><th>Text</th></tr>";
    foreach($forecasts as $forecast){
        $date = $forecast->attributes()->date;
        $day = $forecast->attributes()->day;
        $high = $forecast->attributes()->high;
        $low = $forecast->attributes()->low;
        $text = $forecast->attributes()->text;
        $forecasthtml .= "<tr><th>".$date."</th><td>".$day."</td><td>".$low."</td><td>".$high."</td><td>".$text."</td></tr>";

    }
    $forecasthtml .= "</table>";
    echo $forecasthtml;
    echo "Location: </br>";
    echo "City: " . $city . "</br>";
    echo "Country: " . $country . "</br>";

    echo "Wind: </br>";
    echo "Chill: " . $chill . "<br/>";
    echo "Direction: " . $direction . "<br/>";
    echo "Speed: " . $speed . "<br/>";

    echo "Atmosphere: <br/>";
    echo "Humidity: " . $humidity . "<br/>";
    echo "Visibility: " . $visibility . "<br/>";
    echo "Humidity: " . $humidity . "<br/>";
    echo "Visibility: " . $visibility . "<br/>";

    echo "Geo: <br/>";
    echo "Lat: " . $lat . "<br/>";
    echo "Long: " . $long . "<br/>";
?>
    </div>
  </div>
</div>