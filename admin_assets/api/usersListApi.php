<?php
// $isListAll = true;
// include('../admin_assets/api/usersListApi.php');

function getCategoryNameById($id, $categoriesArr)
{
    foreach ($categoriesArr as $category) {
        if ($category['id'] == $id) {
            return $category['name'];
        }
    }
    // If the ID is not found, you can return a default value or handle it as needed
    return 'Category Not Found';
}

function getCountryCodeById($id, $countryCodeArr)
{
    foreach ($countryCodeArr as $code) {
        if ($code['id'] == $id) {
            return $code['name'];
        }
    }
    return '';
}

function getDateFormat($value) {
    $date = date_create($value);
    return date_format($date, "d-m-Y");
}


$query = trim($query);
$queryCategory = trim($queryCategory);
$queryGender = trim($queryGender);
// search date result
$query_date = str_replace('/', '-', $query);
$date_formatted = date('Y-m-d', strtotime($query_date));
// search status result
switch ($query) {
    case 'active': $status = 1; break;
    case 'verified': $status = 1; break;
    case 'complete': $status = 1; break;
    case '1': $status = 1; break;
    case 'inactive': $status = '0'; break;
    case 'unverified': $status = '0'; break;
    case 'incomplete': $status = '0'; break;
    case 'pending': $status = '0'; break;
    case 'pending verification': $status = '0'; break;
    case '0': $status = '0'; break;
    default: $status = ''; break;
}



if ($isListAll == true) {
    $sql = "SELECT * FROM users WHERE ";

    if ($status == '') {
        $sql .= "(
            email LIKE :query
            OR first_name LIKE :query
            OR last_name LIKE :query
            OR CONCAT(first_name, '', last_name) LIKE :query
            OR CONCAT(first_name, '', middle_name) LIKE :query
            OR CONCAT(middle_name, '', last_name) LIKE :query
            OR CONCAT(first_name, ' ', COALESCE(middle_name, ' '), ' ', last_name) LIKE :query
            OR dob LIKE :date_formatted
            OR dob LIKE :query
            OR created_at LIKE :date_formatted
            OR created_at LIKE :query
            OR phone_no LIKE :query
        )";
    } else {
        $sql .= "status = :status";
    }

    if ($queryCategory) {
        $sql .= " AND category = :queryCategory";
    }

    if ($queryGender) {
        $sql .= " AND gender = :queryGender";
    }

    $sql .= " ORDER BY id DESC";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    if ($status == '') {
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->bindValue(':date_formatted', $date_formatted, PDO::PARAM_STR);
    }

    if ($status != '') {
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    }

    if ($queryCategory) {
        $stmt->bindValue(':queryCategory', $queryCategory, PDO::PARAM_STR);
    }

    if ($queryGender) {
        $stmt->bindValue(':queryGender', $queryGender, PDO::PARAM_STR);
    }

    // Execute the query
    $stmt->execute();
    // Fetch the results
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    $currentPage = $_GET["page"] ?? 1;
    //Get DB instance. function is defined in config.php
    $db = getDbInstance();
    // set page limit to 2 results per page. 20 by default
    $db->pageLimit = 10;
    if ($status=='') {
        $db->where("(
            email LIKE '%" . $query . "%'
            OR first_name LIKE '%" . $query . "%'
            OR last_name LIKE '%" . $query . "%'
            OR CONCAT(first_name, '', last_name) LIKE '%" . $query . "%'
            OR CONCAT(first_name, '', middle_name) LIKE '%" . $query . "%'
            OR CONCAT(middle_name, '', last_name) LIKE '%" . $query . "%'
            OR CONCAT(first_name, ' ', COALESCE(middle_name, ' '), ' ', last_name) LIKE '%" . $query . "%'
            OR dob LIKE '%" . $date_formatted . "%'
            OR dob LIKE '%" . $query . "%'
            OR created_at LIKE '%" . $date_formatted . "%'
            OR created_at LIKE '%" . $query . "%'
            OR phone_no LIKE '%" . $query . "%'
        )");
    } else {
        $db->where("status", $status);
    }
    if ($queryCategory) {
        $db->where("category", $queryCategory);
    }
    if ($queryGender) {
        $db->where("gender", $queryGender);
    }
    // Add the ORDER BY clause
    $db->orderBy("id", "DESC"); 
    // set page limit to 2 results per page. 20 by default
    $users = $db->arraybuilder()->paginate("users", $currentPage);
}
// echo "<pre>"; print_r($users); exit;
?>