angular.module('registerCtrl',[])
.controller("registerController",function($http, $scope){
	var registration = this;
	registration.success="";
	registration.error="";
	registration.doRegister = function(){
		$http.post('app/php/register.php',registration.registerData)
		.success(function(data){
			if(!data.error){
				registration.success = data.msg;
				registration.error = data.error;
			}
			else{
				registration.success = data.msg;
				registration.error = data.error;
			}
		})
	}
});