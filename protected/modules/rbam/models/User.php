<?php
/**
 * User class.
 */
class User extends CActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'tbl_user';
	}
}