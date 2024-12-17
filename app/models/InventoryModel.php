<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: MODEL/INVENTORYMODEL.PHP ::://

class InventoryModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_all_inventory_items() {
        return $this->db->table('inventory')->get()->getResultArray();
    }

    public function get_inventory_item_by_id($id) {
        return $this->db->table('inventory')->where('id', $id)->get()->getRowArray();
    }

    public function add_inventory_item($data) {
        return $this->db->table('inventory')->insert($data);
    }

    public function update_inventory_item($id, $data) {
        return $this->db->table('inventory')->where('id', $id)->update($data);
    }

    public function delete_inventory_item($id) {
        return $this->db->table('inventory')->where('id', $id)->delete();
    }
}
?>
