<?php

class Fos1_model extends CI_Model

{
	var $table = 'foswork';
	public function customer($data)
	{
		$this->db->insert("foswork",$data);
	}

	public function get_customer($date1){
		$this->db->from($this->table);
		$this->db->where('date',$date1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_fos(){
		$this->db->from('fos');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function customer_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	public function get_report1($date1 , $date2 ){
		$this->db->where('date >=', $date1);
		$this->db->where('date <=', $date2);
    	// $this->db->where('status',1);
    	$result = $this->db->get('foswork');
    	return $result->result();
	}
	public function get_autocomplete_results($search_term) { 
        $this->db->SELECT('id,name'); 
        $this->db->like('name',$search_term); 
        $query = $this->db->get('fos'); 
        return $query->result(); 
    }

}