<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Languages' => array(
			'className' => 'Languages',
			'foreignKey' => 'languages_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'CommentsHasUser' => array(
			'className' => 'CommentsHasUser',
			'joinTable' => 'comments_has_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'comments_has_user_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'ContentsHasUser' => array(
			'className' => 'ContentsHasUser',
			'joinTable' => 'contents_has_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'contents_has_user_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'GroupsHasUser' => array(
			'className' => 'GroupsHasUser',
			'joinTable' => 'groups_has_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'groups_has_user_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'UsersHasFlag' => array(
			'className' => 'UsersHasFlag',
			'joinTable' => 'users_has_flags',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'has_flag_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'UsersHasProfile' => array(
			'className' => 'UsersHasProfile',
			'joinTable' => 'users_has_profiles',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'has_profile_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>
