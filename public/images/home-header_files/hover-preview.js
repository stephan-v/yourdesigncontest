// Kick off the jQuery with the document ready function on page load
$(document).ready(function(){
	imagePreview();
});

// Configuration of the x and y offsets
this.imagePreview = function(){	
		xOffset = 130;
		yOffset = 30;		
		
    $("a.preview").hover(function(e){
        this.t = this.title;
        this.title = "";	
	     var c = (this.t != "") ? "<br/>" + this.t : "";
         $("body").append("<p id='preview'><img src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");								 
         $("#preview")
            .css("top",(e.pageY - xOffset) + "px")
            .css("left",(e.pageX + yOffset) + "px")
            .fadeIn("slow");
    },
	
    function(){
        this.title = this.t;
        $("#preview").remove();

    });	
	
    $("a.preview").mousemove(function(e){
        $("#preview")
            .css("top",(e.pageY - xOffset) + "px")
            .css("left",(e.pageX + yOffset) + "px");
    });			
};