/**
 * Function to check if browser has adblock enabled
 */
function adBlockCheck(){
  var adblock = document.createElement('div');
  adblock.innerHTML = '&nbsp;';
  adblock.className = 'adsbox';
  document.body.appendChild(adblock);
  window.setTimeout(function() {
    if (adblock.offsetHeight === 0) {
      document.body.classList.add('adblock');
    }
    adblock.remove();
  }, 1000);
}

/**
 * Function to generate a quick guid, not an official guid, but pretty damn close.
 */
function generateQuickGuid() {
  return Math.random().toString(36).substring(2, 15) +
  Math.random().toString(36).substring(2, 15);
}

/**
 * Function to debounce resize
 */
 function debounce(func, wait, immediate) {
  var timeout;
    return function() {
      var context = this, args = arguments;
      var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
 };

 /**
 * Function to fix window.loction.origin in legacy browsers
 */
function windowOriginFix(){
  if ( !window.location.origin ){
    window.location.origin = window.location.protocol + "//" + window.location.hostname;
  }
}

/**
 * Function to scroll to an anchor on the current page if the url has a hash
 */
function scrollToAnchor(scrollSpeed, scrollDelay){
  if ( window.location.hash.length > 0){
    var hash = window.location.hash;
    var path = window.location.pathname;
    var hashPath = path + hash;
    setTimeout(function(){
      $('html, body').animate({
        scrollTop : $(hash).position().top - 109 //This value should be changed to the header height dynamically if the header is fixed
      }, scrollSpeed);
    }, scrollDelay);
  }
}

/**
 * Variable/Function to check if the UA is from a mobile device
 */
 var isMobile = {
   Android: function() {
       return navigator.userAgent.match(/Android/i);
   },
   BlackBerry: function() {
       return navigator.userAgent.match(/BlackBerry/i);
   },
   iOS: function() {
       return navigator.userAgent.match(/iPhone|iPad|iPod/i);
   },
   Opera: function() {
       return navigator.userAgent.match(/Opera Mini/i);
   },
   Windows: function() {
       return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
   },
   any: function() {
       return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
   }
 };
/*
// Example usage

if( isMobile.any() ){

} else {

}
*/

function windowOriginFix(){
  if ( !window.location.origin ){
    window.location.origin = window.location.protocol + "//" + window.location.hostname;
  }
}
