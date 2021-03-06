<?php

class RideController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
                        array('auth.filters.AuthFilter'),
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','rideStart','updateAmount','newRide','updateDestination'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Ride;
                
                $sources = Source::model()->findAll();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		/*if(isset($_POST['Ride']))
		{
			$model->attributes=$_POST['Ride'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}*/
                
                if (isset($_SESSION['currentRideId']))
                {
                    $id = $_SESSION['currentRideId'];
                    $model=$this->loadModel($id);
                }
                
		$this->render('create',array(
			'model'=>$model,'sources'=>$sources,
		));
	}
        
        
        public function actionRideStart()
        {
            if (Yii::app()->request->isAjaxRequest)
            {
                $lat = isset($_POST['lat']) ? $_POST['lat'] : 0.0;
                $lon = isset($_POST['lon']) ? $_POST['lon'] : 0.0;
                $model=new Ride;
                
                $model->source_id = $_POST['source_id'];
                $model->start_time = $_POST['currentTime'];
                $model->user_id = Yii::app()->user->id;
                $model->origin_lat = isset($_POST['lat']) ? $_POST['lat'] : 0.0;
                $model->origin_lon = isset($_POST['lon']) ? $_POST['lon'] : 0.0;
                
                //$model->origin_address = $model->getGoogleAddressByLatLon($model->origin_lat, $model->origin_lon);
                
                //isset($_POST['address']) ? $_POST['address'] : "";
                
                if($model->save())
                {
                    Yii::app()->session['currentRideId'] = $model->id;
                  
                    $date = new DateTime($model->start_time);
                    echo "<b><p> הנסיעה החלה ב: ". date_format($date, 'H:i d/m/Y')."</p></b>";
                }
                else{
                    echo "error";
                }
                
            }
        }
        
        public function actionNewRide()
        {
            if (Yii::app()->request->isAjaxRequest)
            {
                unset(Yii::app()->session['currentRideId']);
            }
            
        }
        
        public function actionUpdateAmount()
        {
            if (Yii::app()->request->isAjaxRequest)
            {
                $id = Yii::app()->session['currentRideId'];
                
                $model=$this->loadModel($id);
                
                $model->amount = $_POST['amount'];
                
                if($model->save())
                {
                    unset(Yii::app()->session['currentRideId']);
                    //echo true;
                }
                /*
                elseif($model->hasErrors())
                {
                    echo CHtml::errorSummary($model);
                }*/
                
            }
        }
        
        public function actionUpdateDestination()
        {
            if (Yii::app()->request->isAjaxRequest)
            {
                $id = Yii::app()->session['currentRideId'];
                
                $model=$this->loadModel($id);
                
                $model->destination_address = $_POST['destinationAddress'];
                
                if($model->save())
                {
                    //unset(Yii::app()->session['currentRideId']);
                    echo true;
                }
                
                else
                {
                    echo false;
                }
                
            }
        }

        /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ride']))
		{
			$model->attributes=$_POST['Ride'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Ride');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ride('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ride']))
			$model->attributes=$_GET['Ride'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Ride::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ride-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
}
