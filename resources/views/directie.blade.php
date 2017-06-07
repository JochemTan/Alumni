@extends('layouts.app')
@section('css')
	<style>
		#map {
        margin: 10px auto;
        width: 70%;
        height: 80%;
        border: 1px solid black;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
          overflow:hidden;
        height: 100%;
        margin: 0;
        padding: 0;
      }
	</style>
@endsection
@section('nav')
    {{-- @include('restrictions.level')
    @include('restrictions.search') --}}
    @include('layouts.nav.header2')
@endsection

@section('content')

<div id="map" style="margin-top:80px;"></div>
@endsection

@section('js')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRkCUcHyXSDWAAatXVhOR75oPYojoW-xE&callback=initMap">
</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script>

// $.get('/directie/maps', function(data){
// 	data1 = data;
// 	initMap();
// });
	function initMap() {
         var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 52.273, lng: 5.551},
          zoom: 8,
          styles: [
  {
    "featureType": "road",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  }
]
    });
        var labels = '';

        var markers =  locations.map(function(location, i){
            return new google.maps.Marker({
                position:location,
                label:labels[i% labels.length]
            });
        });
         var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
      var locations = [
       @foreach($mapDetails as $data)
		{ lat: {{ $data['lat'] }},lng: {{ $data['lng'] }} },
		@endforeach
      ]
</script>


@endsection