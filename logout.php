<?php
setcookie ('sharehub_phpsession', '', time() - 4800);
header("Location: index.php");
?>
