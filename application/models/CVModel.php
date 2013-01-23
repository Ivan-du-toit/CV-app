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
			$occupations[$index]->projects = $this->loadOccupationRelatedProjects($occupation->id);
		}
        return $occupations;
        
	}
	
	public function loadOccupation($occupationID) {
		$query = $this->db->get_where('occupation', array('id' => $occupationID));
		$occupations = $query->result();
		foreach ($occupations as $index => $occupation) {
			$occupations[$index]->related = $this->loadOccupationRelatedCategories($occupation->id);
			$occupations[$index]->projects = $this->loadOccupationRelatedProjects($occupation->id);
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
			$meta->projects = $this->loadMetaProject($meta->id);
		}
		return $metaData;
	}
	
	public function loadMetaProject($metaID) {
		$query = $this->db->query("SELECT project.name, project.id FROM project
			LEFT JOIN project_meta on project.id = project_meta.project
			WHERE project_meta.meta = {$this->db->escape($metaID)}");
		return $query->result();
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
	
	public function search($term) {
		$safeTerm = $this->db->escape('%'.$term.'%');
		$result = array();
                $result['occupation'] = $this->occupationSearch($safeTerm);
		$result['project'] = $this->projectSearch($safeTerm);
		$result['meta'] = $this->metaSearch($safeTerm);
		return $result;
	}
	
	private function occupationSearch($term) {
		$query = $this->db->query("SELECT * FROM occupation WHERE name LIKE {$term} OR description LIKE {$term}");
		$occupationData = $query->result();
		foreach ($occupationData as $occupation) {
			$occupation->related = $this->loadOccupationRelatedCategories($occupation->id);
		}
		return $occupationData;
	}
	
	private function projectSearch($term) {
		$query = $this->db->query("SELECT * FROM project WHERE name LIKE {$term} OR description LIKE {$term}");
		$projectData = $query->result();
		foreach ($projectData as $project) {
			$project->related = $this->loadProjectRelatedCategories($project->id);
		}
		return $projectData;
	}
	
	private function metaSearch($term) {
		$query = $this->db->query("SELECT * FROM meta WHERE name LIKE {$term} OR description LIKE {$term}");
		$metaData = $query->result();
		foreach ($metaData as $meta) {
			$meta->related = $this->loadMetaRelatedCategories($meta->id);
		}
		return $metaData;
	}
        
    public function loadProjectRelatedCategories($projectID) {
		$query = $this->db->query("SELECT category.category as name, category.id as id FROM category 
			LEFT JOIN meta_category on meta_category.category = category.id
			LEFT JOIN meta on meta.id = meta_category.meta
			LEFT JOIN project_meta on meta.id = project_meta.meta
			LEFT JOIN project on project.id = project_meta.project
			WHERE project.id = {$this->db->escape($projectID)} GROUP BY name");
		return $query->result();
	}
        
	public function loadProjects() {
		$query = $this->db->get('project');
		$projects = $query->result();
		foreach ($projects as $index => $project) {
			$projects[$index]->related = $this->loadProjectRelatedCategories($project->id);
			$projects[$index]->occupation = $this->loadProjectOccupations($project->id);
		}
        return $projects;
	}
	
	public function loadProject($projectID) {
		$query = $this->db->get_where('project', array('id' => $projectID));
		$projects = $query->result();
		foreach ($projects as $index => $project) {
			$projects[$index]->related = $this->loadProjectRelatedCategories($project->id);
			$projects[$index]->occupation = $this->loadProjectOccupations($project->id);
			var_dump($projects[$index]->occupation);
		}
        return $projects;
	}
	
	public function loadProjectOccupations($projectID) {
		$query = $this->db->query("SELECT occupation.name, occupation.description, occupation.id FROM project
			LEFT JOIN project_occupation on project.id = project_occupation.project
			LEFT JOIN occupation on occupation.id = project_occupation.occupation
			WHERE project.id = {$this->db->escape($projectID)}");
			$occupation = $query->result();
		if ($occupation[0] == null || $occupation[0]->id == null)
			return null;
		return $occupation;
	}
	
	public function loadProjectMetaCategory($projectID, $categoryID) {
		$query = $this->db->query("SELECT meta.id, meta.name, meta.description, category.category, category.id as catID FROM project
			LEFT JOIN project_meta on project.id = project_meta.project
			LEFT JOIN meta on project_meta.meta = meta.id
			LEFT JOIN meta_category on meta_category.meta = meta.id
			LEFT JOIN category on meta_category.category = category.id
			WHERE project.id = {$this->db->escape($projectID)} and category.id = {$this->db->escape($categoryID)}");
		$metaData = $query->result();
		foreach ($metaData as $meta) {
			$meta->related = $this->loadMetaRelatedCategories($meta->id);
		}
		return $metaData;
	}
	
	public function loadOccupationRelatedProjects($occupationID) {
		$query = $this->db->query("SELECT project.name, project.id, project.description FROM project
			LEFT JOIN project_occupation on project.id = project_occupation.project
			LEFT JOIN occupation on occupation.id = project_occupation.occupation
			WHERE occupation.id = {$this->db->escape($occupationID)}");
		return $query->result();
	}
}

?>
