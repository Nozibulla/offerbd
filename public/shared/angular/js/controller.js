offerBD.controller('regController',function($scope,$http,$window){

	$scope.reginfo = {};

	$scope.regNext = function(isValid,$event){

		$event.preventDefault();

		if (isValid) {

			//sending the data for storing in database

			$http({

				method : 'POST',

				url    : '/ARP',

				data   : this.reginfo,

				dataType : 'json'

			})
			.success(function(data,status){

				// $scope.reginfo ={};

				alert("Registration complete.");

				$window.location.href="admin/login";

			})
			.error(function(data,status){

				if (status === 422) {

					if (angular.isDefined(data["email"])) {

						$scope.errorEmail = data["email"][0];

					}

					if (angular.isDefined(data["confirm_user_password"])) {

						$scope.matchError = data["confirm_user_password"][0];

					}

				}
				
			});

		}

	}
});

// login controller for admin

offerBD.controller('loginController',function($scope,$http,$window){

	$scope.loginInfo = {};

	$scope.adminLogin = function(isvalid,event){

		event.preventDefault();

		if (isvalid) {

			console.log($scope.loginInfo);

			$http({

				method : "POST",

				url  : "/ALP", //admin login process for ALP

				data : $scope.loginInfo,

				dataType : "json"

			})
			.success(function(data){

				$window.location.href= "/admin";

			})
			.error(function(data,status){

				alert("error");

			});
		}
	}

});

//set profile controller

updateProfile.controller('setProfileCtrl', function($scope,$http) {

	// sending request for getting the logged in user info
	$http.get("/getloggeduserinfo").success(function (response) {

		$scope.profile = response;

		return false;

	});

	$scope.checkName = function(data){

		if(!data){

			return "Field required";
		}
	}

	$scope.updateInfo = function(data){

		if (!data) {

			return "Field Required";
		}
		else{

			return $http.post('/updateLoggedInUserInfo',{first_name:data});
		}
	}

});


// controller for adding new brand

offerBD.controller("addNewBrandCtrl",function($scope,$http,$window){

	$scope.brand_name = "";

	$scope.submitAddBrandForm = function(event){

		event.preventDefault();

		$scope.brand_name = $scope.brand_name;

		alert($scope.brand_name);

		$http({

				method : "POST",

				url  : "/addnewbrand",

				data : {brand_name: $scope.brand_name},

				dataType : "json"

			})
			.success(function(response,status){

				console.log(status);

			})
			.error(function(data,status){

				if (status == 422) {

					$scope.brand_name_required = "jjkkjkjk";
				}

			});
	}

});
// end of adding new brand controller