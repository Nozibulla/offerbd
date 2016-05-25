    var offerBD = angular.module('offerBD', ['ngMessages'], function($interpolateProvider) {

    	$interpolateProvider.startSymbol('<@');
    	
    	$interpolateProvider.endSymbol('@>');

    });

    // new module for profile update

    var updateProfile = angular.module("updateProfile", ["xeditable","angularSpinners"],function($interpolateProvider){

    	$interpolateProvider.startSymbol('<@');
    	
    	$interpolateProvider.endSymbol('@>');

    });

    updateProfile.run(function(editableOptions) {

    	editableOptions.theme = 'bs3';

    });
