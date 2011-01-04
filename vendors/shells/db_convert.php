<?php

class DbConvertShell extends Shell {
	var $uses = array(	'Country', 'CountriesCtr', 
				'Language', 'LanguagesLng', 
				'UsersUsr', 'User',
				'ContentsCnt', 'Content',
				'CntHasUsr', 'CntHasCnt', 'ContentsHasContents',
				'Tag', 'TagsTag',
				'CampaignsCmp', 'Campaign', 'CampaignsHasCampaigns', 'CmpHasCmp', 'CampaignsHasContents', 'CmpHasCnt', 'CmpHasTag'
			  );
	var $languages = array();
	var $countries = array();

	function main() {

//		$this->countries();
//		$this->languages();
//		$this->tags();
//		$this->users();
		$this->contents();
//		$this->campaigns();


	}

	function countries() {
		$old_countries = $this->CountriesCtr->find('all');

		foreach ($old_countries as $country) {
			$id = $country['CountriesCtr']['iso_ctr'];
			$name = $country['CountriesCtr']['printable_name_ctr'];

			$this->countries[] = $id;

			$data = array('id' => $id, 'name' => $name);

			$this->Country->save($data);
		}

		$this->out("Converted countries!");

	}

	function languages() {
		$old_languages = $this->LanguagesLng->find('all');

		foreach ($old_languages as $language) {

			$id = $language['LanguagesLng']['iso6391_lng'];
			$name = $language['LanguagesLng']['name_lng'];

			$this->languages[] = $id;

			$data = array('id' => $id, 'name' => $name);

			$this->Language->save($data);
		}

		$this->out("Converted languages!");
	}

	function tags() {
		$old_tags = $this->TagsTag->find('all');

		foreach ($old_tags as $tag) {
			$tag = $tag['TagsTag'];
			
			$id = $tag['id_tag'];
			$name = $tag['name_tag'];

			$this->Tag->save(array('id' => $id, 'tag' => $name));
		}

		$this->out("Converted tags!");

	}

	function users() {
		$old_users = $this->UsersUsr->find('all');

		foreach ($old_users as $user) {

			$user = $user['UsersUsr'];

			$id = $user['id_usr'];
			$country = $this->countries[0];
			$lang = $this->languages[$user['id_lng_usr']-1];
			$username = $user['login_name_usr'];
			$password = $user['password_usr'];
			$password_salt = $user['password_salt_usr'];
			$email = $user['email_usr'];
			$name = $user['first_name_usr'] . " " . $user['surname_usr'];
			$created = $user['created_usr'];
			$modified = $user['modified_usr'];
			

			$data = array(	'id' => $id,
					'languages_id' => $lang,
                                        'country_id' => $country,
                                        'username' => $username,
                                        'password' => $password,
                                        'password_salt' => $password_salt,
                                        'email' => $email,
                                        'name' => $name,
                                        'created' => $created,
					'modified' => $modified
			);

			$this->User->save($data);

		}

		$this->out("Converted users!");

	}

	function contents() {

		//CONTENT TYPE 1 = future info, 2 = idea, 3 = problem
		$content_type = array(1 => 'vision', 2 => 'idea', 3 => 'challenge');
		$old_contents = $this->ContentsCnt->find('all');

//		var_dump($old_contents);

		foreach ($old_contents as $content) {

			$content = $content['ContentsCnt'];
			$id = $content['id_cnt'];

			$contentHasUser = $this->CntHasUsr->findByIdCnt($id);
			$creator = $contentHasUser['CntHasUsr']['id_usr'];

			$type = $content_type[$content['id_cty_cnt']];
			$title = $content['title_cnt'];
			$lead = $content['lead_cnt'];
			$lang = $content['language_cnt'];
			$body = $content['body_cnt'];
			$references = $content['references_cnt'];
			$published = $content['published_cnt'];


			$data = array(	'id' => $id,
					'creator_id' => $creator,
					'type' => $type,
					'language_id' => $lang,
					'title' => $title,
					'lead' => $lead,
					'body' => $body,
					'references' => $references,
					'published' => $published
				     );

			$this->Content->save($data);
		}

		//Contents - Contents
		$cnt_has_cnt = $this->CntHasCnt->find('all');

		foreach ($cnt_has_cnt as $cnt) {
			$cnt = $cnt['CntHasCnt'];

			$parent_id = $cnt['id_parent_cnt'];
			$child_id = $cnt['id_child_cnt'];

			$this->ContentsHasContents->save(array('contents_parent_id' => $parent_id, 'contents_child_id' => $child_id));
		}



		$this->out("Converted contents!");

	}

	function campaigns() {

		$old_campaigns = $this->CampaignsCmp->find('all');

		foreach ($old_campaigns as $campaign) {
			$c = $campaign['CampaignsCmp'];

			$id = $c['id_cmp'];
			$group = $c['id_grp_cmp'];
			$name = $c['name_cmp'];
			$ingress = $c['ingress_cmp'];
			$description = $c['description_cmp'];
			$start = $c['start_time_cmp'];
			$end = $c['end_time_cmp'];
			$created = $c['created_cmp'];
			$modified = $c['modified_cmp'];

			$data = array(	'id' => $id,
					'name' => $name,
					'lead' => $ingress,
					'body' => $description,
					'start' => $start,
					'end' => $end,
					'created' => $created,
					'modified' => $modified
				     );

			$this->Campaign->save($data);

		}

		//Campaigns - Campaigns
                $cmp_has_cmp = $this->CmpHasCmp->find('all');

                foreach ($cmp_has_cmp as $cmp) {
			$cmp_parent_id = $cmp['CmpHasCmp']['id_parent_cmp'];
                        $cmp_child_id = $cmp['CmpHasCmp']['id_child_cmp'];

			$this->CampaignsHasCampaigns->save(array('campaigns_parent_id' => $cmp_parent_id, 'campaigns_child_id' => $cmp_child_id));
		}

		//Campaigns - Contents
		$cmp_has_cnt = $this->CmpHasCnt->find('all');
		
		foreach ($cmp_has_cnt as $cmp) {
			$cmp_id = $cmp['CmpHasCnt']['id_cmp'];
			$cnt_id = $cmp['CmpHasCnt']['id_cnt'];

			$this->CampaignsHasContents->save(array('campaigns_id' => $cmp_id, 'contents_id' => $cnt_id));
		}

		//Campaigns - Tags
		$cmp_has_tag = $this->CmpHasTag->find('all');

		foreach ($cmp_has_tag as $cmp) {
			$cmp_id = $cmp['CmpHasTag']['id_cmp'];
			$cmp_tag = $cmp['CmpHasTag']['id_tag'];

			$this->CampaignsHasTags->save(array('campaigns_id' => $cmp_id, 'tags_id' => $cmp_id));
		}
		
		$this->out("Converted campaigns!");

	}

}

?>
