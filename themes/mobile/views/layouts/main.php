<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<meta name="language" content="he" /> -->
        
        <?php Yii::app()->clientScript->registerCssFile("http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css"); ?>
        <?php Yii::app()->clientScript->registerScriptFile("http://code.jquery.com/jquery-1.9.1.min.js"); ?>
        <?php Yii::app()->clientScript->registerScriptFile("http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"); ?>
        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

    <div class="container" id="page" <?php if (Yii::app()->language == 'he' || 'he_il') echo "dir=rtl" ?>>

	<div id="header">
		
                <div data-role="header" style="overflow:hidden;" data-theme="e">
    <h1>מונית בקליק</h1>
    <div data-role="navbar" style="text-align: right">
        <ul>
            <li><a href="#">דוחות</a></li>
            <li><a href="index.php/ride/create">נסיעות</a></li>
            
            
        </ul>
    </div><!-- /navbar -->
</div><!-- /header -->
	</div><!-- header -->
        
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
