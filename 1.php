<?php 
      $email = $desc =  $name = $age = '';
      $errors = array('email'=>'','descc'=>'','age'=>'');
         //connect to db
                 $conn = mysqli_connect('localhost','abby','abby123','database_1');
      if(isset($_POST['submit'])){

            if(empty($_POST['Name'])){
                  echo " cannot be empty";
            } else{
                  echo("good");
            }

      
            

            if(empty($_POST['Email'])){
                  $errors['email'] =  "email cannot be empty";
            } else {
                  $email = $_POST['Email'];
                  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $errors['email'] = " email format incorrect";
                  }
            }
            
            if (empty($_POST["Description"])) {
                  $errors['descc'] = ("Something");
            } else {
                  $desc = $_POST["Description"];
                  if (!preg_match('/^[a-zA-Z ]*$/', $desc)) {
                        $errors['descc'] ='no';
                  }
            }
            if (empty($_POST['Age'])) {
                  $errors['age']= "Please enter Age";
            } else {
                  $age = $_POST['Age'];
                  if ($age > 100 || $age < 18) {
                        $errors['age']= "Age should be between 18 and 100";
                  }
            }

            if(array_filter($errors)){
                  echo "there are erros";
            }else{
                  $name = mysqli_real_escape_string($conn,$_POST['Name']);
                  $age = mysqli_real_escape_string($conn,$_POST['Age']);
                  $email = mysqli_real_escape_string($conn,$_POST['Email']);
                  $desc = mysqli_real_escape_string($conn,$_POST['Description']);

                  $sql = "INSERT INTO form1 (Name,Age,Email,Description) VALUES('$name' ,'$age','$email','$desc')";

                  if (mysqli_query($conn,$sql)){

                  } else{
                        echo "query error" . mysqli_error($conn);
                  }
            }
      }     

               

                 //check conn
                 if(!$conn){
                  echo "connection error". mysqli_connect_error();
                 } else{
                  echo "Connected";
                 }

                 //sql 
                 $sql = 'SELECT * FROM form1';

                 // fetch
                 $result = mysqli_query($conn,$sql);

                 $datas = mysqli_fetch_all($result,MYSQLI_ASSOC);

                 mysqli_free_result($result);

                 mysqli_close($conn);

            
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="POST">
            <label for="name" style="color: #dc7171;font-size: 18px;">Full Name:</label>
            <br><br>
            <input id="demo" type="text" name="Name" style="height: 30px;width: 100%;border: 1px solid #ccc;padding: 5px;"><br><br>
            <label style="color: #dc7171;font-size: 18px;border: 5px;">Age</label>
            <br /><br />
            <input type="number" name="Age" id="age1"  style="height: 30px;width: 100%;border: 1px solid #ccc;padding: 5px;" value="<?php echo $age ?>" /><br /><br />
            <div><?php echo $errors['age'] ?></div>
            <label for="email" style="color: #dc7171;font-size: 18px;">Email:</label>
            <br><br>
            <input type="text" name="Email" style="height: 30px;width: 100%;border: 1px solid #ccc;padding: 5px;" value="<?php echo $email ?>"><br><br>
            <div><?php echo $errors['email']; ?></div>
            <label for="Description" style="color: #dc7171;font-size: 18px;">Description:</label>
            <br><br>
            <textarea name="Description" style="padding: 5px;height: 30px;width: 100%;border: 1px solid #ccc;height: 60px;" cols="30" rows="10" placeholder="<?php echo $desc ?>" ></textarea>
            <div><?php echo $errors['descc']; ?></div>
            <br><br>
            <input class="submit-btn" type="submit" name="submit" value="submit" style="border: none ; font-size: 15px;cursor: pointer;width: 100%;color: white;background-color: #dc7171;height: 40px;border-radius: 5px;">
          

        </form>



        <div style="text-decoration: none;">
              <div class="card">
                  <ul> <?php
                        foreach($datas as $data){ ?>
                                          <li><?php echo $data['Name']; ?></li>
                                          <li><?php echo $data['Email']; ?></li>
                                          <li><?php echo $data['Age']; ?></li>
                                          <li><?php echo $data['Description']; ?></li>
                                          <li><?php echo $data['Created At']; ?></li>
                                    </ul>
                    <?php  }?>
              </div>
        </div>


                  <div >
                        <?php
                        foreach($datas as $data){ ?>
                              <div>
                                    <ul>
                                          <li><?php echo $data['Name']; ?></li>
                                          <li><?php echo $data['Email']; ?></li>
                                          <li><?php echo $data['Age']; ?></li>
                                          <li><?php echo $data['Description']; ?></li>
                                          <li><?php echo $data['Created At']; ?></li>
                                    </ul>
                              </div>

                            
                     <?php  }?>
                  </div>
</body>
</html>
