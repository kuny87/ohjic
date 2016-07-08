<html>
<head>
<title><?=$title?></title>
</head>
<body>
<h1><?=$heading?></h1>


<!--<ol>-->
<!--    --><?php //if($query->num_rows() > 0): ?>
<!--        -->
<!--        --><?php //foreach($query as $item): ?>
<!---->
<!--            <li>--><?//=$item?><!--</li>-->
<!---->
<!--            <hr>-->
<!---->
<!--        --><?php //endforeach; ?>
<!--        -->
<!--    --><?php //endif; ?>
<!--</ol>-->
<!---->
<!--<p>--><?//=anchor('Welcome', 'Back to Welcome');?><!--</p>-->





<ol>
    <?php foreach($query as $item): ?>

    <li><?=$item?></li>

        <p><?=anchor('Welcome/comments/'.$item, 'Comments');?></p>
        <hr>

    <?php endforeach; ?>
</ol>

</body>
</html>