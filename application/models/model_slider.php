<?php
defined('BASEPATH') or exit('No direct script access allowed');
class model_slider extends CI_Model
{
    var $table = 'slider';
    //manajemen buku
    public function getslider()
    {
        return $this->db->get_where($this->table, array('is_active' => 1))->result_array();
    }
    public function bukuWhere($where)
    {
        return $this->db->get_where('user', $where);
    }
    public function add($data = null)
    {
        $this->db->insert($this->table, $data);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, array('is_active' => 0));
    }
    public function hapusBuku($where = null)
    {
        $this->db->delete('user', $where);
    }
    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from($this->table);
        return $this->db->get()->row($field);
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }
    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }
    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }
    public function hapusKategori($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('buku');
    }
    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }
    //join
    public function joinKategoriBuku($where)
    {
        $this->db->select('buku.id_kategori,kategori.kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id = buku.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
}
