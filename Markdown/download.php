
<?php
require 'Parsedown.php';

$content = $_POST['content'];
$filename = 'markdown.html';

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$filename.'"');

$Parsedown = new Parsedown();
echo '<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MyMarkdown</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>';
echo $Parsedown->parse($content);

echo '
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</body>

</html>';

exit;
