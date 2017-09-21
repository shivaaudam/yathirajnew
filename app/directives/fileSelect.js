angular.module('ngFileSelectDirective',[])
.directive("customOnChange",function(){
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      var onChangeHandler = scope.$eval(attrs.customOnChange);
      console.log(onChangeHandler);
      element.bind('change', onChangeHandler);
    }
  }
})