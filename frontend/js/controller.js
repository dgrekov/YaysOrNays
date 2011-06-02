$(document).ready(loadHandlers);

function loadHandlers(){

	$(".votePicture").click(function(){
		var imgID = $(this).data("imgID");
		proccessVote(currentContest,imgID);
		hideRandomPicture();
		findTwoPhotos(populateRandomPicture,currentContest);
	});
	
	$( "#ContestPopup" ).dialog({
		height: "auto",
		modal: true,
		title: "Contests",
		autoOpen: false
	});
	
	findTwoPhotos(populateRandomPicture,currentContest);
	
	$("#CurrentContest").click(function(){	
		findAllContests(populateContestList);
		$( "#ContestPopup" ).dialog( "open" );
		
	});
	/*
    FB.init({
    	appId: '209073832457954', 
    	status: true, 
    	cookie: true,
    	xfbml: true
    });
    */  

}