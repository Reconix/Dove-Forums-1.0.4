<html>
<body>
	<h1>Activate account for <?php echo $identity;?></h1>
	<p>Please click this link to <?php echo anchor('forums/activate/'. $id .'/'. $activation, 'Activate Your Account');?>.</p>
	<p>You password is: <?php echo $password; ?></p>
</body>
</html>