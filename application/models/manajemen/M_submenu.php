<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : M_submenu.php
 *  File Type             : Model
 *  File Package          : CI_Models
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 21/05/2022
 *  Quots of the code     : 'sebuah code program bukanlah sebatas perintah-perintah yang ditulis di komputer, melainkan sebuah kesempatan berkomunikasi antara komputer dan manusia. (bagi yang tidak punya teman wkwk)'
 */
class M_submenu extends CI_Model
{
    function getData($where = null)
    {
        $this->db->select('*');
        $this->db->from('m_submenu');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('id_menu', 'DESC');
        $this->db->order_by('nama_submenu', 'ASC');
        return $this->db->get();
    }

    public function insertData($data)
    {
        return $this->db->insert('m_submenu', $data);
    }

    function updateData($data, $where)
    {
        $this->db->update('m_submenu', $data, $where);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteData($where)
    {
        $this->db->where($where);
        $this->db->delete('m_submenu');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
