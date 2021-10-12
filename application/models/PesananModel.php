<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PesananModel extends CI_Model 
{
	var $table = 'pesanan';
	var $active = NULL;
	var $column_order = array(null, 'kode_pesanan','produk','jumlah');
    var $column_search = array('kode_pesanan','produk','jumlah'); 
    var $order = array('kode_pesanan' => 'asc'); // default order 
	
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query($where = NULL)
    {
        $this->db->select('*, pesanan.id as id');
        $this->db->join('produk', 'produk.id = '.$this->table.'.id_produk');
        $this->db->from($this->table);
        $this->db->where([$this->table.'.status' => 1]);
        if ($where) {
            $this->db->where([$this->table.'.active' => 1]);
        }
        $i = 0;

        foreach ($this->column_search as $item)
        {
            if (isset($_POST['search']['value']))
            {

                if ($i === 0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order']))
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
        $this->db->join('produk', 'produk.id = '.$this->table.'.id_produk');
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
        $this->db->join('produk', 'produk.id = '.$this->table.'.id_produk');
        if ($this->active) {
            $this->db->where([$this->table.'.active' => 1]);    
        }
        $this->db->where($id);

        return $this->db->get($this->table);
    }
    public function whereSum($id){
        $this->db->select('*, sum(pesanan.jumlah) as jumlah');
        $this->db->join('produk', 'produk.id = '.$this->table.'.id_produk');
        if ($this->active) {
            $this->db->where([$this->table.'.active' => 1]);    
        }
        $this->db->where($id);

        return $this->db->get($this->table);
    }

    public function whereGroup($id, $group){
        $this->db->join('produk', 'produk.id = '.$this->table.'.id_produk');
        if ($this->active) {
            $this->db->where([$this->table.'.active' => 1]);    
        }
        $this->db->where($id);
        $this->db->group_by($group);
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