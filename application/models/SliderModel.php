<?php

class SliderModel extends BaseModel {

	private $tableName = 'slider';

	public function getSliderImages()
	{
		$this->db->select('*');
		$this->db->where(['is_enabled' => 1]);
		$this->db->from($this->tableName);
		$this->db->order_by('image_order', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}

}
