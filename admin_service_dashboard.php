<?php
include("data_class.php");
//session_start();

$adminid= $_SESSION["adminid"];
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>
    <style>
        .imglogo{
            margin:auto
        }
        .innerdiv{
            text-align:center;
            margin: 100px;
        }
        .leftinnerdiv{
            float:left;
            width:25%;
        }
        .yellowbtn{
            background-color:rgb(224, 191, 45);
            color: white;
            width: 95%;
            height: 40px;
            margin-top: 8px;

        }
        .rightinnerdiv{
            float:right;
            width:75%;
        }
        .rightinnerdiv,
        table{
            margin: 20 70 10 20;
            width:75%
        }
    </style>
    <body>
        <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/logo.png"/></div>
            <div class="leftinnerdiv">
                <Button class="yellowbtn">ADMIN</Button>
                <Button class="yellowbtn" onclick="openpart('addbook')" >ADD BOOK</Button>
                <Button class="yellowbtn" onclick="openpart('bookrecord')" > BOOK RECORD</Button>
                <Button class="yellowbtn" onclick="openpart('bookrequestapprove')"> BOOK REQUESTS</Button>
                <Button class="yellowbtn" onclick="openpart('addperson')"> ADD PERSON</Button>
                <Button class="yellowbtn" onclick="openpart('studentrecord')"> STUDENT RECORD</Button>
                <Button class="yellowbtn" onclick="openpart('issuebook')"> ISSUE BOOK</Button>
                <Button class="yellowbtn" onclick="openpart('issuebookreport')"> ISSUE REPORT</Button>
                <a href="index.php"><Button class="yellowbtn" > LOGOUT</Button></a>
            </div>
    <!--add book portion-->         
            <div class="rightinnerdiv">   
  
            <div id="addbook" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
            <Button class= "yellowbtn">ADD NEW BOOK</Button>
            <table>
            <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
            <tr><td><label>Book Name:</label></td><td><input type="text" name="bookname"/></td></tr>
            <tr><td><label>Detail:</label></td><td><input  type="text" name="bookdetail"/></td></tr>
            <tr><td><label>Autor:</label></td><td><input type="text" name="bookaudor"/></td></tr>
            <tr><td><label>Publication</label></td><td><input type="text" name="bookpub"/></td></tr>
            <tr><td><lable>Branch:</lable></td><td><input type="radio" name="branch" value="other"/>other</lable><input type="radio" name="branch" value="BSIT"/>BSIT<div style="margin-left:80px"><input type="radio" name="branch" value="BSCS"/>BSCS<input type="radio" name="branch" value="BSSE"/>BSSE</div>
            </td></tr>
                          
            <tr><td><label>Price:</label></td><td><input  type="number" name="bookprice"/></td></tr>
            <tr><td><label>Quantity:</label></td><td><input type="number" name="bookquantity"/></td></tr>
            <tr><td><label>Book Photo</label></td><td><input  type="file" name="bookphoto"/></td></tr>
                        
               
            <tr><td><input type="submit" value="SUBMIT"/></td></tr>
            </table>
            </form>
            </div>
    </div>
    <!--add person portion-->                        
        <div class="rightinnerdiv">            
        <div id="addperson" class="innerright portion" style="display:none">
        <Button class="yellowbtn" >ADD PERSON</Button>
        <table>
        <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
        <tr><td><label>Name:</label></td><td><input type="text" name="addname"/></td></tr>
        
        <tr><td><label>Pasword:</label></td><td><input type="password" name="addpass"/></td></tr>
       
        <tr><td><label>Email:</label></td><td><input  type="email" name="addemail"/></td></tr>
        <tr><td><label for="typw">Choose type:</label></td><td>
        <select name="type" >
        <option value="student">student</option>
        <option value="teacher">teacher</option></td></tr>
        </select>
                
        <tr><td><input type="submit" value="SUBMIT"/></td></tr>
        </form>
    </table>
        </div>
    </div>
    
    
    

<!--book request by student or teacher-->

<div class="rightinnerdiv">   
            <div id="bookrequestapprove" class="innerright portion" style="display:none">
            <Button class="yellowbtn" >BOOK REQUEST APPROVE</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->requestbookdata();
            $recordset=$u->requestbookdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
              "<td>$row[1]</td>";
              "<td>$row[2]</td>";

                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";
               // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                 $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>   
        </div> 


<!--issue book -->
<div class="rightinnerdiv">
        <div id="issuebook" class="innerright portion" style="display:none">
        <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
        <Button class="yellowbtn" >ISSUE BOOK</Button>
        <table>
        <tr><td><label for="book">Choose Book:</label></td><td>
        <select name="book" >
        <?php
        $u=new data;
        $u->setconnection();
        $u->getbookissue();
        $recordset=$u->getbookissue();
        foreach($recordset as $row){

        echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
        
        }            
        ?>
        </select></td></tr>

        <tr><td><label for="Select Student">Select Student:</label></td><td>
        <select name="userselect" >
        <?php
        $u=new data;
        $u->setconnection();
        $u->userdata();
        $recordset=$u->userdata();
        foreach($recordset as $row){
            $id= $row[0];
                echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
        }            
        ?>
        </select></td></tr>
<br>
        <tr><td><lable>Days</lable></td><td><input type="number" name="days"/></td></tr>

        <tr><td><input type="submit" value="SUBMIT"/></td></tr>
        </form>
    </table>
        </div>
    </div>
       

    
<!--book record portion-->
        <div class="rightinnerdiv">
        <div id="bookrecord" class="innerright portion" style="display:none">
        <Button class="yellowbtn" >BOOK RECORD</Button>
                <?php
                $u=new data;
                $u->setconnection();
                $u->getbook();
                $recordset=$u->getbook();

                $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                padding: 8px;'>Book Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th></th><th>View</th></tr>";
                foreach($recordset as $row){
                    $table.="<tr>";
                    "<td>$row[0]</td>";
                    $table.="<td>$row[2]</td>";
                    $table.="<td>$row[7]</td>";
                    $table.="<td>$row[8]</td>";
                    $table.="<td>$row[9]</td>";
                    $table.="<td>$row[10]</td>";
                    $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'>View Book</a></td>";
                    //$table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                    $table.="</tr>";
                    //$table.=$row[0];
                }
                $table.="</table>";

                echo $table;
                ?>
        </div>
        </div>
<!--bookdetails portion-->        
        <div class="rightinnerdiv">      
        <div id="bookdetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
        <Button class="yellowbtn" >BOOK DETAIL</Button>
        <?php
        $u=new data;
        $u->setconnection();
        $u->getbookdetail($viewid);
        $recordset=$u->getbookdetail($viewid);
        foreach($recordset as $row){

                $bookid= $row[0];
                $bookimg= $row[1];
                $bookname= $row[2];
                $bookdetail= $row[3];
                $bookauthour= $row[4];
                $bookpub= $row[5];
                $branch= $row[6];
                $bookprice= $row[7];
                $bookquantity= $row[8];
                $bookava= $row[9];
                $bookrent= $row[10];

        }            
        ?>

        <img width='150px' height='150px' style='border:1px solid #333333;margin-left:20px' src="uploads/<?php echo $bookimg?> "/>
        </br>
        <p style="color:black"><u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
        <p style="color:black"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
        <p style="color:black"><u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthour ?></p>
        <p style="color:black"><u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
        <p style="color:black"><u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
        <p style="color:black"><u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
        <p style="color:black"><u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
        <p style="color:black"><u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>
        </div>
    </div>
<!--student record portion--> 
            <div class="rightinnerdiv">
            <div id="studentrecord" class="innerright portion" style="display:none">
            <Button class="yellowbtn" >STUDENT RECORD</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'> Name</th><th>Email</th><th>Type</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

<!--isuue book report-->
<div class="rightinnerdiv">   
            <div id="issuebookreport" class="innerright portion" style="display:none">
            <Button class="yellowbtn" >ISSUE BOOK RECORD</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->issuereport();
            $recordset=$u->issuereport();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[4]</td>";
                // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>
          
                 
            
        </div>
        </div>
 
            
        
            
            
        
   
    
    <script>
        function openpart(portion) {
        var i;
        var x = document.getElementsByClassName("portion");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        document.getElementById(portion).style.display = "block";  
        }
    </script>
    </body>
</html> 
