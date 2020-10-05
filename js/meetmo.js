	var $$ = jQuery.noConflict();

var requestUserName,
	requestUserPassword,
	requestUserKey,
	currentWebsite,
	authKey,
	website,
	userID,
	roomID,
	currentBGImage,
	updatedBGImage,
	userTier,
	roomLayout,
	authorizedUsers;

	/*
		FOR DEVELOPMENT ONLY!
		The following variables are only good for development purposes.
	 */

	requestUserName = "webconnected";
 	requestUserPassword = "dIvQ(V)N9%LqKe%^v7HbZm!N";
 	currentWebsite = "https://www.live.fox/webconnected/";

	 // TODO: Pull the following variables from cookies set upon login:
	 // requestUserName, requestUserPassword, requestUserKey, currentWebsite
	 // Set other cookies necessary when USER logs in.
	 // If cookies exist, add to local storage?

function getAuthKey(website, username, password) {
  var settings = {
    "url": website + "wp-json/jwt-auth/v1/token?username=" + username + "&password=" + password,
    "method": "POST",
    "timeout": 0,
    "headers": {
      "username": username,
      "password": password
    },
  };
  $$.ajax(settings).done(function(response) {
    requestUserKey = response.token;
    wcToken = window.localStorage;
    wcToken.setItem('wctoken', requestUserKey);
    return authKey = requestUserKey;
  });
  return authKey;
}

function validateAuthKey(website, username, password) {
  // Check if localStorage item exists
  if (window.localStorage.hasOwnProperty('wctoken')) {

    // If it exists, set the token for validation.
    var token = window.localStorage.getItem('wctoken');

    var settings = {
      "url": website + "wp-json/jwt-auth/v1/token/validate",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
    };

    $$.ajax(settings).done(function(response) {
      if (response.code == 'jwt_auth_valid_token' && response.data.status == 200) {
        console.log(response);
        // Execute for success
      } else {
        // Execute for failure
      }
    });
    // If it doesn't exist lets get it
  } else {
    getAuthKey(username, password);
    setTimeout(function() {
      validateAuthKey(website, username, password);
    }, 500);
  }
}

function getPageByID(website, pageID) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var settings = {
      "url": website + "wp-json/wp/v2/pages/" + pageID,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
    };

    $$.ajax(settings).done(function(response) {
      console.log(response);
    });
  } else {

  }
}

function getCurrentLobbyVideoURL(website, pageID) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var settings = {
      "url": website + "wp-json/wp/v2/pages/" + pageID,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
    };

    $$.ajax(settings).done(function(response) {
      return response.lobby_video_url;
    });
  } else {

  }
}

function getCurrentBackgroundImage(website, pageID) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var settings = {
      "url": website + "wp-json/wp/v2/pages/" + pageID,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
    };

    $$.ajax(settings).done(function(response) {
      return response.current_background_image;
    });
  } else {

  }
}

function getCurrentConferenceLayout(website, pageID) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var settings = {
      "url": website + "wp-json/wp/v2/pages/" + pageID,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
    };

    $$.ajax(settings).done(function(response) {
      return response.current_layout;
    });
  } else {

  }
}

function updateRoomInfo(website, room_id, current_layout, current_background_image, lobby_video_url) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var form = new FormData();
    form.append("room_id", room_id);
    form.append("current_layout", current_layout);
    form.append("current_background_image", current_background_image);
    form.append("lobby_video_url", lobby_video_url);
    form.append("api_url", website);

    var settings = {
      "url": website + "?room_update",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $$.ajax(settings).done(function(response) {
      return response;
    });
  } else {

  }
}

function updateRoomLayout(website, room_id, current_layout) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var form = new FormData();
    form.append("room_id", room_id);
    form.append("current_layout", current_layout);
    form.append("api_url", website);

    var settings = {
      "url": website + "?room_update",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $$.ajax(settings).done(function(response) {
      return response;
    });
  } else {

  }
}

function updateRoomBackground(website, room_id, current_background_image) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var form = new FormData();
    form.append("room_id", room_id);
    form.append("current_background_image", current_background_image);
    form.append("api_url", website);

    var settings = {
      "url": website + "?room_update",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $$.ajax(settings).done(function(response) {
      return response;
    });
  } else {

  }
}

function updateRoomLobbyVideo(website, room_id, lobby_video_url) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var form = new FormData();
    form.append("room_id", room_id);
    form.append("lobby_video_url", lobby_video_url);
    form.append("api_url", website);

    var settings = {
      "url": website + "?room_update",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $$.ajax(settings).done(function(response) {
      return response;
    });
  } else {

  }
}

function getUserByID(website, userID) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var settings = {
      "url": website + "wp-json/wp/v2/users/" + userID,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
    };

    $$.ajax(settings).done(function(response) {
      console.log(response);
    });
  } else {

  }
}

function getUserEventTier(website, userID) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var settings = {
      "url": website + "wp-json/wp/v2/users/" + userID,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
    };

    $$.ajax(settings).done(function(response) {
      console.log(response.user_event_tier);
    });
  } else {

  }
}

function getUserRoomAccess(website, userID) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var settings = {
      "url": website + "wp-json/wp/v2/users/" + userID,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
    };

    $$.ajax(settings).done(function(response) {
      console.log(response.user_room_access);
    });
  } else {

  }
}

function updateUserInfo(website, user_update, user_id, user_event_tier, user_room_access) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var form = new FormData();
    form.append("user_update", user_update);
    form.append("user_id", user_id);
    form.append("user_event_tier", user_event_tier);
    form.append("user_room_access", user_room_access);
    form.append("api_url", website);
    var settings = {
      "url": website + '?user_update',
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };
    $$.ajax(settings).done(function(response) {
      return response;
    });
  } else {
    //No Token
  }
}

function updateUserTier(website, user_update, user_id, user_event_tier) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var form = new FormData();
    form.append("user_update", user_update);
    form.append("user_id", user_id);
    form.append("user_event_tier", user_event_tier);
    form.append("api_url", website);
    var settings = {
      "url": website + '?user_update',
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };
    $$.ajax(settings).done(function(response) {
      return response;
    });
  } else {
    //No Token
  }
}

function updateUserRoomAccess(website, user_update, user_id, user_room_access) {
  if (window.localStorage.hasOwnProperty('wctoken')) {
    var token = window.localStorage.getItem('wctoken');
    var form = new FormData();
    form.append("user_update", user_update);
    form.append("user_id", user_id);
    form.append("user_room_access", user_room_access);
    form.append("api_url", website);
    var settings = {
      "url": website + '?user_update',
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Authorization": "Bearer " + token
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };
    $$.ajax(settings).done(function(response) {
      return response;
    });
  } else {
    //No Token
  }
}
