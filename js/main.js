function init() {
    
     document.addEventListener("deviceready",onDeviceReady, true);
     
     
    
}

var onDeviceReady = function(){
    
    //$("body").append("Device Is Ready");
    
    alert("test");
    alert(ob.getLatitude());
    
}

