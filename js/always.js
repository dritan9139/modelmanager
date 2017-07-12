function showMessage(msg){
	var msgBox=$("<div>").addClass("msgBox");
	$("body").append(msgBox);
	msgBox.append(msg);
	setTimeout(function(){msgBox.fadeOut(500,function(){msgBox.remove();})},3000)
}

$(function(){
    $.contextMenu({
        selector: '.context-menu-one', 
        callback: function(key, options) {
/*        	
        	console.log(this);
            var m = "clicked: " + key;
            window.console && console.log(m) || alert(m);
*/            
            var win = window.open('/kunden/details/' + this.attr('id') + '/', '_blank');
            if(win){
                //Browser has allowed it to be opened
                win.focus();
            }else{
                //Broswer has blocked it
                alert('Please allow popups for this site');
            }
            
        },
        items: {
            "edit": {name: "Details open new Window"},
        }
    });
    
    $('.context-menu-one').on('click', function(e){
    	e.preventDefault();
/*        console.log('clicked', this); */
        console.log(this);
    })
});

