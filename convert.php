<?php

	$debug = $argv[1] === "debug" ? true : false;
	define('DEBUG', $debug);
	
	define(CAMPAIGNS_ADD,1000);
	define(CONTENTS_ADD,2000);
	define(COMMENTS_ADD,3000);
	define(GROUPS_ADD,4000);
	define(TAGS_ADD,5000);
	define(FILES_ADD,6000);
	define(FLAGS_ADD,7000);

	require_once('content_externals.php');

	mysql_connect('localhost', 'oibs', '');
	mysql_select_db('oibs');

	languages();
	country();
	users();
	profiles();
	contents();
	tags();
	groups();
	campaigns();
	comments();

	function insert($table, $params) {

		$keys = array_keys($params[0]);		

		$idx = 0;
		foreach ($keys as $k) {
			$keys[$idx++] = '`' . $k . '`';
		}

		foreach ($params as $p) {
			$values = null;
			foreach ($p as $v) {
				if($v == null) {
					$v = 'null';
					$values[] = $v;
					continue;
				}

				if (!is_numeric($v))
					$v = '\'' . $v . '\'';
					$values[] = $v;
			}

			$k = implode(',', $keys);
			$v = implode(',', $values);

			mysql_set_charset('utf8');
			$q = "replace into `massidea`.`$table` ($k) values ($v)";
			if (DEBUG) 
				var_dump($q);

			mysql_query($q);
		}
	}

	function query($table) {
		mysql_set_charset('latin1');
		$q = "select * from `$table`";
		$result = mysql_query($q);

		$rows = array();

		while ($row = mysql_fetch_assoc($result)) {
			$r = null;
			foreach ($row as $k => $v) {
				$r[$k] = $v;
			}			
			$rows[] = $r;
		}
		
		return $rows;
	}

	function languages() {
		$old_lang = query('languages_lng');
		$lang = null;

		foreach ($old_lang as $l) {
			$lang[] = array('id' => $l['iso6391_lng'], 'name' => $l['name_lng']);
		}
		insert('languages', $lang);
	}

	function country() {
		$old_country = query('countries_ctr');
		$ctr = null;

		foreach ($old_country as $c) {
			$ctr[] = array('id' => $c['iso_ctr'], 'name' => $c['printable_name_ctr']);
		}
		insert('country', $ctr);
	}

	function users() {

		$old_users = query('users_usr');
		$usr = null;

		$lang = query('languages_lng');
		$languages = null;
		
		foreach ($lang as $l) {
			$languages[$l['id_lng']] = $l['iso6391_lng'];
		}

		foreach ($old_users as $u) {
			$_usr['id'] = $u['id_usr'];
			$_usr['languages_id'] = $languages[$u['id_lng_usr']];
			$_usr['country_id'] = 'GB';
			$_usr['username'] = $u['login_name_usr'];
			$_usr['password'] = $u['password_usr'];
			$_usr['password_salt'] = $u['password_salt_usr'];
			$_usr['email'] = $u['email_usr'];
			$_usr['name'] = $u['first_name_usr'] . ' ' . $u['surname_usr'];
			$_usr['last_login'] = $u['last_login_usr'];
			$_usr['created'] = $u['created_usr'];
			$_usr['modified'] = $u['modified_usr'];

			$usr[] = $_usr;
		}

		insert('users', $usr);
	
	}

	function profiles() {
		$old_prof = query('usr_profiles_usp');
		$prof = null;
		
		foreach ($old_prof as $p) {
			$prof[] = array('user_id' => $p['id_usr_usp'], 'key' => $p['profile_key_usp'], 'value' => $p['profile_value_usp']);
		}
		insert('profiles', $prof);
	}

	function contents() {
		$types = array(1 => 'vision', 2 => 'idea', 3 => 'challenge');
		$content_creators;

		$creators = query('cnt_has_usr');
		foreach ($creators as $creator) {
			$content_creators[$creator['id_cnt']] = $creator['id_usr'];
		}

		$old_cnt = query('contents_cnt');
		$base = null;
		$contents = null;

		foreach ($old_cnt as $c) {
			$new_id = CONTENTS_ADD + $c['id_cnt'];
			$base[] = array('id' => $new_id, 'type' => 'Content', 'creator' => $content_creators[$c['id_cnt']], 'privileges' => '755');

			$externals = array('solution' => $c['solution_cnt'], 'threat' => $c['threat_cnt'], 'opportunity' => $c['opportunity_cnt']);
			$externals = to_externals($externals);

			$contents[] = array('id' => $new_id, 'type' => 'Content', 'class' => $types[$c['id_cty_cnt']], 
					'language_id' => $c['language_cnt'], 'title' => $c['title_cnt'], 'lead' => $c['lead_cnt'],
					'body' => $c['body_cnt'], 'references' => $c['references_cnt'],
					'published' => $c['published_cnt'], 'created' => $c['created_cnt'],
					'modified' => $c['modified_cnt'], 'data' => $externals );
		}

		insert('baseclasses', $base);
		insert('contents', $contents);

		$old_cnt_has_cnt = query('cnt_has_cnt');

		$cnt_has_cnt = null;
		foreach ($old_cnt_has_cnt as $c) {
			$parent = CONTENTS_ADD + $c['id_parent_cnt'];
			$child = $contents_add + $c['id_child_cnt'];

			$cnt_has_cnt[] = array('from' => $parent, 'to' => $child);
		}

		insert('linked_contents', $cnt_has_cnt);
	}

	function tags() {

		$old_tags = query('tags_tag');
		$base = null;
		$tags = null;

		foreach ($old_tags as $t) {
			$id = TAGS_ADD + $t['id_tag'];
			$base[] = array('id' => $id, 'type' => 'Tag', 'creator' => null, 'privileges' => null);
			$tags[] = array('id' => $id, 'type' => 'Tag', 'name' => $t['name_tag']);
		}

		insert('baseclasses', $base);
		insert('tags', $tags);

	}

	function groups() {
		$old_groups = query('usr_groups_grp');

                $base = null;
                $groups = null;

		$privileges = array(1 => '755', 2 => '751');

		foreach ($old_groups as $g) {
                        $id = GROUPS_ADD + $g['id_grp'];
			$group_type = $g['id_type_grp'];
                        $base[] = array('id' => $id, 'type' => 'Group', 'creator' => null, 'privileges' => $privileges[$group_type]);
                        $groups[] = array('id' => $id, 'type' => 'Group', 'name' => $g['group_name_grp'], 'lead' => $g['description_grp'], 'body' => $g['body_grp'], 'created' => $g['created_grp'], 'modified' => $g['modified_grp']);
                }

		insert('baseclasses', $base);
		insert('groups', $groups);
	}

	function campaigns() {
		$old_cmp = query('campaigns_cmp');

		$base = null;
                $campaigns = null;

                $privileges = array(1 => '755', 2 => '751');

                foreach ($old_cmp as $c) {
                        $id = CAMPAIGNS_ADD + $c['id_cmp'];
			$group_id = $groups_add + $c['id_grp_cmp'];
                        $base[] = array('id' => $id, 'type' => 'Campaign', 'creator' => null, 'privileges' => $privileges[1]);
                        $campaigns[] = array('id' => $id, 'type' => 'Campaign', 'name' => $c['name_cmp'], 'lead' => $c['ingress_cmp'], 'body' => $c['description_cmp'], 'start_time' => $c['start_time_cmp'], 'end_time' => $c['end_time_cmp'], 'created' => $c['created_cmp'], 'modified' => $c['modified_cmp']);
                }

                insert('baseclasses', $base);
                insert('campaigns', $campaigns);

	}

	function comments() {
                $old_comments = query('comments_cmt');

                $base = null;
                $comments = null;

                $privileges = array(1 => '755', 2 => '751');

                foreach ($old_comments as $c) {
                        $id = COMMENTS_ADD + $c['id_cmt'];
                        $base[] = array('id' => $id, 'type' => 'Comment', 'creator' => $c['id_usr_cmp'], 'privileges' => $privileges[1]);
                        $comments[] = array('id' => $id, 'type' => 'Comment', 'comment' => $c['body_cmt']);
                }

                insert('baseclasses', $base);
                insert('comments', $comments);

	}


?>
