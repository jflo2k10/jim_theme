/*! insivia - v0.0.6 - 2016-07-01 */

(function($, root, undefined) {
	$(function() {
		'use strict';
		
		
  /*--------------------------------------------------------------
  # Global Variables
  # variableName
  --------------------------------------------------------------*/
  
  /*--------------------------------------------------------------
  # Functions
  # insvt_function_name()
  --------------------------------------------------------------*/
  // Slugify
  function insvt_slugify(theString) {
    return theString.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
  }  
  // Init Function
  function insvt_init(){
    
  }
  
  /*--------------------------------------------------------------
  # Init
  --------------------------------------------------------------*/
  
  $(document).ready(function() {
    insvt_init();
  });
  
  $(window).resize(function() {
    
  });
  
  $(window).scroll(function() {
    
  });
	});

})(jQuery, this);