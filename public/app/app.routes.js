angular.module('app.routes',['ui.router'])
	.config(function($stateProvider, $urlRouterProvider, $locationProvider){
		$urlRouterProvider.otherwise('/');
		$stateProvider
		.state('home',{
			url :'/',
			views:{
				'banner':{
					templateUrl:'app/views/pages/banner.html'
				},
				'intro':{
					templateUrl:'app/views/pages/intro.html'
				},
				'designs':{
					templateUrl:'app/views/pages/designs.html'
				},
				'services':{
					templateUrl:'app/views/pages/services.html'
				},
				'aboutus':{
					templateUrl:'app/views/pages/aboutus.html'
				},
				'videos':{
					templateUrl:'app/views/pages/videos.html'
				},
				'gallery':{
					templateUrl:'app/views/pages/gallery.html'
				}
			}
			
		})
		.state("login1",{
			url:'/login1',
			views:{
				'login':{
					templateUrl:"app/views/pages/login.html"
				}
			}
			
		})
		$locationProvider.html5Mode(true);
	});