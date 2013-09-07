<?php
/* @var $this RideController */
/* @var $model Ride */
?>



<input type="hidden" id="datetime" name="datetime"/>      
<div id="rideForm" style="text-align: center;">
    <div id="formError" class="form errorSummary"></div>
        <fieldset data-role="controlgroup" data-type="horizontal" id="source">
            <div id="stepOne" style="text-align: center;">
               <legend> מקור הנסיעה</legend>
            <?php
                    foreach ($sources as $source)
                    {
                        if ($model->source_id == $source->id)
                        {
                            echo "<input type='radio' checked name='source_id' id=$source->id value=$source->id />";
                            echo "<label for=$source->id>$source->name</label>";  
                        }
                        else 
                        {
                            echo "<input type='radio' name='source_id' id=$source->id value=$source->id />";
                            echo "<label for=$source->id>$source->name</label>";  
                        }
                    }
                ?>
            </div>
            
            <br /><br><br>
        <div id="stepTwo">
        <label for="textAmount">סכום</label>
        <!--<input type="text" id="textAmount" name="textAmount"/> -->
        <?php echo CHtml::activeTextField($model, 'amount', array("id"=>"textAmount", "name"=>"textAmount", "placeholder"=>"הזן סכום")); ?>
        <?php echo CHtml::error($model, 'amount'); ?>
        </div>
        </fieldset>
        <div id="rideStartingTime">
                
                <?php 
                   if(isset($model->start_time))
                   {
                       $date = new DateTime($model->start_time);
                       echo "<b><p> הנסיעה החלה ב: ";
                       echo date_format($date, 'H:i d/m/y');
                       echo "</p></b>";
                   }
               ?>
            </div>
        <a href="#rideStartPopup" id="openSourcePopup" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" style="display: none"></a>
        <div data-role="popup" id="rideStartPopup" data-overlay-theme="e" data-theme="a">
            <!--<div id="rideStart" data-role="button" data-inline="true">התחל נסיעה</div> -->
            <input type="button" id="rideStart"  value="התחל נסיעה"/>
        </div>
       <!-- <div  id="newRide" data-role="button" data-inline="true">התחל נסיעה חדשה</div> -->
        <div id="updateAmount" data-role="button" data-inline="true">עדכן סכום</div>
        <hr />
        <div id="destinationControls">
            <input type="text" id="destinationAddress" placeholder="הזן את כתובת היעד ולחץ על נווט" />
            <input type="button" id="startWaze" value="נווט"/>
        </div>
        
</div>


<script type="text/javascript">
$(document).bind('pageinit', function(){ 
   
//$(document).delegate('#page', 'pageinit', function () {
//$(document).ready(function() {
    
    //set the source_id of the selected source (radio button)
    var source_id;
    $("input[name=source_id]").click(function(event, ui){
        $("#rideStartPopup").popup("open");
        source_id = $(this).val();
    });
    
    $("#rideStart").click(function(event, ui){ 
        $.mobile.showPageLoadingMsg();
        $("#rideStartPopup").popup("close");
        resetFields();
        //alert(lat);
        //alert(lon);
        //var address = getOriginAddress();
        //update ride table on the ride start with no amount.
       $.ajax({
           type: "POST",
           //url: "http://192.168.1.10/taxic/index.php/ride/rideStart",
           url: "rideStart",
           data: {
               "source_id": source_id,
               "currentTime": $("#datetime").val(),
               "lat": lat,
               "lon": lon
               //"address": address
           },
           success: function(data){
             
             //alert(data);
             $("#rideStartingTime").empty();
             //$("#rideStartingTime").delay(8000).fadeIn();
             $("#rideStartingTime").append(data);
             
             $.mobile.hidePageLoadingMsg();
             
             
           },
           error: function(e){
                alert(e.responseText);
           }
           
       });
          
    });
    
    function resetFields(){
        $("input[type=text]").val("");
        //$("input[type=radio").attr("checked",false);
    };
    //update the amount of the ride by calling the "updateAmount" function on the server side
    $("#updateAmount").bind("click", function(event, ui) {
        
        if (!$.isNumeric($("#textAmount").val())){
            alert("יש להזין מספרים בלבד");
            $("#textAmount").val("");
        }
        else {
           $.ajax({
           type: "POST",
           url: "updateAmount",
           data: {
               amount: $("#textAmount").val()
           },
           success: function(data){
               $("#rideStartingTime").empty();
               $.mobile.hidePageLoadingMsg();
               
               alert("הסכום עודכן בהצלחה");
                
           },
           error: function(e){
               alert(e.responseText);
           }
           
       });
        }
        
    });
    
           
    $("#newRide").bind("click", function(event, ui) {
        $.mobile.showPageLoadingMsg();
        $.ajax({
           type: "POST",
           url: "newRide",
           data: {
               amount: $("#textAmount").val()
           },
           success: function(data){
     
             $("#rideStartingTime").empty();        
             $.mobile.hidePageLoadingMsg();
             
           },
           error: function(e){
               alert("error");
           }
           
       });
    });
    
    //check if the ride is started
    function rideStarted(){
        if($("#rideStartingTime").is(":empty")) {
            return false;
        }
        else{
            return true;
        }
    }
    
    //start waze with the destination address
    $("#startWaze").bind("click", function(){
        
        var destUpdate = false;
        if (rideStarted() && $("#destinationAddress").val() != "")
            {
                 $.ajax({
                    type: "POST",
                    async: false,
                    url: "updateDestination",
                    data: {
                        destinationAddress: $("#destinationAddress").val()
                    },
                    success: function(data){
                        destUpdate = data;
                    },
                    error: function(e){
                        alert("error");
                    }

                });
                
                if (destUpdate == true)
                    {
                        window.plugins.webintent.startActivity({
                        action: window.plugins.webintent.ACTION_VIEW,
                        url: "waze://?q=" + $("#destinationAddress").val()},
                        function() {}, 
                        function() {alert('Failed to open URL via Android Intent')}
                        ); 
                    }
            }
            
            else {
                alert("יש להתחיל בנסיעה לפני תחילת הניווט");
            }
       
        
    });
    
    //get address from google using current longitude&latitude
    function getOriginAddress(){
        var street = "";
        var street_number = "";
        var city = "";
        $.ajax({
           type: "GET",
           url: "http://maps.googleapis.com/maps/api/geocode/json",
           dataType: 'json',
           cache: false,
           async: false,
           data: 'latlng=' + lat + "," + lon + '&sensor=false&language=he',
           success: function(json_data){                          
                  street = json_data["results"][0]["address_components"][1]["long_name"];
                  street_number = json_data["results"][0]["address_components"][0]["long_name"];
                  city = json_data["results"][0]["address_components"][2]["long_name"];
              
              
                   
                  //return street + " " + street_number + " " + city;
               },
           error: function(e){
               alert(e);
           }
           }); 
           
           return street + " " + street_number + " " + city;
    };
        
});


//client's current date-time.
clk();
function clk() {
        var a=new Date();   
        var datetime = (a.getYear() + 1900) + "-" + (a.getMonth() + 1) + "-" + (a.getDate()) + " " + (a.getHours()) + ":" + (a.getMinutes()) + ":" + a.getSeconds();
        $("#datetime").val(datetime);
        setTimeout(clk,60000);
}

</script>