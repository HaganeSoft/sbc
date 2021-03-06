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

	//$scope.loading = null;
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
					$scope.message = 'Error al guardar, favor de llenar todos los campos. Si el error persiste, favor de ponerse en contacto.';
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
	$scope.loading = 'Cargando...';
	$scope.personas = [];
	$scope.persona = null;
	$scope.search = [];
	// $scope.search.area1 = null;

	$http.post('Admin/ajaxGetPersonas', {})
	.then(function(response) {
		$scope.personas = response.data;
	})
	.finally(function() {
		$scope.loading = null;
	});

	$scope.areas =['Áreas','Administración', 'Arquitectura', 'Construcción', 'Contabilidad', 'Compras', 'Crédito y Cobranza', 'Derecho', 'Dirección General', 'Diseño Industrial', 'Diseño Gráfico', 'Diseño Web', 'Distribución', 'Educación', 'Gastronomía', 'Gerencia General', 'Ingeniería', 'Investigación y Desarrollo', 'Logística', 'Mantenimiento', 'Medicina', 'Mercadotecnia', 'Operación', 'Producción', 'Publicidad', 'Recepción y Apoyo Administrativo', 'Recursos Humanos', 'Relaciones Públicas', 'Salud y Belleza', 'Servicio al Cliente', 'Sistemas Computacionales (Hardware)', 'Tecnologías de Información (Software)', 'Transportación', 'Turismo', 'Ventas'];

	$scope.tiempo = ['Tiempo', 'Menos de 1 año', 'De 1 a 3 años', 'De 3 a 5 años', 'De 5 a 10 años', 'Más de 10 años'];

	$scope.sueldo = ['Sueldo', '$5,000.00 - $10,000.00', '$10,000.00 - $15,000.00', '$15,000.00 - $20,000.00', '$20,000.00 - $30,000.00', '$30,000.00 - $40,000.00', '$40,000.00 - $50,000.00', '$50,000.00 - $70,000.00', '$70,000.00 - $90,000.00', '$90,00.00 - $120,000.00', '$120,000.00 - $150,000.00'];

	$scope.ingles = ['Inglés', 'Nulo (No tiene conocimientos del idioma.)', 'Principiante (Entiende textos y algunas expresiones al escuchar. No lo habla.)', 'Intermedio (Puede leerlo y escribirlo. Solo habla y entiende expresiones básicas.)', 'Avanzado (Puede leerlo y escribirlo. Capaz de establecer conversaciones.)', 'Nativo (Domina completamente el idioma.)'];

	$scope.estado = ['Estado', 'Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Chiapas', 'Chihuahua', 'Coahuila', 'Colima', 'Distrito Federal', 'Durango', 'Estado de México', 'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz', 'Yucatán', 'Zacatecas'];

	$scope.institucion = ['Institución', 'UANL', 'UN', 'UR', 'ITESM', 'UDEM', 'Tec Milenio', 'UMM', 'CEU', 'UM', 'CEDIM', 'IPADE', 'UVM', 'IRH', 'Otro'];

	$scope.personaDialog = function(ev, index) {
		$scope.persona = $scope.personas[index];
		$mdDialog.show({
			controller: DialogController,
			templateUrl: 'index.php?controller=Admin&action=personaDialog',
			parent: angular.element(document.body),
			targetEvent: ev,
			clickOutsideToClose:true,
			scope: $scope,
			bindToController: true,
			resolve: true,
			preserveScope: true
		});
	};

	$scope.$watch('search.area1', function() {
		$scope.loading = 'Cargando...';
		if ($scope.search.area1 == 0) {
			$http.post('Admin/ajaxGetPersonas', {})
			.then(function(response) {
				$scope.personas = response.data;
			})
			.finally(function() {
				$scope.loading = null;
				delete $scope.search.area1;
			});
		} else if($scope.search.area1 != null) {
			$http.post('Admin/ajaxGetPersonasAreas', {area1: $scope.search.area1})
			.then(function(response) {
				$scope.personas = response.data;
			})
			.finally(function() {
				$scope.loading = null;
			});
		}
	});
	$scope.$watch('search.rango_sueldo', function() {
		if ($scope.search.rango_sueldo == 0) {
			delete $scope.search.rango_sueldo;
		}
	});
	$scope.$watch('search.sexo', function() {
		if ($scope.search.sexo == 0) {
			delete $scope.search.sexo;
		}
	});
	$scope.$watch('search.residencia', function() {
		if ($scope.search.residencia == 0) {
			delete $scope.search.residencia;
		}
	});
	$scope.$watch('search.ingles', function() {
		if ($scope.search.ingles == 0) {
			delete $scope.search.ingles;
		}
	});
});

