<html>
<body>
	<h1>You have a new Friend Request</h1>
	
	<p><?php echo $username; ?> would like to be your friend, to view the request click the link below :</p>
	<p><?php echo anchor('profile/requests', 'View your requests'); ?></p>
</body>
</html>