<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : M_buku.php
 *  File Type             : Model
 *  File Package          : CI_Models
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 28/08/2022
 *  Quots of the code     : 'sebuah code program bukanlah sebatas perintah-perintah yang ditulis di komputer, melainkan sebuah kesempatan berkomunikasi antara komputer dan manusia. (bagi yang tidak punya teman wkwk)'
 */
class M_buku extends CI_Model
{
    private $_table = 'm_buku';
    private $_field = '*';
    private $_limit = 10;
    private $_offset;
    private $_join_tbl = null;

    public function getMaxId()
    {
        $this->db->select_max('id_buku');
        $this->db->from($this->_table);
        return $this->db->get();
    }

    public function getData($data = null)
    {
        if (isset($data['field'])) {
            $this->_field = $data['field'];
        }
        $this->db->select($this->_field);
        $this->db->from($this->_table);
        if (isset($data['join_tbl'])) {
            foreach ($data['join_tbl'] as $key => $value) {
                $this->db->join($value['table'], $value['on'], $value['join_type']);
            }
        }
        if (isset($data['where'])) {
            $this->db->where($data['where']);
        }
        if (isset($data['limit']) && isset($data['offset'])) {
            $this->db->limit($data['limit'], $data['offset']);
        } elseif (isset($data['limit'])) {
            $this->db->limit($data['limit']);
        } elseif (isset($data['offset'])) {
            $this->db->limit($this->_limit, $data['offset']);
        }
        $this->db->order_by('id_buku', 'DESC');
        return $this->db->get();
    }

    function updateData($data, $where)
    {
        $this->db->update($this->_table, $data, $where);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getBukuById($where)
    {
        $this->db->select($this->_field);
        $this->db->from($this->_table);
        $this->db->where($where);
        return $this->db->get();
    }

    public function getCount()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        return $this->db->get()->num_rows();
    }

    // insert data
    public function insert_data($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function deleteData($where, $table = null)
    {
        $this->db->where($where);
        if ($table == null) {
            $this->db->delete($this->_table);
        } else {
            $this->db->delete($table);
        }
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getDataKategori($where = null)
    {
        $this->db->select('*');
        $this->db->from('m_kategori_buku');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function deleteKategori($where)
    {
        $this->db->where($where);
        $this->db->delete('m_kategori_buku');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
