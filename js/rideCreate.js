//$(document).bind('pageinit', function(){ 
$(document).delegate('#page1', 'pageinit', function () {
//$(document).ready(function() {    
    //set the source_id of the selected source (radio button)
    var source_id;
    $("input[name=source_id]").click(function(event, ui){
        
        //$("#openSourcePopup").click();
        $("#rideStartPopup").popup("open");
        source_id = $(this).val();
    });
    
    $("#rideStart").click(function(){ 
        
    //$("#rideStart").bind("click", function(event, ui) {
    //$(document).on('click',"#rideStart",function() {
        //alert(window.location.href);
        
        //update ride table on the ride start with no amount.
       $.ajax({
           type: "POST",
           //url: "http://192.168.1.10/taxic/index.php/ride/rideStart",
           url: "rideStart",
           data: {
               "source_id": source_id,
               "currentTime": $("#datetime").val()
           },
           success: function(data){
             refreshPage();
             
           },
           error: function(e){
               //var err = eval("(" + xhr.responseText + ")");
                alert(e.responseText);
           }
           
       });
       $("#rideStartPopup").popup("close");
       
       
    });
    
    //$("#updateAmount").click(function(){
    $("#updateAmount").bind("click", function(event, ui) {
        //alert($("#textAmount").val());
        $.ajax({
           type: "POST",
           //url: "http://192.168.1.10/taxic/index.php/ride/updateAmount",
           url: "http://localhost/taxic/index.php/ride/updateAmount",
           data: {
               amount: $("#textAmount").val()
           },
           success: function(data){
               //document.location = document.URL;
               refreshPage();
           },
           error: function(e){
               alert(e.responseText);
           }
           
       });
    });
    
    $("#newRide").click(function(){
    //$("#newRide").bind("click", function(event, ui) {
        $.ajax({
           type: "POST",
           //url: "http://192.168.1.10/taxic/index.php/ride/newRide",
           url: "newRide",
           /*data: {
               amount: $("#textAmount").val()
           },*/
           success: function(data){
                   //document.location = document.URL;
                   refreshPage();
                            
           },
           error: function(e){
               alert("error");
           }
           
       });
    });

function refreshPage() {
  $.mobile.changePage(
    window.location.href,
    {
      allowSamePageTransition : true,
      changeHash               : false,
      showLoadMsg             : true,
      reloadPage              : true
    }
  );
}

});

/*function refreshPage()
{
    jQuery.mobile.changePage(document.URL, {
        allowSamePageTransition: true,
        transition: 'none',
        reloadPage: true
    });
}*/



//client's current date-time.
clk();
function clk() {
        var a=new Date();   
        var datetime = (a.getYear() + 1900) + "-" + (a.getMonth() + 1) + "-" + (a.getDate()) + " " + (a.getHours()) + ":" + (a.getMinutes()) + ":" + a.getSeconds();
        $("#datetime").val(datetime);
        setTimeout(clk,60000);
}



