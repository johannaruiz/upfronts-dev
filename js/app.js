var $$ = jQuery.noConflict();
/**
 * Load Foundation
 */
$$(document).foundation();

$$(document).ready(function()  {
	$$.each($$('.wppb-user-forms ul li'), function(i, val) {
		var label = $$(this).children('label').text();
		var input = $$(this).children('input');
		$$(input).attr('placeholder', label);
	});

	$$('#register').val('Register');

	$$.each($$('.wppb-user-forms p'), function(i, val) {
		var label = $$(this).children('label').text();
		var input = $$(this).children('input');
		$$(input).attr('placeholder', label);
	});

  if ( $$('body').hasClass('activity-theme') ){
    $$('#wppb-submit').val('Get Started');
  } else {
    $$('#wppb-submit').val('Watch');
  }

  if ( $$('body').hasClass('pilights') ){
    $$('#wppb-submit').css('background-color', '#EC6624');
  }


  if ( $$('#wppb-login-wrap').length > 0 ){
    if ( Foundation.MediaQuery.current === 'small' ){
      $$('#user_login').attr('placeholder', 'Email');
    } else {
      $$('#user_login').attr('placeholder', 'Enter Your Email Address');
    }

    $$(window).on('resize', function(){
      if ( Foundation.MediaQuery.current === 'small' ){
        $$('#user_login').attr('placeholder', 'Email');
      } else {
        $$('#user_login').attr('placeholder', 'Enter Your Email Address');
      }
    });

    //$$('.login-password').hide();
  }

  $$('.contact-popup').click(function() {
    $$('#contact').foundation('open');
  });

  if ( $$('#wppb-recover-password').length > 0 ){
    var updatedCopy = 'Please enter your email address. <br> You will receive a link to create a new password via email.'
    //$$('#wppb-recover-password p:first-of-type').html(updatedCopy).css( 'padding-left', '30px' );
		$$('#wppb-recover-password p:first-of-type').html(updatedCopy);
    $$('.content-container p:last-child').css( 'margin-top', '1rem' );
  }

  if ( $$('[for="user_email_username"]').length > 0 ){
    $$('[for="user_email_username"]').html('Please enter your email address to receive an email with a onetime login link.');
    $$('#wpa-submit').addClass('button');
    if ( Foundation.MediaQuery.current === 'small' ){
      $$('#user_email_username').attr('placeholder', 'Email');
    } else {
      $$('#user_email_username').attr('placeholder', 'Enter your Email Address');
    }
    $$(window).on('resize', function(){
      if ( Foundation.MediaQuery.current === 'small' ){
        $$('#user_email_username').attr('placeholder', 'Email');
      } else {
        $$('#user_email_username').attr('placeholder', 'Enter your Email Address');
      }
    });
  }

  /*if ( $$('#user_login').length > 0 ){
    var currentValue, currentPassword;
    $$('#user_login').on('input', function(){
      currentValue = $$(this).val().toUpperCase();
      $$('#user_pass').val(currentValue);
    })
  }*/
});

/**
 * Function for detecting the current media query used by Foundation.
 * This will add a class to the body element on load an resize for the proper screen size.
 */
function currentMediaQuery(){
  if ( Foundation.MediaQuery.current === 'xxlarge' ){
    $$('body').addClass('xxlarge')
    $$('body').removeClass('xlarge large medium small');
  } else if ( Foundation.MediaQuery.current === 'xlarge' ){
    $$('body').addClass('xlarge')
    $$('body').removeClass('xxlarge large medium small');
  } else if ( Foundation.MediaQuery.current === 'large' ){
    $$('body').addClass('large')
    $$('body').removeClass('xxlarge xlarge medium small');
  } else if ( Foundation.MediaQuery.current === 'medium' ){
    $$('body').addClass('medium')
    $$('body').removeClass('xxlarge xlarge large small');
  } else if ( Foundation.MediaQuery.current === 'small' ){
    $$('body').addClass('small')
    $$('body').removeClass('xxlarge xlarge large medium');
  } else {
    //Silence is golden
  }

  $$(window).on('resize', function(){
    if ( Foundation.MediaQuery.current === 'xxlarge' ){
      $$('body').addClass('xxlarge')
      $$('body').removeClass('xlarge large medium small');
    } else if ( Foundation.MediaQuery.current === 'xlarge' ){
      $$('body').addClass('xlarge')
      $$('body').removeClass('xxlarge large medium small');
    } else if ( Foundation.MediaQuery.current === 'large' ){
      $$('body').addClass('large')
      $$('body').removeClass('xxlarge xlarge medium small');
    } else if ( Foundation.MediaQuery.current === 'medium' ){
      $$('body').addClass('medium')
      $$('body').removeClass('xxlarge xlarge large small');
    } else if ( Foundation.MediaQuery.current === 'small' ){
      $$('body').addClass('small')
      $$('body').removeClass('xxlarge xlarge large medium');
    } else {
      //Silence is golden
    }
  });
}

  function forceKeyPressUppercase(e){

    var charInput = e.keyCode;

    if((charInput >= 97) && (charInput <= 122)) {
      if(!e.ctrlKey && !e.metaKey && !e.altKey) {
        var newChar = charInput - 32;
        var start = e.target.selectionStart;
        var end = e.target.selectionEnd;
        e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
        e.target.setSelectionRange(start+1, start+1);
        e.preventDefault();
      }
    }

  }

const callback = function(){
  currentMediaQuery();
  var contactForm = $$('#gform_1').clone();
  var contactFormWrapper = $$('#gform_wrapper_1').clone();
  $$(document).on('gform_confirmation_loaded', function(event, formID){
    /*setTimeout(function(){
      $$('#gform_confirmation_wrapper_1').detach();
    }, 3500)*/
    setTimeout(function(){
      //$$('#gform_confirmation_wrapper_1').remove();
    },7000);
    setTimeout(function(){
      $$(contactFormWrapper).insertAfter($$('.assistance-intro'));
      //  $$(contactForm).insertAfter($$('.gform_anchor'));
    }, 10000)
    /*setTimeout(function(){
      $$('.gform_wrapper .hidden_label .gfield_label').css({
        "clip" : "rect(1px,1px,1px,1px)",
        "position" : "absolute !important",
        "height" : "1px",
        "width" : "1px",
        "overflow" : "hidden"
      });
      $$('.gform_wrapper.hide-labels_wrapper ul.gform_fields label').css('display', 'none');
    }, 4200)*/
  });

  if ( $$('#user_login').length > 0 ){
    document.getElementById("user_login").addEventListener("keypress", forceKeyPressUppercase, false);
    //$$('#user_login').css('text-transform', 'uppercase');
  }
  // Code to execute when DOM has loaded
}

if ( document.readyState === "complete" || (document.readyState !== "loading" && !document.documentElement.doScroll) ){
  callback();
} else {
  document.addEventListener("DOMContentLoaded", callback);
}


/*
function getAuthKey(username, password){
	var settings = {
	  "url": "https://www.live.fox/webconnected/wp-json/jwt-auth/v1/token?username=webconnected&password=dIvQ(V)N9%LqKe%^v7HbZm!N",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
	    "username": "webconnected",
	    "password": "dIvQ(V)N9%LqKe%^v7HbZm!N"
	  },
	};
	$$.ajax(settings).done(function (response) {
	  rusk = response.token;
		wcToken = window.localStorage;
		wcToken.setItem('wctoken', rusk);
		return rusk;
	});
	return rusk;
}
*/

// webconnected
// dIvQ(V)N9%LqKe%^v7HbZm!N

/*
Plugin Fucntionality

Set Defaults:
	Username
	Password
	Domain/Website URL for API Calls

Functionality
	Get Authorization Key
	Validate Authorization Key
	Get Page Information
	Update Page Information

	Get Authorized Users
	Update Authorized Users?

	Get User
	Update User

 */

	var requestUserName,
	requestUserPassword,
	requestUserKey,
	currentWebsite,
	visitedWebsite,
	authKey,
	website,
	userID,
	roomID,
	currentBGImage,
	updatedBGImage,
	userTier,
	roomLayout,
	authorizedUsers,
	visitedWebsite;

 	visitedWebsite = window.location.pathname;

	requestUserName = "webconnected";
	requestUserPassword = "dIvQ(V)N9%LqKe%^v7HbZm!N";
	currentWebsite = "https://www.live.fox/webconnected";

 	if ( visitedWebsite.includes('webconnected') ){
 		//Start the fun
 		requestUserName = "webconnected";
 		requestUserPassword = "dIvQ(V)N9%LqKe%^v7HbZm!N";
 		currentWebsite = "https://www.live.fox/webconnected";

 		function getAuthKey(website, username, password){
 			var settings = {
 				"url": website + "/wp-json/jwt-auth/v1/token?username="+username+"&password=" + password,
 				"method": "POST",
 				"timeout": 0,
 				"headers": {
 					"username": username,
 					"password": password
 				},
 			};
 			$$.ajax(settings).done(function (response) {
 				requestUserKey = response.token;
 				wcToken = window.localStorage;
 				wcToken.setItem('wctoken', requestUserKey);
 				return authKey = requestUserKey;
 			});
 			return authKey;
 		}

 		function validateAuthKey(website, username, password){
 			// Check if localStorage item exists
 			if ( window.localStorage.hasOwnProperty('wctoken') ){

 				// If it exists, set the token for validation.
 				var token = window.localStorage.getItem('wctoken');

 				var settings = {
 					"url": website + "/wp-json/jwt-auth/v1/token/validate",
 					"method": "POST",
 					"timeout": 0,
 					"headers": {
 						"Authorization": "Bearer " + token
 					},
 				};

 				$$.ajax(settings).done(function (response) {
 					if ( response.code == 'jwt_auth_valid_token' && response.data.status == 200 ){
 						console.log(response);
 						// Execute for success
 					} else {
 						// Execute for failure
 					}
 				});
 			// If it doesn't exist lets get it
 			} else {
 				getAuthKey(username, password);
 				setTimeout(function(){
 					validateAuthKey(website, username,password);
 				}, 500);
 			}
 		}

 		function getPageByID(website, pageID){
 			var settings = {
 				"url": website + "/wp-json/wp/v2/pages/" + pageID,
 				"method": "GET",
 				"timeout": 0,
 			};

 			$$.ajax(settings).done(function (response) {
 				console.log(response);
 			});
 		}

 		function getPageConferenceLayout(website, pageID){
 			var settings = {
 				"url": website + "/wp-json/wp/v2/pages/" + pageID,
 				"method": "GET",
 				"timeout": 0,
 			};

 			$$.ajax(settings).done(function (response) {
 				console.log(response.current_layout);
 			});
 		}

 		function updatePageByID(username, password, website, pageID){
 			if ( window.localStorage.hasOwnProperty('wctoken') ){
 				var token = window.localStorage.getItem('wctoken');
 				/*var settings = {
 					"url": "https://www.live.fox/webconnected/wp-json/wp/v2/pages/2",
 					"method": "POST",
 					"timeout": 0,
 					"headers": {
 						"Content-Type": "application/json",
 						"accept": "application/json",
 						"Authorization": "Bearer " + token
 					},
 					"data": JSON.stringify({"fields":{"current_layout":"12","lobby_video_url":"https://youtube.com","current_background_image":"obamam.jpg"}}),
 				};

 				$$.ajax(settings).done(function (response) {
 					console.log(response);
 				});*/

 				var settings = {
 				  "url": "https://www.live.fox/webconnected/wp-json/wp/v2/pages/2",
 				  "method": "POST",
 				  "timeout": 0,
 				  "headers": {
 				    "Content-Type": "application/json",
 				    "Accept": "application/json",
 				    "Authorization": "Bearer " + token
 				  },
 					"body": JSON.stringify({"fields":{"current_layout":"12","lobby_video_url":"https://youtube.com","current_background_image":"fuckdawgz.jpg"}}),
 				  "data": JSON.stringify({"fields":{"current_layout":"12","lobby_video_url":"https://youtube.com","current_background_image":"fuckdawgz.jpg"}}),
 				};

 				$$.ajax(settings).done(function (response) {
 				  console.log(response);
 				});
 			} else {
 				getAuthKey(username, password);
 				setTimeout(function(){
 					validateAuthKey(website, username,password);
 					setTimeout(function(){
 						updatePageByID(website, pageID);
 					})
 				}, 500);
 			}
 		}

 		function getUserByID(website, userID){
 			var settings = {
 				"url": website + "/wp-json/wp/v2/users/" + userID,
 				"method": "GET",
 				"timeout": 0,
 			};

 			$$.ajax(settings).done(function (response) {
 				console.log(response);
 			});
 		}
 		//End The Fun
 	}
