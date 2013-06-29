<?php
/* @var $this RideController */
/* @var $model Ride */
?>

<input type="hidden" id="datetime" name="datetime"/>      
<div id="rideForm" style="text-align: center">
    <div id="formError" class="form errorSummary"></div>
        <fieldset data-role="controlgroup" data-type="horizontal" id="source">
            <div id="stepOne">
               <legend> מקור נסיעה</legend>
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
            
            
        <div id="stepTwo">
        <label for="textAmount">סכום</label>
        <!--<input type="text" id="textAmount" name="textAmount"/> -->
        <?php echo CHtml::activeTextField($model, 'amount', array("id"=>"textAmount", "name"=>"textAmount")); ?>
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
        <div  id="newRide" data-role="button" data-inline="true">התחל נסיעה חדשה</div>
        <div id="updateAmount" data-role="button" data-inline="true">עדכן סכום</div>
        
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
    
    //$("#updateAmount").click(function(){
    $("#updateAmount").bind("click", function(event, ui) {
        //alert($("#textAmount").val());
        $.ajax({
           type: "POST",
           url: "updateAmount",
           data: {
               amount: $("#textAmount").val()
           },
           success: function(data){
               //document.location = document.URL;
               //refreshPage();
           },
           error: function(e){
               alert(e.responseText);
           }
           
       });
    });
    
    //$("#newRide").click(function(){
       
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