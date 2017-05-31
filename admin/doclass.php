<?php  
      header("Content-type: text/html;charset=utf-8");//输出编码,避免中文乱码  
      $id=$_GET['id']; 
        # FileName="addproduct.php"  
        # Type="MYSQL"  
        # HTTP="true"  
      include("conn/conn.php");   
      $sql="select * from tb_fl1 where tb_value='$id'";  
      $result=mysqli_query($conn,$sql);  
      while($rows=mysqli_fetch_array($result)){  
       echo "<option value=".$rows['tb_value'].">";  
          echo $rows['tb_name'];  
       echo "</option>";  
      }  
    ?>  

