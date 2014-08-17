<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Custom Model
*
* Author:  Stephanus Yanaputra
*          stephanus@preschem.com
*
* Created:  16.08.2013
*
* Description:  Custom Model
*
*/

class MY_Model extends CI_Model
{
	protected $db_table_name;
	protected $db_primary_key;
	
	/**
	 * Default Constructor
	 **/
	function __construct()
    {
        parent::__construct();
    }
	
	/**
	 * Check whether a record exists
	 *
	 * @var array of where
	 **/
	function check_exist($where = array()) 
	{
		$query = $this->db->get_where($this->db_table_name, $where);
        $count = $query->num_rows();
		return ($count > 0) ? TRUE : FALSE;
	}
	
	/**
	 * Check whether a record exists by primary key
	 *
	 * @var array of where
	 **/
	function check_exist_by_primary_key($primary_key = NULL) 
	{
		if($primary_key != NULL)
		{
			$query = $this->db->get_where($this->db_table_name, array($this->db_primary_key => $primary_key));
			$count = $query->num_rows();
			return ($count > 0) ? TRUE : FALSE;
		}
		return NULL;
	}
	
	/**
	 * Count the amount of data
	 *
	 * @var array of data
	 **/
	function get_total($where = array())
    {
		if(sizeof($where) > 0)
		{
			foreach($where as $key => $value)
			{
				$this->db->where($key, $value);
			}
		}
		
		return $this->db->count_all_results($this->db_table_name);
    }
	
	/**
	 * Get the last amount of entries of data
	 *
	 * @var int
	 **/
	function get_entries($amount = -1, $where = array(), $order_by = array(), $offset = 0)
    {
		if(sizeof($where) > 0)
		{
			foreach($where as $key => $value)
			{
				$this->db->where($key, $value);
			}
		}
		
		if(sizeof($order_by) > 0)
		{
			foreach($order_by as $key => $value)
			{
				$this->db->order_by($key, $value);
			}
		}
		
		if($amount > 0)
		{
			if($offset != NULL && $offset > 0)
			{
				$this->db->limit($amount, $offset);
			}
			else
			{
				$this->db->limit($amount);
			}
		}
		
		$query = $this->db->get($this->db_table_name);
		
        return $query->result();
    }
	
	/**
	 * Get the all the data from database
	 *
	 * @var int
	 **/
	function get_all()
    {
		$query = $this->db->get($this->db_table_name);
		
		if ($query->num_rows() > 0)
		{
			$data = array();
			foreach($query->result() as $row) {
				array_push($data, $row);
			}
			return $data;
		}
		return array();
    }

	/**
	 * Insert the given data into the database
	 *
	 * @var array of data
	 **/
	function insert($data = NULL)
    {
		if(!is_null($data))
		{
			$this->db->insert($this->db_table_name, $data);
			
			return TRUE;
		}
		return FALSE;
    }
	
	/**
	 * Update data in the database based on the given id
	 *
	 * @var array of data
	 *		int
	 **/
    function update_by_id($data = NULL, $id = 0)
    {
		if(!is_null($data) && $id > 0)
		{
			$this->db->update($this->db_table_name, $data, array($this->db_primary_key => $id));
			return TRUE;
		}
		
		return FALSE;
    }
	
	
	/**
	 * Update data in the database based on the given id
	 *
	 * @var array of data
	 *		int
	 **/
    function update($data = NULL, $where = array())
    {
		if(!is_null($data))
		{
			$this->db->update($this->db_table_name, $data, $where);
			return TRUE;
		}
		
		return FALSE;
    }
	
	/**
	 * Remove data from the database based on the given id
	 *
	 * @var int
	 **/
	function delete_by_id($id = 0)
    {
		if($id > 0)
		{
			$this->db->delete($this->db_table_name, array($this->db_primary_key => $id)); 
			return TRUE;
		}
		
		return FALSE;
    }
	
	/**
	 * Remove data from the database based on the given id
	 *
	 * @var int
	 **/
	function delete($where = array())
    {
		if(sizeof($where) > 0)
		{
			$this->db->delete($this->db_table_name, $where); 
			return TRUE;
		}
		
		return FALSE;
    }
	
	/**
	 * Construct the data into array to be easily read
	 *
	 * @var array of raw data
	 **/
	function __construct_into_array($raw = array(), $target_attr = NULL, $index_key = "")
	{
		if(strlen($index_key) <= 0)
		{
			$index_key = $this->db_primary_key;
		}
		
		$data = array();
		
		if(sizeof($raw) > 0)
		{
			foreach($raw as $val)
			{
				if($target_attr == NULL)
					$data[$val->{$index_key}] = $val;
				else
					$data[$val->{$index_key}] = $val->{$target_attr};
			}
		}
		
		return $data;
	}
}
