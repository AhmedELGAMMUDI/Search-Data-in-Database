<?php
$conn = new mysqli('localhost','root','','search');
session_start();
$output = '';

if(isset($_POST['search'])){
        
    $searchq = $_POST ['search'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
    $query = mysqli_query($conn,"SELECT * FROM members WHERE firstname LIKE '%$searchq%'OR lastname LIKE '%$searchq%'");
    $count = mysqli_num_rows($query);
    if($count==0){
        $output = 'there is not search results!';
    }else{
        while ($row = mysqli_fetch_array($query)){
            $fname= $row['firstname'];
            $lname = $row['lastname'];
            $id = $row['id'];
            $output .='<div>'.$fname.' '.$lname.' '.$id.'</div>';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method='POST'>
        <input type="text" name="search"/>
        
        <input type="submit" value=">>"/>    
    </form>

    <?php print("$output");?>
</body>
</html>