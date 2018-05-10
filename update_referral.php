<?php
    include('config.php');
    $sql="SELECT * FROM `referral`";
    $res=mysqli_query($conn,$sql); 
    
    while($row = mysqli_fetch_assoc($res))
    {
        if($row['status']=='0')
        {
            $createdDate = $row['created_at'];
            $now = date("Y-m-d h:i:sa");
            $delta = strtotime($now)-strtotime($createdDate);
            if ($delta > 48*3600) {
                $sql="UPDATE referral SET STATUS='1' WHERE id='".$row['id']."'";
                mysqli_query($conn,$sql); 
            }
        }
    }
?>