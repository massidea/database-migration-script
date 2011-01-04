<?php
class Content extends AppModel {
	var $name = 'Content';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'CampaignsHasContent' => array(
			'className' => 'CampaignsHasContent',
			'joinTable' => 'campaigns_has_contents',
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'campaigns_has_content_id',
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
		'ContentsHasComment' => array(
			'className' => 'ContentsHasComment',
			'joinTable' => 'contents_has_comments',
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'content_has_comment_id',
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
		'ContentsHasContent' => array(
			'className' => 'ContentsHasContent',
			'joinTable' => 'contents_has_contents',
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'content_has_content_id',
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
		'ContentsHasFile' => array(
			'className' => 'ContentsHasFile',
			'joinTable' => 'contents_has_files',
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'content_has_file_id',
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
		'ContentsHasFlag' => array(
			'className' => 'ContentsHasFlag',
			'joinTable' => 'contents_has_flags',
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'content_has_flag_id',
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
		'ContentsHasRating' => array(
			'className' => 'ContentsHasRating',
			'joinTable' => 'contents_has_ratings',
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'content_has_rating_id',
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
		'ContentsHasRelatedCompany' => array(
			'className' => 'ContentsHasRelatedCompany',
			'joinTable' => 'contents_has_related_companies',
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'content_has_related_company_id',
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
		'ContentsHasStat' => array(
			'className' => 'ContentsHasStat',
			'joinTable' => 'contents_has_stats',
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'content_has_stat_id',
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
		'ContentsHasTag' => array(
			'className' => 'ContentsHasTag',
			'joinTable' => 'contents_has_tags',
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'content_has_tag_id',
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
			'foreignKey' => 'content_id',
			'associationForeignKey' => 'content_has_user_id',
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
