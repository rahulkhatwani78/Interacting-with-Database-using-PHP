<?php
	require_once "pdo.php";

	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']))
	{
		$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':name' => $_POST['name'], ':email' => $_POST['email'], ':password' => $_POST['password']));
	}

	if(isset($_POST['delete']) && isset($_POST['user_id']))
	{
		$sql = "DELETE FROM users WHERE user_id = :zip";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':zip' => $_POST['user_id']));
	}
?>

<html>
	<body>
		<table border="1">
			<?php
				$sql = "SELECT * FROM users";
				$stmt = $pdo->query($sql);
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					echo "<tr><td>";
					echo $row['name'];
					echo "</td><td>";
					echo $row['email'];
					echo "</td><td>";
					echo $row['password'];
					echo "</td><td>";
					echo '<form method="post">'."\n";
					echo '<input type="hidden" name="user_id" value='.$row['user_id'].">";
					echo '<input type="submit" name="delete" value="Del">'."\n";
					echo "</form>";
					echo "</td></tr>";
				}
			?>
		</table>
		<p>Add A New User</p>
		<form method="post">
			<p>Name: <input type="text" name="name"></p>
			<p>Email: <input type="text" name="email"></p>
			<p>Password: <input type="password" name="password"></p>
			<p><input type="submit" value="Add New"></p>
		</form>
	</body>
</html>