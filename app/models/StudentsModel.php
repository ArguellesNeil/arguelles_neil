<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: StudentsModel
 */
class StudentsModel extends Model 
{
    /**
     * Table associated with the model.
     * @var string
     */
    protected $table = 'students';

    /**
     * Primary key of the table.
     * @var string
     */
    protected $primary_key = 'id';

    /**
     * Soft delete column (optional).
     * @var string
     */
    protected $deleted = 'deleted_at';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Count all active (non-deleted) records, with optional search filter
     * 
     * @param string|null $search
     * @return int
     */
    public function count_all_records($search = "")
    {
        $sql = "SELECT COUNT({$this->primary_key}) as total 
                FROM {$this->table} 
                WHERE {$this->deleted} IS NULL";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (fname LIKE ? OR lname LIKE ? OR email LIKE ?)";
            $params[] = "%{$search}%";
            $params[] = "%{$search}%";
            $params[] = "%{$search}%";
        }

        $result = $this->db->raw($sql, $params);

        foreach($result as $row):
             return $row;
             endforeach;
    }

    /**
     * Get paginated records with optional search filter
     * 
     * @param string $limit_clause 
     * @param string|null $search
     * @return array
     */
    public function get_records_with_pagination($limit_clause, $search = null)
    {
        $sql = "SELECT {$this->primary_key}, fname, lname, email 
                FROM {$this->table} 
                WHERE {$this->deleted} IS NULL";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (fname LIKE ? OR lname LIKE ? OR email LIKE ?)";
            $params[] = "%{$search}%";
            $params[] = "%{$search}%";
            $params[] = "%{$search}%";
        }

        $sql .= " ORDER BY {$this->primary_key} DESC {$limit_clause}";

        $result = $this->db->raw($sql, $params);

        return $result ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
