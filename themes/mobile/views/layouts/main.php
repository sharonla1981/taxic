<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<meta name="language" content="he" /> -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <?php Yii::app()->clientScript->registerCssFile("http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css"); ?>
        <?php //Yii::app()->clientScript->registerScriptFile("http://code.jquery.com/jquery-1.9.1.min.js"); ?>
        <?php Yii::app()->clientScript->registerCoreScript("jquery"); ?>
        <?php Yii::app()->clientScript->registerScriptFile("http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"); ?>
        <?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/webintent.js"); ?>
        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
             
      <script type="text/javascript" charset="utf-8" src="/taxic/js/cordova.js"></script>
      <script type="text/javascript" charset="utf-8" src="/taxic/js/webintent.js"></script>
      <script type="text/javascript" charset="utf-8">
            
        var lat = 0.0;
        var lon = 0.0;
        // Call onDeviceReady when PhoneGap is loaded.
        //
        // At this point, the document has loaded but cordova.js has not.
        // When PhoneGap is loaded and talking with the native device,
        // it will call the event `deviceready`.
        // 
        
        document.addEventListener("deviceready", onDeviceReady, false);

        // PhoneGap is loaded and it is now safe to make calls PhoneGap methods
        //
        function onDeviceReady() {
            //alert("test");
            navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);
            
            //showAlert();
        };
        
        function onGeoSuccess(position) {
            
                lat = position.coords.latitude;
                lon = position.coords.longitude;
                
                
                /* get address from google using current longitude&latitude
                $.ajax({
                   type: "GET",
                   url: "http://maps.googleapis.com/maps/api/geocode/json",
                   dataType: 'json',
                   cache: false,
                   data: 'latlng=' + lat + "," + lon + '&sensor=false&language=he',
                   success: function(json_data){                          
                           alert(json_data["results"][0]["address_components"][1]["long_name"]);
                       },
                   error: function(e){
                       alert(e);
                   }
                   });*/ 
                           //alert(lat);

        };
            
        function onGeoError(error) {
                if(error == 1){
                    alert("Please Turn On geolocation Service");
                }
        };
        
        /*function showAlert() {
            navigator.notification.alert(
                'You are the winner!',  // message
                alertDismissed,         // callback
                'Game Over',            // title
                'Done'                  // buttonName
                );
        }
        
        function alertDismissed() {
            // do something
        }*/
            

        </script>
        <style>
            /* change menu font size*/
            .ui-btn-text {
                font-size: 16px;
            }
        </style>
</head>

<body>
    <script type="text/javascript">
       
    </script>
    <div class="container" id="page1" data-role="page" <?php if (Yii::app()->language == 'he' || 'he_il') echo "dir=rtl" ?>>

	<div id="header">
		
                <div data-role="header" style="overflow:hidden;" data-theme="e">
    <h1>טקסי-לייזר</h1>
    <div data-role="navbar" style="text-align: right">
        <ul>
            <li><a href="#">דוחות</a></li>
            <!--<li><a href="../ride/create">נסיעות</a></li> -->
            <li><?php echo CHtml::link('נסיעות',$this->createAbsoluteUrl('ride/create')); ?></li>
            
            
            
        </ul>
    </div><!-- /navbar -->
</div><!-- /header -->
	</div><!-- header -->
        <div data-role="content">   
	<?php echo $content; ?>
        </div>
	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

