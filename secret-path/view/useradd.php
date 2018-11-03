<?php  
if ($_SESSION['role']<=1)
{
  if (isset($_GET['user']))
  {
  	$button_caption='Додати';
  	$methodType='add';
  	$PasswordFieldType='password';
  }
  else
  {
  	$button_caption='Змінити';
  	$methodType='edit';
  	$PasswordFieldType='hidden';
  	$CurrentUser = SelectObject('users', $_POST['edit']);
  	$UserTypes = ObjectList('roles');
  }
 ?>
 <div><a href="?userslist=1">Назад</a></div>
 <div class="avatar"><img src="<?php //echo avatar_url; ?>" alt="avatar"></div>
 <form action="?user=add" method="post" enctype="multipart/form-data"><input type="file"><button>Завантажити аватар</button></form>
 <form action="?userslist=1" method="post">
 	<input type="hidden" name="userId" value="<?php echo $CurrentUser['id']; ?>"> 	
 	<input type="hidden" name="avatar_url" value="<?php //echo avatar_url; ?>">
 	<input type="text" name="login" placeholder="Введіть логін" required value="<?php echo $CurrentUser['login']; ?>">
 	<input type="text" placeholder="Введіть повне ім'я" name="name" required value="<?php echo $CurrentUser['name']; ?>">
 	<input type="email" placeholder="Введіть email"  name="email" required value="<?php echo $CurrentUser['email']; ?>">
 	<select name="role">
 		<option value="0" required >Оберіть тип користувача</option>
 		<?php if ($UserTypes[0]!='') 
 		{
 			foreach($UserTypes as $CurrentType)
 			{
 				if ($CurrentType['id']==$CurrentUser['role'])
 				{ 	
 					$isSelected='selected';
 				}		
 				else
 				{
 					$isSelected='';
 				}		
 		?>
 					<option value="<?php echo $CurrentType['id'];?>" <?php echo $isSelected; ?>><?php echo $CurrentType['name']; ?></option>
 		<?php  				
 			}
 		}
 		 ?>
 	</select>
 	<input type="<?php echo $PasswordFieldType; ?>" name="password" placeholder="Введіть пароль" required>
 	<button type="submit" name="methodType" value="<?php echo $methodType; ?>"><?php echo $button_caption; ?></button>
 	<button type="reset">Очистити</button>
 </form>
<?php }
else
{
	echo '<h1>Доступ заборонено! Звернітся до адміна.</h1>';
}
 ?>
