// membuat modul  angular untuk bagian geotag
var app = angular.module("geotagApp", []);

// membuat sitem control pada div geotag
app.controller("geotagCtrl", function($scope, $http, $interval){
	
	// mengambil data geotag dan mengupdatenya pada object data
	$interval(function(){
		$http.get("http://127.0.0.1//data.php").then( function($response){
			$scope.data= $response.data.records;
		});
	},1);

});

