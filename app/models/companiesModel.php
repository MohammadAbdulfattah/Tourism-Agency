<?php
class CompaniesModel
{
    public $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getAllCompanies()
    {
        return $this->db->get('companies');
    }
    public function getCompanyBySpcInfo($conditions = array())
    {
        $sql = '';
        if (!empty($conditions)) {
            for ($i = 0; $i < count($conditions); $i++) {
                $sql .= $conditions[$i];
                for ($j = 0; $j <= $i; $j++) {
                    $sql .= ' AND ';
                    break;
                }
            }
        }
        $sql = rtrim($sql, 'AND ');
        $query = "SELECT * FROM companies WHERE " . $sql;
        return $this->db->rawQuery($query);
    }
    public function addCompany($data)
    {
        return $this->db->insert('companies', $data);
    }
    public function editCompanyByID($data, $id)
    {
        $this->db->Where('id', $id);
        return $this->db->update('companies', $data);
    }
    public function deleteCompany($id)
    {
        $this->db->Where('id', $id);
        $this->db->delete('companies');
    }
}
