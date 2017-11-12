angular.module('profileCtrl',['userService'])
.controller("profileController",function($http, $scope, $location, $rootScope, User){
	$scope.updated="";
	$scope.errorUpdate="";
	$scope.files = [];
	$scope.form = [];
	$scope.formData = {};
	$scope.rootPath = $location.absUrl().split("#")[0];
	User.getUser().then(function(data){
		if(data){
			$scope.profileData = data;
			$scope.profileData.fullName = data.firstName+ " "+data.lastName;
			$scope.firstName = data.firstName;
			$rootScope.loggedIn=true;
			$rootScope.userName = data.firstName+data.lastName;
			$location.path('/profile'); 
		}
		else{
			$location.path('/signin'); 
		}
	});
	$scope.updateProfile = function(){
		console.log($scope.profileData);
		$scope.form.image = $scope.files[0];
		var formData;
		$http({
			method  : 'POST',
			url : "app/php/profile.php",
			processData: false,
			transformRequest: function (data) {
		      formData = new FormData();
		      formData.append("postdata", JSON.stringify($scope.profileData)); 
		      formData.append("image", $scope.form.image);  
		      return formData;  
		    },  
		     data : formData,
		     dataType:'json',
		     headers: {
			         'Content-Type': undefined
			  }


		})
		.success(function(data){
			if(!data.error){
				$scope.profileData.profile_image = data.profileImage;
				$scope.updated = data.msg;
				$scope.errorUpdate = data.error;
			}
			else{
				$scope.updated = data.msg;
				$scope.errorUpdate = data.error;
			}
		})
	};
	$scope.uploadedFile = function(ele){
		$scope.currentFile = ele.files[0];
		var reader = new FileReader();
		reader.onload = function(event) {
	      $scope.image_source = event.target.result
	      $scope.$apply(function($scope) {
	        $scope.files = ele.files;
	        console.log($scope.files);
	      });
	    }
        reader.readAsDataURL(ele.files[0]);
	}
});