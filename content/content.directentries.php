<?php


	require_once(TOOLKIT . '/class.administrationpage.php');

	class contentExtensionRelation_fieldDirectEntries extends AdministrationPage {

		public function view() {
			$keywords = Mysql::cleanValue($_REQUEST['keywords']);
			$page     = Mysql::cleanValue($_REQUEST['page']);
			$per_page = Mysql::cleanValue($_REQUEST['per-page']);
			$field_id = Mysql::cleanValue($_REQUEST['field-id']);

			/** @var FieldRelation $field */
//			$field = FieldManager::fetch($field_id);

			// must be correct field instance
//			if ($field instanceof FieldRelation === false) {
//				$this->returnResult(array(0));
//			}

			list($where, $join) = $this->applyKeywordFilter($keywords);

			$section_id = SectionManager::fetchIDFromHandle('images');
//			$section_id = $field->get('parent_section');

			$entries = EntryManager::fetchByPage(
			                       $page,
			                       $section_id,
			                       $per_page === 'all' ? null : $per_page,
			                       $where,
			                       $join,
			                       false,
			                       false,
			                       true,
			                       array('title', 'image', 'caption')
			);

			print_r($entries);

			$this->returnResult($entries);

			echo 1;
			die;
		}

		private function applyKeywordFilter($keywords) {
			$where = '';
			$join  = '';

			return array($where, $join);
		}

		private function returnResult($result) {
			echo json_encode($result);
			exit;
		}
	}
