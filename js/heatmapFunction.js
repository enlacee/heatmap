/**
 * GET x,y in screamview  browser
 * @returns {Array}
 */
function getViewport() {

    var viewPortWidth;
    var viewPortHeight;

    // the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight
    if (typeof window.innerWidth != 'undefined') {
    viewPortWidth = window.innerWidth,
    viewPortHeight = window.innerHeight
    }

    // IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)
    else if (typeof document.documentElement != 'undefined'
    && typeof document.documentElement.clientWidth !=
    'undefined' && document.documentElement.clientWidth != 0) {
    viewPortWidth = document.documentElement.clientWidth,
    viewPortHeight = document.documentElement.clientHeight
    }

    // older versions of IE
    else {
    viewPortWidth = document.getElementsByTagName('body')[0].clientWidth,
    viewPortHeight = document.getElementsByTagName('body')[0].clientHeight
    }
    return [viewPortWidth, viewPortHeight];
}

/**
 * Format DATE
 * @param {type} stringDate
 * @returns {_settingDateTime.myDate|Date|Boolean}
 */
function _settingDateTime(d) {
    
    var curr_date = d.getDate();
    var curr_month = d.getMonth() + 1; //Months are zero based
    var curr_year = d.getFullYear();
    
    var curr_hour = d.getHours();
    var curr_min = d.getMinutes();
    var curr_seg = d.getSeconds();
    
    var string = curr_year + "-" + curr_month + "-" + curr_date + ' ' +
        curr_hour + ':' + curr_min + ':' + curr_seg;
    return string;
}

/**
 *
 * @type {number}
 */
function cuniq() {
    var d = new Date(),
        m = d.getTime(),
        r = parseInt(Math.floor(Math.random() * 100)),
        u = m+''+r;
    return u;
}


// ================================================================================
// app
// ================================================================================
var dataXY = new Array();
var idBrowser = cuniq();

//get x,y
function getPos(e) {
    var x = e.clientX;
    var y = e.clientY;
    var arrayScreem = getViewport();
    var arreglo = {
        'id' : idBrowser,
        'x' : x,
        'y' : y,
        'viewPort' : arrayScreem[0] + 'x' + arrayScreem[1],
        'windowBrowser' : window.outerWidth + 'x' + window.outerHeight,
        'screen' : screen.width + 'x' + screen.height,
        'date' : _settingDateTime(new Date())
    };

    dataXY.push(arreglo);
}

 /**
  * send data to server
  */
function sendDataToServer() {
         setTimeout(function() {
             sendDataToServer();
             dataXY = new Array();

         }, 2000);

     $.ajax({
         url: 'controller.php',
         data : {data : dataXY, idPage : 1},
         type: 'POST',
         dataType: 'json',
         success: function (rs){
         }
     });
}


// Init App
sendDataToServer();