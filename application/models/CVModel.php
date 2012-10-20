<?php
class CVModel extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	public function loadOccupations() {
		$query = $this->db->get('occupation');
		$occupations = $query->result();
		foreach ($occupations as $index => $occupation) {
			$occupations[$index]->related = $this->loadOccupationRelatedCategories($occupation->id);
		}
        return $occupations;
        
	}
	
	public function loadOccupation($occupationID) {
		$query = $this->db->get_where('occupation', array('id' => $occupationID));
		$occupations = $query->result();
		foreach ($occupations as $index => $occupation) {
			$occupations[$index]->related = $this->loadOccupationRelatedCategories($occupation->id);
		}
        return $occupations;
        
	}
	
	public function loadMetaCategory($category) {
		$query = $this->db->query("SELECT meta.name, meta.description, meta.id, category.category,  category.id as catID  FROM meta 
			LEFT JOIN meta_category on meta.id = meta_category.meta
			LEFT JOIN category on meta_category.category = category.id
			WHERE category.category = {$this->db->escape($category)}");
		$metaData = $query->result();
		foreach ($metaData as $meta) {
			$meta->related = $this->loadMetaRelatedCategories($meta->id);
			$meta->occupations = $this->loadMetaOccupation($meta->id);
		}
		return $metaData;
	}
	
	public function loadMetaOccupation($metaID) {
		$query = $this->db->query("SELECT occupation.name, occupation.id FROM occupation
			LEFT JOIN occupation_meta on occupation.id = occupation_meta.occupation
			WHERE occupation_meta.meta = {$this->db->escape($metaID)}");
		return $query->result();
	}
	
	public function loadOccupationRelatedCategories($occupationID) {
		$query = $this->db->query("SELECT category.category as name, category.id as id FROM category 
			LEFT JOIN meta_category on meta_category.category = category.id
			LEFT JOIN meta on meta.id = meta_category.meta
			LEFT JOIN occupation_meta on meta.id = occupation_meta.meta
			LEFT JOIN occupation on occupation.id = occupation_meta.occupation
			WHERE occupation.id = {$this->db->escape($occupationID)} GROUP BY name");
		return $query->result();
	}
	
	public function loadMetaRelatedCategories($metaID) {
		$query = $this->db->query("SELECT category.category as name, category.id as id FROM category
			LEFT JOIN meta_category on category.id = meta_category.category
			LEFT JOIN meta on meta.id = meta_category.meta
			WHERE meta.id = {$this->db->escape($metaID)}");
		return $query->result();
	}
	
	public function loadCategory($categoryID) {
		$query = $this->db->query("SELECT meta.name, meta.id as id, category.category, meta.description FROM meta 
			LEFT JOIN meta_category on meta_category.meta = meta.id
			LEFT JOIN category on meta_category.category = category.id
			WHERE category.id = {$this->db->escape($categoryID)}");
		$metaData = $query->result();
		foreach ($metaData as $meta) {
			$meta->related = $this->loadMetaRelatedCategories($meta->id);
			$meta->occupations = $this->loadMetaOccupation($meta->id);
		}
		return $metaData;
	}
	
	public function loadOccupationMetaCategory($occupationID, $categoryID) {
		$query = $this->db->query("SELECT meta.id, meta.name, meta.description, category.category, category.id as catID FROM occupation
			LEFT JOIN occupation_meta on occupation.id = occupation_meta.occupation
			LEFT JOIN meta on occupation_meta.meta = meta.id
			LEFT JOIN meta_category on meta_category.meta = meta.id
			LEFT JOIN category on meta_category.category = category.id
			WHERE occupation.id = {$this->db->escape($occupationID)} and category.id = {$this->db->escape($categoryID)}");
		$metaData = $query->result();
		foreach ($metaData as $meta) {
			$meta->related = $this->loadMetaRelatedCategories($meta->id);
		}
		return $metaData;
	}
}

?>
