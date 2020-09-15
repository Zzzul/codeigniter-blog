<?php

class M_post extends CI_Model
{
    public function getAllData()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('posts')->result();
    }


    public function insertPost($table, $data)
    {
        $this->db->insert($table, $data);
    }


    public function getDetailPost($slug)
    {
        return $this->db->get_where('posts', array('slug' => $slug))->row_array();
    }


    // FUNCTION HAPUS
    public function deletePost($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete('posts', $id);
    }

    public function getById($id)
    {
        return $this->db->get_where('posts', $id)->row();
    }

    public function _deleteImage($id)
    {
        $posts = $this->getById($id);
        $filename = explode(".", $posts->thumbnail)[0];

        // delte old thumbnail
        $delImg = array_map('unlink', glob(FCPATH . "assets/img/$filename.*"));
        $delImg = array_map('unlink', glob(FCPATH . "assets/img/resize/$filename.*"));
        return $delImg;
    }
}
