<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriModel extends CI_Model 
{
	var $table = 'kategori';
	var $active = 1;
	var $column_order = array(null, 'kategori');
    var $column_search = array('kategori'); 
    var $order = array('kategori' => 'asc'); // default order 
	
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query($where = NULL)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if ($where) {
            $this->db->where([$this->table.'.active' => 1]);
        }
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if (isset($_POST['search']['value'])) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    //
    public function get_datatables($start, $where)
    {
        $this->_get_datatables_query($where);
        if (isset($_POST["length"]) && $_POST["length"] != -1)
            $this->db->limit($_POST['length'], $start);
        $query = $this->db->get();
        return $query->result();
    }
    //
    public function count_filtered($where)
    {
        $this->_get_datatables_query($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
    //
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	public function show()
	{
		if ($this->active) {
			$this->db->where([$this->table.'.active' => 1]);	
		}
		return $this->db->get($this->table);
	}
	public function insert($data){
		if ($this->active) {
			$this->db->where([$this->table.'.active' => 1]);	
		}
		return $this->db->insert($this->table, $data);
	}

	public function edit($id, $param = NULL){
		if ($this->active) {
			$this->db->where([$this->table.'.active' => 1]);	
		}
		$this->db->where($id);
		$data = $this->db->get($this->table)->row();
		if ($param == 'fail') {
			if ($data) {
				return $data;
			} else {
				show_404();
			}	
		} else {
			return $data;
		}
	}

	public function where($id){
		if ($this->active) {
			$this->db->where([$this->table.'.active' => 1]);	
		}
		$this->db->where($id);

		return $this->db->get($this->table);
	}

	public function do_edit($data, $id){
		$this->edit($id, 'fail');
		$this->db->where($id);
		return $this->db->update($this->table, $data);
	}
	
	public function delete($id){
		if ($this->active) {
			$this->db->where($id);
			return $this->db->update($this->table, ['active' => 0]);
		}else{
			$this->edit($id, 'fail');
			return $this->db->delete($this->table, $id);
		}
	}
}