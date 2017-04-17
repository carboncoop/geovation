$(window).load(createMap);
var map;

function createMap(){
	map = new Map(buildingGeoData);
}


var Map = function(data){

	// settings
	this.strokeColor = "rgb(241,101,79)";
	this.fillColor = "transparent";
	this.fillColorSelected = "rgb(106,41,74)";

	this.init();

	for (var i = 0 ; i < data.length ; i++){
		this.createPolygon(data[i]);
	}

}

// Outputs an object with properties lat, lng, given an easting and northing
Map.prototype.getLatLng = function(easting, northing){
	var grid = new OsGridRef(easting, northing);
	var p = OsGridRef.osGridToLatLon(grid, LatLon.datum.WGS84);
	return {
		lat: p.lat,
		lng: p.lon
	}
}

Map.prototype.addPolygonToMap = function(id, polygonData){
	var _this = this;
	var buildingOutline = new google.maps.Polygon({
		id: id,
		paths: polygonData,
		strokeColor: this.strokeColor,
		strokeOpacity: 1,
		strokeWeight: 2,
		fillColor: this.fillColor,
		fillOpacity: 0.5
	});

	buildingOutline.setMap(this.map);
	this.polygons[id] = buildingOutline


	// This event listener listens for clicks on the polygons themselves
	google.maps.event.addListener(buildingOutline, 'click', function (event) {
		for (var polygon in map.polygons){
			map.polygons[polygon].setOptions({fillColor: map.fillColor});
		}
		_this.selectedPolygon = buildingOutline;
		_this.selectedPolygon.setOptions({fillColor: _this.fillColorSelected});
		$(".js-postcode-selector").val(buildingOutline.id);
		$(".js-proceed-to-form-given-address").attr("href", "/os-addresses/" + buildingOutline.id).addClass("proceed-to-form-given-address--visible");
		$('.js-postcode-selector').trigger("chosen:updated");
    });

	// This event listener listens for changes to the dropdown list
    $(".js-postcode-selector").change(function(e){
    	var selected = $(this).val();
    	// first reset all polygons to default color
    	for (var polygon in map.polygons){
    		_this.polygons[polygon].setOptions({fillColor: _this.fillColor});
    	}

    	// then highlight chosen one
    	_this.polygons[selected].setOptions({fillColor: _this.fillColorSelected});
    	$(".js-proceed-to-form-given-address").attr("href", "/os-addresses/" + _this.polygons[selected].id).addClass("proceed-to-form-given-address--visible");
    })
}

// Raw polygon data is a string of easting/northing pairs
Map.prototype.createPolygon = function(rawPolygonData){

	var polygonPoints = rawPolygonData.coordinates.split(",");
	var massagedPolygonData = [];
	for (var i = 0 ; i < polygonPoints.length ; i++){
		massagedPolygonData[i] = polygonPoints[i].split(" ");
		var p = this.getLatLng(massagedPolygonData[i][0], massagedPolygonData[i][1]);
		massagedPolygonData[i] = {lat:p.lat,lng:p.lng}
	}

	this.map.setCenter(massagedPolygonData[0]);
	this.addPolygonToMap(rawPolygonData.id, massagedPolygonData);
		
}

Map.prototype.init = function(){
	this.polygons = {};
	this.map = new google.maps.Map(document.getElementById('js-building-map'), {
		zoom: 19,
		mapTypeId: google.maps.MapTypeId.SATELLITE
	});
}

