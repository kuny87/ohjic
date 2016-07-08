<html>
<head>
    <title><?=$title?></title>
</head>
<body>
<h1><?=$heading?></h1>

<?=form_open('Welcome/comment_insert');?>

<?=form_hidden('entry_id', $this->uri->segment(3));?>

<p><textarea name="body" rows="10"></textarea></p>
<p><input type="text" name="author" /></p>
<p><input type="submit" value="Submit Comment" /></p>
</form>

</body>
</html>