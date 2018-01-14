<?php    
header('Access-Control-Allow-Origin: *');  

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hudhud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_GET['getcamp'])){
    
// Code of Conversion
$query = "SELECT * FROM campaign;";
$result = mysqli_query($conn , $query);

if ($result) {
// Conversion of result object into JSON format
$rows = array();
while($temp = mysqli_fetch_assoc($result)) {
    $rows[] = $temp;
}
echo  json_encode($rows);

} else {
    echo "No Results Found";
}
    exit;
}
if(isset($_POST['sub'])){
    $sql= "INSERT INTO `campaign` (`title`, `event`, `hachtag`, `date`, `vid`, `des`) 
    VALUES ( '{$_POST['title']}', '{$_POST['event']}', '{$_POST['hash']}', '{$_POST['date']}' , '{$_POST['vid']}', '{$_POST['des']}');";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' >تم إضافة الحملة بنجاح</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }



}

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>حملات</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
        <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script type="text/javascript"></script>
        <style>
            .require {
                color: #666;
            }
            label small {
                color: #999;
                font-weight: normal;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">

                    <h1>إضافة حملة</h1>

                    <form action="" method="POST">



                        <div class="form-group">
                            <label for="title">العنوان <span class="require">*</span></label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="title">#الهاشتاج<span class="require">*</span></label>
                            <input type="text" class="form-control" name="hash" required>
                        </div>
                        <div class="form-group">
                            <label for="title">المناسبة <span class="require">*</span></label>
                            <input type="text" class="form-control" name="event" required>
                        </div>
                        <div class="form-group">
                            <label for="title">المناسبة <span class="require">*</span></label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="title">فيديو الحملة <span class="require">*</span></label>
                            <textarea rows="3" class="form-control" name="vid" dir="ltr" placeholder='&lt;iframe width="560" height="315" src="https://www.youtube.com/embed/CXVZ4aRS8-g" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;' required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="description"> نص الحملة<span class="require">*</span></label>
                            <textarea rows="5" class="form-control" name="des" ></textarea>
                        </div>

                        <div class="form-group">
                            <p><span class="require">*</span> - حقول مطلوبة </p>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="sub" class="btn btn-primary">
                                اضافة 
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </body>
</html>