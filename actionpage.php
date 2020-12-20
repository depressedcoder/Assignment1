<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<title> IIT DU Results </title>
</head>
<body>
<div class="container" style="margin-top: 20px;">
<?php
    function getPointAndGrade($courseMark)
    {
        $point = 0.0;
        $grade = "F";

        if($courseMark >= 80 && $courseMark <= 100)
        {
            $point = 4.0;
            $grade = "A+";
        }
        else if($courseMark >= 70 && $courseMark < 80)
        {
            $point = 3.5;
            $grade = "A";
        }
        else if($courseMark >= 60 && $courseMark < 70)
        {
            $point = 3.0;
            $grade = "A-";
        }
        else if($courseMark >= 50 && $courseMark < 60)
        {
            $point = 2.5;
            $grade = "B";
        }

        return array($point, $grade);
    }                      

    function dataReceive(){

        $roll = $_POST["roll"];
        $name = $_POST["name"];

        $course1code = $_POST["course1code"];
        $course2code = $_POST["course2code"];
        $course3code = $_POST["course3code"];
        $course4code = $_POST["course4code"];
        
        $course1marks = (double)$_POST["course1marks"];
        $course2marks = (double)$_POST["course2marks"];    
        $course3marks = (double)$_POST["course3marks"];
        $course4marks = (double)$_POST["course4marks"];
        
        $course1gradepoint = getPointAndGrade($course1marks);
        $course2gradepoint = getPointAndGrade($course2marks);
        $course3gradepoint = getPointAndGrade($course3marks);
        $course4gradepoint = getPointAndGrade($course4marks);

        $course1point = $course1gradepoint[0];
        $course2point = $course2gradepoint[0];
        $course3point = $course3gradepoint[0];
        $course4point = $course4gradepoint[0];

        $course1grade = $course1gradepoint[1];
        $course2grade = $course2gradepoint[1];
        $course3grade = $course3gradepoint[1];
        $course4grade = $course4gradepoint[1];

        $CGPA =  ($course1point + $course2point + $course3point + $course4point)/4;
        
        $status = "NOT PASSED";

        if($CGPA >= 2.5 && $course1point>= 2.5 &&
        $course2point>= 2.5 && $course3point>= 2.5 && $course4point>= 2.5)
        {
            $status = "PASSED";
        }
        
        $student_info_with_marks = array($roll, $name, 
                    $course1code , $course2code, $course3code, $course4code,
                    $course1marks, $course2marks, $course3marks,$course3marks,
                    $course1point, $course2point, $course3point, $course4point,
                    $course1grade, $course2grade, $course3grade, $course4grade,
                    $CGPA, $status);
        
        return $student_info_with_marks;
    }

    function printMarks($marks){
        echo "<h3> Marks </h3> <br>";
        echo "Course 1: " . $marks[6] . "<br>";
        echo "Course 2: " . $marks[7] . "<br>"; 
        echo "Course 3: " . $marks[8] . "<br>"; 
        echo "Course 4: " . $marks[9] . "<br>";

        echo "CGPA: " . $marks[18] . " Status: " .$marks[19]."<br>";
    }
    
    function databaseConnection(){
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "SemesterResult";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            echo "Connection failed: " . mysqli_connect_error();
            return null;
        }
        
        return $conn;
    }

    function dataEntry($conn, $marks){

        $sql = "INSERT INTO `StudentGrade`(`roll`, `name`,
        `course1`, `course1mark`, `course1point`, `course1grade`,
        `course2`, `course2mark`, `course2point`, `course2grade`,
        `course3`, `course3mark`, `course3point`, `course3grade`,
            `course4`, `course4mark`, `course4point`, `course4grade`,
            `cgpa`, `status`)
            VALUES ('$marks[0]','$marks[1]',
            '$marks[2]','$marks[6]','$marks[10]','$marks[14]'
            ,'$marks[3]','$marks[7]','$marks[11]','$marks[15]'
            ,'$marks[4]','$marks[8]','$marks[12]','$marks[16]'
            ,'$marks[5]','$marks[9]','$marks[13]','$marks[17]'
            ,'$marks[18]','$marks[19]')";
        
        
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    function dataView($conn){

        $sql = "SELECT * FROM StudentGrade";
        $result = mysqli_query($conn, $sql);
        
        echo "<table class='table table-dark'>";
        echo "<thead><tr>";
        echo "<th scope='col'>Roll</th>";
        echo "<th scope='col'>Name</th>";
        echo "<th scope='col'>Course1</th>";
        echo "<th scope='col'>Course1 Mark</th>";
        echo "<th scope='col'>Course1 Point</th>";
        echo "<th scope='col'>Course1 Grade</th>";
        echo "<th scope='col'>Course2</th>";
        echo "<th scope='col'>Course2 Mark<</th>";
        echo "<th scope='col'>Course2 Point</th>";
        echo "<th scope='col'>Course3 Grade</th>";
        echo "<th scope='col'>Course3</th>";
        echo "<th scope='col'>Course3 Mark<</th>";
        echo "<th scope='col'>Course3 Point</th>";
        echo "<th scope='col'>Course4 Grade</th>";
        echo "<th scope='col'>Course4</th>";
        echo "<th scope='col'>Course4 Mark<</th>";
        echo "<th scope='col'>Course4 Point</th>";
        echo "<th scope='col'>Course4 Grade</th>";
        echo "<th scope='col'>CGPA</th>";
        echo "<th scope='col'>Status</th>";
        echo "</tr></thead>";
        echo "<tbody>";
        
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo"<tr>";
                echo "<th scope='row'>'" . $row['roll'] . "'</th>";
                echo"<td>'" . $row['name'] . "'</td>";
                echo"<td>'" . $row['course1'] . "'</td>";
                echo"<td>'" . $row['course1mark'] . "'</td>";
                echo"<td>'" . $row['course1point'] . "'</td>";
                echo"<td>'" . $row['course1grade'] . "'</td>";
                echo"<td>'" . $row['course2'] . "'</td>";
                echo"<td>'" . $row['course2mark'] . "'</td>";
                echo"<td>'" . $row['course2point'] . "'</td>";
                echo"<td>'" . $row['course2grade'] . "'</td>";
                echo"<td>'" . $row['course3'] . "'</td>";
                echo"<td>'" . $row['course3mark'] . "'</td>";
                echo"<td>'" . $row['course3point'] . "'</td>";
                echo"<td>'" . $row['course3grade'] . "'</td>";
                echo"<td>'" . $row['course4'] . "'</td>";
                echo"<td>'" . $row['course4mark'] . "'</td>";
                echo"<td>'" . $row['course4point'] . "'</td>";
                echo"<td>'" . $row['course4grade'] . "'</td>";
                echo"<td>'" . $row['cgpa'] . "'</td>";
                echo"<td>'" . $row['status'] . "'</td>";
                echo "</tr>";
            }
          echo "</tbody></table>";  
        } else {
            echo "0 results";
        }

    }

    echo "<table class=/'table table-dark/'>";
    
    $student_info_with_marks = dataReceive();
    if($student_info_with_marks[0] != "" && $student_info_with_marks[1]!="")
    {
        printMarks($student_info_with_marks);

        $conn = databaseConnection();
        dataEntry($conn, $student_info_with_marks);
    
        dataView($conn);
    
        if ($conn != null)
            mysqli_close($conn);
    }
        
    
?>
</div>
</body>
</html>