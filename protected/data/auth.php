<?php
return array (
  'RBAC Manager' => 
  array (
    'type' => 2,
    'description' => 'Manages Auth Items and Role Assignments. RBAM required role.',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'Auth Items Manager',
      1 => 'Auth Assignments Manager',
    ),
    'assignments' => 
    array (
      'admin' => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
  'Auth Items Manager' => 
  array (
    'type' => 2,
    'description' => 'Manages Auth Items. RBAM required role.',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Auth Assignments Manager' => 
  array (
    'type' => 2,
    'description' => 'Manages Role Assignments. RBAM required role.',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Authenticated' => 
  array (
    'type' => 2,
    'description' => 'Default role for users that are logged in. RBAC default role.',
    'bizRule' => 'return !Yii::app()->getUser()->getIsGuest();',
    'data' => NULL,
  ),
  'Guest' => 
  array (
    'type' => 2,
    'description' => 'Default role for users that are not logged in. RBAC default role.',
    'bizRule' => 'return Yii::app()->getUser()->getIsGuest();',
    'data' => NULL,
  ),
  'Ride' => 
  array (
    'type' => 1,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'Ride:View',
      1 => 'Ride:Create',
      2 => 'Ride:Update',
      3 => 'Ride:Delete',
      4 => 'Ride:Index',
      5 => 'Ride:Admin',
    ),
  ),
  'Ride:View' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Ride:Create' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Ride:Update' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Ride:Delete' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Ride:Index' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Ride:Admin' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Site' => 
  array (
    'type' => 1,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'Site:Captcha',
      1 => 'Site:CCaptchaAction',
      2 => 'Site:Index',
      3 => 'Site:Error',
      4 => 'Site:Contact',
      5 => 'Site:Login',
      6 => 'Site:Logout',
    ),
  ),
  'Site:Captcha' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Site:CCaptchaAction' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Site:Index' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Site:Error' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Site:Contact' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Site:Login' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Site:Logout' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Source' => 
  array (
    'type' => 1,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'Source:View',
      1 => 'Source:Create',
      2 => 'Source:Update',
      3 => 'Source:Delete',
      4 => 'Source:Index',
      5 => 'Source:Admin',
    ),
  ),
  'Source:View' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Source:Create' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Source:Update' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Source:Delete' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Source:Index' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Source:Admin' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'User' => 
  array (
    'type' => 1,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'User:View',
      1 => 'User:Create',
      2 => 'User:Update',
      3 => 'User:Delete',
      4 => 'User:Index',
      5 => 'User:Admin',
    ),
  ),
  'User:View' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'User:Create' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'User:Update' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'User:Delete' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'User:Index' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'User:Admin' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Gii' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'Gii:Default',
    ),
  ),
  'Gii:Default' => 
  array (
    'type' => 1,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'Gii:Default:Index',
      1 => 'Gii:Default:Error',
      2 => 'Gii:Default:Login',
      3 => 'Gii:Default:Logout',
    ),
  ),
  'Gii:Default:Index' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Gii:Default:Error' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Gii:Default:Login' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'Gii:Default:Logout' => 
  array (
    'type' => 0,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'admin' => 
  array (
    'type' => 2,
    'description' => 'admin',
    'bizRule' => '',
    'data' => '',
    'children' => 
    array (
      0 => 'Ride',
      1 => 'Site',
      2 => 'Source',
      3 => 'User',
      4 => 'Gii',
    ),
  ),
);
