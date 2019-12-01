<?php

session_start();

$html = '<html>';
$html = $head;
$html = '<body>
<script type = "text/javascript" > location.href = "/all_posts.php"; </script>
</body></html>';

session_destroy();

echo $html;

?>
