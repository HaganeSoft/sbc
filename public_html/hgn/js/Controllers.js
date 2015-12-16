function DialogController($scope, $mdDialog) {
  $scope.hide = function() {
    $mdDialog.hide();
  };
  $scope.cancel = function() {
    $mdDialog.cancel();
  };
  $scope.answer = function(answer) {
    $mdDialog.hide(answer);
  };
}

app.controller('MainController', function ($scope, $timeout, $mdSidenav, $log, $location, Upload) {
	$scope.toggleLeft = buildDelayedToggler('left');
	$scope.toggleRight = buildToggler('right');

	$scope.isOpenRight = function(){
		return $mdSidenav('right').isOpen();
	};

	$scope.go = function ( path ) {
		$location.path( path );
	};

	$scope.loading = null;
	$scope.toolbar_title = 'Administrador';

	/**
	* Checks the current path and assigns an 'active' class to the
	* element if it matches the argument
	*/
	$scope.isActive = function (path) {
		pathArray = path.split('/');
		actualPathArray = window.location.pathname.split('/');
		for (var i = pathArray.length-1; i >= 0; i--) {
			if(pathArray[i] === "") break;
			if(pathArray[i] != actualPathArray[actualPathArray.length - 1 - (pathArray.length - 1 - i)]) return false;
		};
		return true;
	};

	/**
	* Supplies a function that will continue to operate until the
	* time is up.
	*/
	function debounce(func, wait, context) {
		var timer;
		return function debounced() {
			var context = $scope,
			args = Array.prototype.slice.call(arguments);
			$timeout.cancel(timer);
			timer = $timeout(function() {
				timer = undefined;
				func.apply(context, args);
			}, wait || 10);
		};
	}
	/**
	* Build handler to open/close a SideNav; when animation finishes
	* report completion in console
	*/
	function buildDelayedToggler(navID) {
		return debounce(function() {
			$mdSidenav(navID)
			.toggle()
			.then(function () {
				$log.debug("toggle " + navID + " is done");
			});
		}, 200);
	}
	function buildToggler(navID) {
		return function() {
			$mdSidenav(navID)
			.toggle()
			.then(function () {
				$log.debug("toggle " + navID + " is done");
			});
		}
	}
////////////////////////////////////////////////////////////////////
	$scope.forma = {};
	$scope.upload = function () {
		Upload.upload({
			url: 'Index/uploadForm',
			method: 'POST',
            fields: $scope.forma,
			file: $scope.forma.file
		})
		.then(function (response) {
			if (response.data.success) {
				$scope.color = '#00ff00';
				$scope.font = '#000';
				$scope.message = response.data.message;
			} else {
				$scope.color = '#ff0000';
				$scope.font = '#fff';
				if (response.data.message) {
					$scope.message = response.data.message;
				} else {
					$scope.message = 'Error al guardar, favor de contactarse directamente.';
				}
			}
		});
	}

})

.controller('LeftCtrl', ['$location', function ($scope, $timeout, $mdSidenav, $log, $location) {
	$scope.location = $location;
	$scope.close = function () {
		$mdSidenav('left').close()
		.then(function () {
			$log.debug("close LEFT is done");
		});
	};
}])

.controller('RightCtrl', function ($scope, $timeout, $mdSidenav, $log) {
	$scope.close = function () {
		$mdSidenav('right').close()
		.then(function () {
			$log.debug("close RIGHT is done");
		});
	};
})
.controller('AdminController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast) {
	$scope.$parent.loading = 'indeterminate';
	$scope.usuariosAdmin = [];

	$http.post('Admin/ajaxGetUsuarioAdmin', {})
	.then(function(response) {
		$scope.usuariosAdmin = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

});

