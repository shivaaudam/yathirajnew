angular.module('compareToDirective',[])
.directive("compareTo",function(){
	return {
      require: "ngModel",
      link: function (scope, elem, attrs, ctrl) {
      	console.log(attrs);
        var firstPassword = '#' + attrs.compareTo;
        console.log($(firstPassword));
        elem.add(firstPassword).on('keyup', function () {
          scope.$apply(function () {
            var v = elem.val()===$(firstPassword).val();
            ctrl.$setValidity('compareTo', v);
          });
        });
      }
    };
})