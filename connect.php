<?
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
 {
    $conn=mysqli_connect('localhost','root','','contact') or die("Connection Failed:" .mysqli_connect_error());
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $name=$_POST['phone'];
        $sql="INSERT INTO `userdetails`(`name`,`email`,`phone`) VALUES(`$name`,`$email`,`$phone`)";
        $query=mysqli_query($conn,$sql);
       if($query)
       {
        echo 'Entry Successfull';
       }
       else
       {
        echo 'Error Occurred';
       }
    }
 }
?>