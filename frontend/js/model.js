/////////////////////////////////////////////////////////////

function findAllContests(target){
	_doAjaxRequest(target,MIDDLEWARE_URL + "contest/");
}

function findOneContest(target, id){
	_doAjaxRequest(target,MIDDLEWARE_URL + "contest/"+id);
}

function findTwoPhotos(target, id){
	_doAjaxRequest(target,MIDDLEWARE_URL + "contest/"+id+"/vote");
}

function proccessVote(id,vote){
	var target = null;
	_doAjaxRequest(target,MIDDLEWARE_URL + "contest/"+id+"/vote/"+vote);
}


/////////////////////////////////////////////////////////////

function _doAjaxRequest(successCallback, uri){
	log(uri);
	$.ajax({
		  url: uri,
		  cache: false,
		  success: successCallback,
		 // dataType: "json",
		  error:function(jqXHR, textStatus, errorThrown){
			  log(textStatus);
			  log(errorThrown);
		  }
		});
	
}