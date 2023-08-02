<?php

$page_number = 1;
if (isset($_GET['page'])) {
    $page_number = $_GET['page'];
}

$limit = 10;
$offset = ($page_number - 1) * $limit;

$sql = "SELECT * FROM products LIMIT $offset, $limit";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Paginate the results
    $total_pages = ceil($result->num_rows / $limit);
    $pagination = '';
    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page_number) ? 'active' : '';
        $pagination .= '<li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }
} else {
    $pagination = '<li class="page-item disabled"><a class="page-link">No results</a></li>';
}

?>

<ul class="pagination">
    <?php echo $pagination; ?>
</ul>