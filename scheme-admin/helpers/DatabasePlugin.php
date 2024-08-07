<?php
class DatabasePlugin {
    private $db;

    public function __construct() {
        // Initialize a database connection
        $this->db = new mysqli("localhost", "root", "admin123", "gsrf");
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // CRUD: Create
    public function createRecord($table, $data) {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";

        $query = "INSERT INTO $table ($columns) VALUES ($values)";

        if ($this->db->query($query) === TRUE) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $this->db->error;
            return false;
        }
    }


    public function getRecords($table) {
        // Build the SELECT query with optional search and sorting
        $query = "SELECT * FROM $table";

        $result = $this->db->query($query);

        $records = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        }
        return $records;
    }


    // CRUD: Read with Search and Sorting
    public function getRecordsWithFilter($table, $page, $perPage, $searchTerm = null, $sortBy = null, $sortOrder = 'ASC', $searchColumns = array()) {
        // Calculate offset for pagination
        $offset = ($page - 1) * $perPage;

        // Build the SELECT query with optional search and sorting
        $query = "SELECT * FROM $table";

        if ($searchTerm !== null && !empty($searchColumns)) {
            $searchTerm = $this->db->real_escape_string($searchTerm);
            $searchConditions = array();
            foreach ($searchColumns as $column) {
                $searchConditions[] = "$column LIKE '%$searchTerm%'";
            }
            $searchCondition = implode(" OR ", $searchConditions);
            $query .= " WHERE $searchCondition";
        }

        if ($sortBy !== null && in_array($sortBy, $searchColumns)) {
            $sortOrder = strtoupper($sortOrder) == 'DESC' ? 'DESC' : 'ASC';
            $query .= " ORDER BY $sortBy $sortOrder";
        } else {
            // Handle the case when $sortBy is not a valid column name or empty
            // For example, you could provide a default sorting column and order here.
            // $query .= " ORDER BY default_column ASC";
        }

        $query .= " LIMIT $perPage OFFSET $offset";

        $result = $this->db->query($query);

        $records = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        }

        return $records;
    }


    public function getNumberOfSearchedRecords($table, $searchTerm = null, $sortBy = null, $sortOrder = 'ASC', $searchColumns = array()) {
        // Calculate offset for pagination

        // Build the SELECT query with optional search and sorting
        $query = "SELECT * FROM $table";

        if ($searchTerm !== null && !empty($searchColumns)) {
            $searchTerm = $this->db->real_escape_string($searchTerm);
            $searchConditions = array();
            foreach ($searchColumns as $column) {
                $searchConditions[] = "$column LIKE '%$searchTerm%'";
            }
            $searchCondition = implode(" OR ", $searchConditions);
            $query .= " WHERE $searchCondition";
        }

        if ($sortBy !== null && in_array($sortBy, $searchColumns)) {
            $sortOrder = strtoupper($sortOrder) == 'DESC' ? 'DESC' : 'ASC';
            $query .= " ORDER BY $sortBy $sortOrder";
        } else {
            // Handle the case when $sortBy is not a valid column name or empty
            // For example, you could provide a default sorting column and order here.
            // $query .= " ORDER BY default_column ASC";
        }

        $result = $this->db->query($query);

        $records = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        }

        return $records;
    }

    // ... (Other CRUD methods)

    // Generate pagination links without encoding sortBy and sortOrder
    public function generatePaginationLinks($table, $page, $perPage, $searchTerm = null, $sortBy = null, $sortOrder = 'ASC', $searchColumns = array()) {
        $currentPage = $page;
        $totalRecords = $this->getNumberOfSearchedRecords($table,$searchTerm, $sortBy, $sortOrder, $searchColumns);
        $totalPages = ceil(count($totalRecords) / $perPage);

        $pagination = '<ul class="pagination custom-pagination">'; // Custom CSS class

        // Create "Previous" link with custom style
        if ($currentPage > 1) {
            $prevPage = $currentPage - 1;
            $pagination .= '<li class="page-item"><a class="page-link" href="?page=' . $prevPage . '&search=' . $searchTerm . '&sort=' . $sortBy . '&order=' . $sortOrder . '">Previous</a></li>';
        }

        // Calculate range of visible page links
        $numVisibleLinks = 5; // Adjust this number as needed
        $halfRange = floor($numVisibleLinks / 2);

        $startPage = max(1, $currentPage - $halfRange);
        $endPage = min($totalPages, $currentPage + $halfRange);

        // Create "First" link with ellipsis
        if ($startPage > 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="?page=1&search=' . $searchTerm . '&sort=' . $sortBy . '&order=' . $sortOrder . '">1</a></li>';
            if ($startPage > 2) {
                $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        // Create individual page links with ellipsis
        for ($i = $startPage; $i <= $endPage; $i++) {
            $activeClass = ($i == $currentPage) ? 'active' : ''; // Custom CSS class for the current page
            $pagination .= '<li class="page-item ' . $activeClass . '"><a class="page-link" href="?page=' . $i . '&search=' . $searchTerm . '&sort=' . $sortBy . '&order=' . $sortOrder . '">' . $i . '</a></li>';
        }

        // Create "Last" link with ellipsis
        if ($endPage < $totalPages) {
            if ($endPage < $totalPages - 1) {
                $pagination .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            $pagination .= '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '&search=' . $searchTerm . '&sort=' . $sortBy . '&order=' . $sortOrder . '">' . $totalPages . '</a></li>';
        }

        // Create "Next" link with custom style
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $pagination .= '<li class="page-item"><a class="page-link" href="?page=' . $nextPage . '&search=' . $searchTerm . '&sort=' . $sortBy . '&order=' . $sortOrder . '">Next</a></li>';
        }

        $pagination .= '</ul>';

        return $pagination;
    }

    // Close the database connection
    public function __destruct() {
        $this->db->close();
    }
}
?>
