<?php

class IndexModel extends BaseModel {

	private $tableName = 'index';

	public function getIndexItems()
	{
		$this->db->select('*');
		$this->db->where(['enabled' => 1]);
		$this->db->from($this->tableName);
		$query = $this->db->get();

		return $query->result();
	}

	public function getMainPhone()
	{
		$this->db->select('text');
		$this->db->where(['object_type' => 'MAIN_PHONE']);
		$this->db->from('contacts');
		$query = $this->db->get();

		return $query->row()->text;
	}

}
