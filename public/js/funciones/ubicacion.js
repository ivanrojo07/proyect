      var marker;
      var punto = '/images/punto.png';
      function ubicarIncidente() {
        //document.getElementById('latitud').value=lat;
        //document.getElementById('longitud').value=long;
        var coordenads= document.getElementById("coordenadas").value;
        var rescord=JSON.parse(coordenads);
        var la= document.getElementById("latitud").value;
        console.log("latitudddddd",la);
        var lo= document.getElementById("longitud").value;
        console.log("longituddddddd",lo);
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: rescord,
            mapTypeId: 'satellite'
        });
        //alert("Arrastre el icono para determinar la ubicacion del incidente");
        marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: rescord
        });
        marker.addListener('mouseup', toggleBounce);
      }


      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: {
            lat: 23.877435178885975,
            lng: -102.62050005000003
          },
          mapTypeId: 'satellite'
        });
        marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: {lat: 23.877435178885975, lng: -102.62050005000003},
          mapTypeId: 'satellite'
        });
        marker.addListener('mouseup', toggleBounce);
        ////////////////
        var input = document.getElementById('autocomplete');
      var autocomplete = new google.maps.places.Autocomplete(input,{types: ['geocode']});
      google.maps.event.addListener(autocomplete, 'place_changed', function(){
         var place = autocomplete.getPlace();
        var geocoder = new google.maps.Geocoder();
        geocodeAddress(geocoder, map);

      })
       
      }
      

      function toggleBounce() {
        	console.log("Animacion");
     	    document.getElementById('latitud').value=this.getPosition().lat();
        	document.getElementById('longitud').value=this.getPosition().lng();

        // if (marker.getAnimation() !== null) {
        //   marker.setAnimation(null);
        // } else {
        //   marker.setAnimation(google.maps.Animation.BOUNCE);
        // }

        //new google.maps.LatLng(this.getPosition().lat(), this.getPosit
      }
      function geocodeAddress(geocoder, resultsMap) {

var catIcon = {
    url: punto,
    //state your size parameters in terms of pixels
    size: new google.maps.Size(20, 20),
    scaledSize: new google.maps.Size(20, 20),
    origin: new google.maps.Point(3,3)
}

  var address = document.getElementById('autocomplete').value;
  geocoder.geocode({'address': address}, function(results, status) {

    if (status === 'OK') {
      var latitud=results[0].geometry.location.lat();
      var longitud=results[0].geometry.location.lng();

      console.log(latitud);
      console.log(longitud);
      document.getElementById("latitud").value = latitud;
      document.getElementById("longitud").value = longitud;

      resultsMap.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: resultsMap,
        title: 'animacionicono',
        position: results[0].geometry.location,
        icon: catIcon,
        optimized:false,
        draggable: true
      });
      //resultsMap.setMapTypeId('satellite');
      resultsMap.setZoom(19);

      google.maps.event.addListener(marker, 'dragend', function (evt) {
                document.getElementById("latitud").value = evt.latLng.lat().toFixed(6);
                document.getElementById("longitud").value = evt.latLng.lng().toFixed(6);

                map.panTo(evt.latLng);
      });

    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}
