var MIDDLEWARE_URL = "http://api.yaysornays.com/middleware/mock/";
var currentContest = 1;
var debug = true;



function log(msg, clear) {
    try {
        if(debug){
        	var now = new Date();
	        if (clear) {
	            console.clear();
	        }
	        console.log('(' + now.getTime() + ') - ' + msg);
        }
    } catch (e) {

    }
}


function dump(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	
	if(typeof(arr) == 'object') { //Array/Hashes/Objects 
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == 'object') { //If it is an array,
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { //Stings/Chars/Numbers etc.
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
	return dumped_text;
}