<?php


	require_once(TOOLKIT . '/class.administrationpage.php');

	class contentExtensionRelationsDirectEntries extends AdministrationPage {

		public function view() {
			$keywords = Mysql::cleanValue($_REQUEST['keywords']);
			$page     = Mysql::cleanValue($_REQUEST['page']);
			$per_page = Mysql::cleanValue($_REQUEST['per-page']);
			$field_id = Mysql::cleanValue($_REQUEST['field-id']);

			// @todo set correct field
			/** @var FieldRelation $field */
//			$field = FieldManager::fetch($field_id);

			// must be correct field instance
//			if ($field instanceof FieldRelation === false) {
//				$this->returnResult(array(0));
//			}

			// @todo set correct section IDs from Field
			$section_ids = array(
				SectionManager::fetchIDFromHandle('images'),
				SectionManager::fetchIDFromHandle('images')
			);

			$entries = array();

			foreach ($section_ids as $section_id) {

				// @todo set correct related fields
				list($where, $joins) = $this->applyKeywordFilter(
				                            $field_ids = array(
					                            1, // title
					                            2, // image
					                            4, // caption
				                            ),
				                            $keywords
				);

				$entries[$section_id] = EntryManager::fetchByPage(
				                                    $page,
				                                    $section_id,
				                                    $per_page === 'all' ? null : $per_page,
				                                    $where,
				                                    $joins,
				                                    $group = false,
				                                    $record_only = false,
				                                    $build_entries = true,
//								                    @todo set correct schema
				                                    $schema_elements = array('title', 'image', 'caption')
				);
			}

			print_r($entries);

//			$this->returnResult($entries);

			die;
		}

		/**
		 * Applies keywords filters and returns $where and $joins
		 *
		 * @param $field_ids - IDs of targeted fields
		 * @param $keywords  - keywords to search for
		 *
		 * @return array
		 */
		private function applyKeywordFilter($field_ids, $keywords) {
			$where = '';
			$joins = '';

			$filter = array("regexp: $keywords");

			foreach ($field_ids as $field_id) {
				/** @var Field $field */
				$field = FieldManager::fetch($field_id);

				if (method_exists($field, 'buildDSRetrievalSQL')) {
					$field->buildDSRetrievalSQL($filter, $joins, $where_field, false);
				}
				else {
					$field->buildDSRetrivalSQL($filter, $joins, $where_field, false);
				}

				// replace all ANDs with ORs
				$where_field = preg_replace('/^AND/', 'OR', trim($where_field));
				$where_field = preg_replace('/\) *AND *\(/', ') OR (', trim($where_field));

				$where .= ' ' . $where_field;
			}

			// make this whole thing required
			$where = preg_replace('/^OR/', 'AND (', trim($where)) . ')';

			return array($where, $joins);
		}

		private function returnResult($result) {
			echo json_encode($result);
			exit;
		}
	}
