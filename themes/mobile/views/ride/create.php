<?php
/* @var $this RideController */
/* @var $model Ride */
?>

<input type="hidden" id="datetime" name="datetime"/>      
<div id="rideForm" style="text-align: center">
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
        <input type="text" id="textAmount" name="textAmount"/>
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
            <a href="#" id="rideStart" data-role="button" data-inline="true">התחל נסיעה</a>
        </div>
        <a href="#" data-role="button" data-inline="true">נסיעה חדשה</a>
        <a href="#" data-role="button" data-inline="true">אישור</a>
        
</div>



<script type="text/javascript">
$(document).ready(function() {
    
    //set the source_id of the selected source (radio button)
    var source_id;
    $("input[name=source_id]").change(function(){
        $("#openSourcePopup").click();
        source_id = $(this).val();
    });
    
    $("#rideStartPopup").click(function(){
        
        //update ride table on the ride start with no amount.
       $.ajax({
           type: "POST",
           url: "rideStart",
           data: {
               "source_id": source_id,
               "currentTime": $("#datetime").val()
           },
           success: function(data){
             alert(data);  
           },
           error: function(e){
               alert(e);
           }
           
       });
       $(this).popup("close");
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