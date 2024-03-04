<?php
// Assuming you have already instantiated the database connection and have a Db class available

if (isset($_GET['categoryId'])) {
    $categoryId = array($_GET['categoryId']);

    // Perform a database query to fetch the related subcategories based on the category ID
    $db = new Db('localhost', 'root', 'root', 'projectsms');

    $subcategories = $db->read('subtaskscategories', 'category_id=?', $categoryId);

    //Return the subcategories as a JSON response
    header('Content-Type: application/json');
    print_r(json_encode($subcategories));
}