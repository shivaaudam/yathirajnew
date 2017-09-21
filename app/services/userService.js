angular.module('userService',[])
.service('User',function($http, $rootScope, $location){
	this.getUser = function(){
		return $http.get('app/php/getUser.php').
		then(function(data){
			return data.data.userData;
		});
	}
});
