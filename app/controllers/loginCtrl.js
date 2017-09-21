angular.module('loginCtrl',['userService'])
.controller("loginController",function($http, $scope, $rootScope, $location, User){
	var login = this,loggedIn;
	login.errorMsg = '';
	User.getUser().then(function(data){
		if(data){
			$rootScope.loggedIn=true;
			$rootScope.userName = data.username;
			$location.path('/profile'); 
		}
		else{
			$location.path('/signin'); 
		}
	});
	login.doLogin = function(){
		$http.post('app/php/login.php',login.loginData)
		.success(function(data){
			console.log(data);
			if(!data.error && data.loggedIn){
				$rootScope.loggedIn=true;
				loggedIn=true;
				$location.path('/profile'); 
			}
			else{
				login.errorMsg=data.error;
			}
		});
	};
});