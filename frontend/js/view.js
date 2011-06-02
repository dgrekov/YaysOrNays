function populateContestList(result){
	$.each(result.contests,function(){
		$("#ContestList")
			.append("<li>")
			.append(this.name)
			.append("</li>");
	});
}

function populateRandomPicture(result){
	log(result);
	$("#picture1").attr("src", result.photos[0].uri);
	$("#picture1").data("imgID",result.photos[0].id);
	$("#picture2").attr("src", result.photos[1].uri);
	$("#picture2").data("imgID", result.photos[1].id);
	$("#picture1, #picture2").fadeIn();
}

function hideRandomPicture(){
	$("#picture1, #picture2").fadeOut();
}