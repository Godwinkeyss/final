<?php
session_start();
include('../config/dbcon.php');
  if(isset($_POST['register'])){

    // if(isset($_POST['register'])){
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirm'];
    
    
        // if password don't match
        if($password !== $confirmpassword){
            $_SESSION['message'] = "Password don't match ";
          header("Location: ../register.php?error=password don't match");
        }
        // if password is less than 6 characters
        else if(strlen($password) < 6){
            $_SESSION['message'] = "Password must be at least 6 characters ";
          header('Location: ../register.php?error=password must be at least 6 characters');
       
    
        // if there is no error
        }else{
              // check wether there is a user with this email or not
            $sql = "SELECT * FROM users WHERE user_email=:user_email";
          
          $query= $pdo-> prepare($sql);
          $query-> bindParam(':user_email', $email, PDO::PARAM_STR);
          $query-> execute();
          $results = $query -> fetchAll(PDO::FETCH_OBJ);
             
          //   if there is a user already register with the email
            if($query -> rowCount() > 0){
                $_SESSION['message'] = ' Email already exist';
              header("Location: ../register.php?error=user with this email already exist");
    
              // if no user registered with this email before,
            }else{
    
            
    
            
    
              // create a new user
                $stmt =  $pdo->prepare("INSERT INTO users (first_name,last_name,user_email,phone,password) VALUES(:first_name,:last_name,:user_email,:phone,:password)");
                
                $stmt->bindValue(':first_name',$firstname);
                $stmt->bindValue(':last_name',$lastname);
                $stmt->bindValue(':user_email',$email);
                $stmt->bindValue(':phone',$phone);
                $stmt->bindValue(':password',md5($password));
                
                // if account was created successfully
                if($stmt->execute()){
                  $user_id = $pdo->lastInsertId();
                   $_SESSION['user_id'] = $user_id;
                   $_SESSION['user_email'] = $email;
                   $_SESSION['first_name'] = $name;
                   $_SESSION['last_name'] = $name;
                   $_SESSION['logged_in'] = true;
                   $_SESSION['message'] = 'Registered successfully';
                   header('Location: ../login.php?register_success=You registered successfully');
    
                  //  account could not be created
                }else{
                  header('Location:../register.php?error=could not create an account at the moment');
                }
            }
          }
        }else if(isset($_POST['login'])){
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $user_id = $pdo->lastInsertId();
          
          
            $stmt = $pdo->prepare("SELECT * FROM users WHERE user_email=:user_email AND password=:password LIMIT 1 ");
             
            // $stmt->bindValue(':user_id',$user_id);
            // $stmt->bindValue(':user_name',$user_name);
           
            $stmt->bindValue(':user_email',$email);
            $stmt->bindValue(':password',$password);
           
          
            if($stmt->execute()){
              // $stmt->bindParam($user_id,$user_email,$user_name, $user_password);
          
               if($stmt->rowCount() >= 1){
                 $row =  $stmt->fetch();
                 $_SESSION['user_id'] = $row['user_id'];
                 $_SESSION['first_name'] = $row['first_name'];
                 $_SESSION['user_email'] = $row['user_email'];
                 $_SESSION['logged_in'] = true;
                 $_SESSION['message'] = ' logged in successfully';
          
                 header("Location:../index.php?login_success=logged in successfully");
                 
               }else{
                $_SESSION['message'] = 'could not verify your account';
                header("Location:../login.php?error=could not verify your account");
               }
          
          
            }else{
                // error
                $_SESSION['message'] = ' something went wrong"';
                header("Location:../login.php?error=something went wrong");
            }
        }
      
  
  
?>