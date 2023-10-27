<?php

session_start();
//set current session null and destroy
if (isset($_SESSION["student"])) {
    $_SESSION["student"] = null;
    session_destroy();
    echo "success";
} else if (isset($_SESSION["admin"])) {
    $_SESSION["admin"] = null;
    session_destroy();
    echo "success";
}else if (isset($_SESSION["teacher"])) {
    $_SESSION["teacher"] = null;
    session_destroy();
    echo "success";
}else if (isset($_SESSION["officer"])) {
    $_SESSION["officer"] = null;
    session_destroy();
    echo "success";
}else{
    ?>
<script>
    window.location = "index.php";
</script>
    <?php
}
