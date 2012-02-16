<html>
<body>
	<h1><?php echo $replyUsername; ?> has replied to <?php echo $topicName; ?></h1>
	<p> To read the reply please click the following link: <br />
    <?php echo anchor('forums/posts/'. $categoryID .'/'. $topicID, 'View the discussion');?>.</p>
</body>
</html>