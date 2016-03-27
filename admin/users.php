<?php
//include config
require('../includes/common.php');

//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['deluser'])){ 

    //if user id is 1 ignore
    if($_GET['deluser'] !='1'){

        $stmt = $db->prepare('DELETE FROM users WHERE id = :id') ;
        $stmt->execute(array(':id' => $_GET['deluser']));

        header('Location: users.php?action=deleted');
        exit;

    }
} 

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Users</title>
  <link rel="stylesheet" href="../style/style.css">
  <script language="JavaScript" type="text/javascript">
  function deluser(id, title)
  {
      if (confirm("Are you sure you want to delete '" + title + "'"))
      {
          window.location.href = 'users.php?deluser=' + id;
      }
  }
  </script>
  <script type="text/javascript" src="js/popup.js"></script>
</head>
<body id="users">

    

    <?php include('menu.php');?>

    <?php 
    //show message from add / edit page
    if(isset($_GET['action'])){ 
        echo '<h3>User '.$_GET['action'].'.</h3>'; 
    } 
    ?>
	<div class="wrapper-small">
    <table class="user-table">
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php
        try {

            $stmt = $db->query('SELECT id, username, email FROM users ORDER BY username');
            while($row = $stmt->fetch()){
                
                echo '<tr>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                ?>

                <td>
                  <!--  <a href="user-edit.php?id=<?php echo $row['id'];?>">Edit</a> -->
                  		<a id="edit-user-button "href="#">Edit</a>
                    <?php if($row['id'] != 1){?>
                        | <a href="javascript:deluser('<?php echo $row['id'];?>','<?php echo $row['username'];?>')">Delete</a>
                    <?php } ?>
                </td>
                
                <?php 
                echo '</tr>';

            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    ?>
    </table>

    <p><a id="add-user-button"href='#'>Add User</a></p>

</div>
<div class="overlay" ></div>
<div id="addUser-container" class="popup-container" >
<?php include('add-user.php') ?>
</div>
<div id="editUser-container" class="popup-container" >
<?php include ('user-edit.php') ?>
</div>

</body>
</html>