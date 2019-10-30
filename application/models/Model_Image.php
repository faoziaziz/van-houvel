<?php
Class Model_Image extends CI_Model{
	public $table ="Image";
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('SeqNum',$id);
		$query = $this->db->get();
		
		return $query->row();
	}
	
	public function updateTeks($where, $data)
	{
		
		$this->db->update('Teks', $data, $where);
		return $this->db->affected_rows();
	}

}
