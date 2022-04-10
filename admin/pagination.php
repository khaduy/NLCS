<nav aria-label="Page navigation example" class="per_page" style="padding-top: 10px;">
<ul class="pagination justify-content-center">
<?php if ($current_page > 1) {
    $prev_page = $current_page - 1;
?>
    <li class="page-item">
<a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Previous</a>
    </li>
<?php } else{ ?>
    <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
    </li>
<?php } ?>

<?php for ($num = 1; $num <= $totalPages; $num++) { ?>    
    <li class="page-item"><a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a></li>
<?php } ?>

<?php if ($current_page < $totalPages) {
    $next_page = $current_page + 1;
?>
    <li class="page-item">
<a class="page-link" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
    </li>
<?php } else{?>
    <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
    </li>
<?php } ?>
</ul>
</nav>