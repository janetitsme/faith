//Janet DSouza, 14059185, 31/03/2017
//Javascript GoogleMaps Manager

window.addEventListener("load",initialise);//in initialise ultimately we create a new map object using the API
//we need to initialise map settings.The map constructor when we call it will return 2 piece of info as arguments
//html element and mapOptions object-which hold initial map properties including center point and zoom level
//a)geographical location theat the map is centered  b)how far in or out it will be zoomed at that location

function initialise()
{
	//creates an instance of latLng object, gives it specific coordinates and assigns it to a variable that is called latLon
	var latLong=new google.maps.LatLng(53.5337981,-2.1369252)
	var mapOptions=
	{
		center:latLong,	//center is holding the value of latLong variable
		zoom:16		//zoom levels go from 0(earth visible) to 21(buildings visible)
	};
	var mapContainer=document.getElementById("mapArea"); //mapContainer holds the map
	var map=new google.maps.Map(mapContainer,mapOptions);	//calling the google.maps.Map constructor to create Map
	
	var marker=new google.maps.Marker(			//create a new marker
	{
			position:latLong,
			animation:google.maps.Animation.DROP			//adding animation-drop the marker into its location
	});
	marker.setMap(map);		//method setMap takes map variable as argument and place the marker
	google.maps.event.addListener(marker,'click',zoomIn)
	function zoomIn()
	{
		map.setZoom(19);		//set zoom level to 19
		map.setCenter(marker.getPosition());	//recenter the map around the marker location when the user zoom in
		infoWindow.open(map,marker);										//market position helps when there are multiple markers
		map.setMapTypeId("hybrid");				//change map type to hybrid view or you can set satellite view
	};
	
	var infoWindow=new google.maps.InfoWindow(	//create a info window
		{
			content: "@Faith Hair & Beauty an unique <br>salon expeience!<br><img src='images/logo.jpg'><br><a href='http://www.thefaithhairandbeauty.co.uk/'>Visit the Salon!</a>"
			
		});
		
}