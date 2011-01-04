<?php
class Campaign extends AppModel {
	var $name = 'Campaign';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'CampaignsHasCampaign' => array(
			'className' => 'CampaignsHasCampaign',
			'joinTable' => 'campaigns_has_campaigns',
			'foreignKey' => 'campaign_id',
			'associationForeignKey' => 'has_campaign_id',
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
		'CampaignsHasComment' => array(
			'className' => 'CampaignsHasComment',
			'joinTable' => 'campaigns_has_comments',
			'foreignKey' => 'campaign_id',
			'associationForeignKey' => 'has_comment_id',
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
		'CampaignsHasContent' => array(
			'className' => 'CampaignsHasContent',
			'joinTable' => 'campaigns_has_contents',
			'foreignKey' => 'campaign_id',
			'associationForeignKey' => 'has_content_id',
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
		'CampaignsHasFile' => array(
			'className' => 'CampaignsHasFile',
			'joinTable' => 'campaigns_has_files',
			'foreignKey' => 'campaign_id',
			'associationForeignKey' => 'has_file_id',
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
		'CampaignsHasFlag' => array(
			'className' => 'CampaignsHasFlag',
			'joinTable' => 'campaigns_has_flags',
			'foreignKey' => 'campaign_id',
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
		'CampaignsHasProfile' => array(
			'className' => 'CampaignsHasProfile',
			'joinTable' => 'campaigns_has_profiles',
			'foreignKey' => 'campaign_id',
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
		),
		'CampaignsHasTag' => array(
			'className' => 'CampaignsHasTag',
			'joinTable' => 'campaigns_has_tags',
			'foreignKey' => 'campaign_id',
			'associationForeignKey' => 'has_tag_id',
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
		'GroupsHasCampaigns' => array(
			'className' => 'GroupsHasCampaigns',
			'joinTable' => 'groups_has_campaigns',
			'foreignKey' => 'campaign_id',
			'associationForeignKey' => 'groups_ha_id',
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
