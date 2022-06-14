<?php
// $db = new EDB("databases/posts.edb", "LFr3wYr9THJz9C4h");
include "functions.php";



$db = new EDB("databases/posts.edb", "LFr3wYr9THJz9C4h");
$users = new EDB("databases/userinfo.edb", "none");

$hiddenfilters = new EDB("databases/hidden_filters.edb", "none", "Not Confirmed Filters");
$filters = new EDB("databases/filters.edb", "none", "Filters");



// for ($i = 0; $i < count($filters->content); $i++) {
//     $hiddenfilters->addinDB($filters->content[$i]);
// }


// $db->reset();
?>


<div style="display: flex">
    <?php
    $db->debugLog();
    $filters->debugLog();
    // $hiddenfilters->debugLog();
    $users->debugLog();
    ?>
</div>

<!-- 
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam esse aliquam totam? Cumque nobis quae praesentium soluta enim commodi ratione architecto nisi ad. Minus veritatis expedita libero, molestiae incidunt tempore.
 -->