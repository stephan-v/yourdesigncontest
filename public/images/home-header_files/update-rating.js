$(function() {

    $(".radio").on("click",function(e) {  
        // Entry id
      	var entry_id = $(this).closest(".entry-item").attr("id");

        // Ajax call 
        $.post(BASE+'/contests/any/entries/any',{ 
            rating: this.value, 
            entry_id : entry_id
        }, function(data) {
            console.log(data);
        });
    }); 

    $(".delete-entry").on("mouseover",function(e) {
        $(".options-entry", this).stop().fadeIn('fast');
    });

    $(".options-entry").on("mouseleave",function(e) {
        $(this).stop().fadeOut('fast');
    });

    $(".delete-entry").on("mouseleave",function(e) {
        $(".options-entry").stop().fadeOut('slow');
    });

    // Delete an entry-item without refresh
    $(".delete-entry .delete").on("click",function(e) {
      	// Entry id
    	var entry_id = $(this).closest(".entry-item").attr("id");

        // Popup dialog to confirm deletion of entry-item
        var answer = confirm('Weet u zeker dat u deze inzending wilt verwijderen?');

        if (answer){
            // Ajax call 
            $.ajax({
                url: BASE+'/contests/any/entries/any',
                type: 'DELETE',
                data: { 
                    entry_id : entry_id 
                },
                success: function() {
                    // Selecteer entryitem with corresponding idnumber and remove it without refresh
                    $(".entry-item#"+entry_id).remove();
                }     
            });
        }        
    }); 

    // UI function single contest tabs
    $(function() {
        $("#tabs").tabs({ active: tab_index });
    });

    // UI function modal windows
    $(function() {
        $( "#dialog" ).dialog({
            width: 500,
            modal: true,
            buttons: [ 
                { 
                    class: 'btn-entry',
                    text: "Ok", click: function() { 
                        $( this ).dialog( "close" ); 
                    } 
                } 
            ]
        });
    });

    $(window).resize(function() {
        $("#dialog").dialog("option", "position", "center");
    });

});