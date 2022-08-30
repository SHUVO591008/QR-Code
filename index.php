<?php
$connect =mysqli_connect("localhost","root","","myscanner");
// if($connect){
//     echo "<script>alert('Database Connection');</script>";
// }else{
//     echo "<script>alert('Database Faild');</script>";
// }

if(isset($_POST['text'])){
    $text = $_POST['text'];

    $insert = "INSERT INTO student_scanner (student_id, time) VALUES ('$text', NOW())";

    $query = mysqli_query($connect,$insert);
    // if($query){
    //     echo "<script>alert('Database Save');</script>";
    // }else{
    //     echo "<script>alert('Database Faild');</script>";
    // }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="qrcode.min.js"></script>
<!-- scaner -->
<script type="text/javascript" src="instascan.min.js"></script>

<style>
 
</style>
</head>
<body>
<div  class="col-md-12">
    <div  class="row">
        <div class="col-md-12">
            <div class="row ">
                <h3 class="text-center">QR Code</h3>

                <div class="col-md-3">
                    <input class="form-control" type="text" id="QRcode" placeholder="QR Code" onchange="QRgenerate()">

                </div>

                <div class="col-md-3" id="QRimage">

                </div>
                <div class="row">
                <div class="col-md-3">
                    <video style="border: 1px solid black;" width="100%" id="Mycameraopen"></video>
                    <form action="" method="post">
                        <input class="form-control" style="width: 100%;" placeholder="text" name="text" type="text" id="text">
                    </form>
                    
                </div>
            </div>

                <div class="col-md-12">
                    <h3 class="text-center">Student List</h3>
                    <table class="table">
                        <tr>
                            <th>SL</th>
                            <th>Studen_id</th>
                            <th>Time</th>
                        </tr>
                        <?php 
                        $select = "SELECT * FROM student_scanner";
                        $conn = mysqli_query($connect,$select);
                        $i =1;

                        while ($row = mysqli_fetch_array($conn)) {?>

                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $row['student_id']?></td>
                                <td><?php echo $row['time']?></td>
                            </tr>
                        <?php $i++;}?>
                    
                    
                    </table>

                    
                </div>

                
                   


            </div>


          


        </div>
       
    </div>
</div>

    <script>

        var valueData = document.getElementById('QRcode');
        var image = document.getElementById('QRimage');

        var qr = new QRCode(image,{
                width : 200,
                height : 200
            });

        function QRgenerate(){
            var data = valueData.value;

            qr.makeCode(data);

           
        }


        // scaner

        // step-1
        var video = document.getElementById('Mycameraopen');
        var text = document.getElementById('text');

        var scanner = new Instascan.Scanner({
            video : video
        });
        Instascan.Camera.getCameras()
        .then(function(Our_Camera){
            if(Our_Camera.length > 0){
                
                scanner.start(Our_Camera[0]);
            }else{
                alert("Camera Failed")
            }
        })
        .catch(function(error){
            console.log('Error')
        })

         // step-2

         scanner.addListener('scan',function(input_value){
            text.value=input_value;

            document.forms[0].submit();
         })

    </script>
    
</body>
</html>