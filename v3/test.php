<html>
<head>
<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="./js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.autocomplete.css">
<script type="text/javascript">
$(document).ready(function(){
    $('#search_box').autocomplete('autocomplete.php');
});
</script>
</head>
<body>
<input type="text" name="search" id="search_box" />
<input type="button" value="search" />
</body>
</html>