<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management System</title>
</head>
<body style="background-image: url('images/bg-image.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">

<?php
if (isset($_POST['edit'])) {
    $UpdatedCourse = $_SESSION['CourseData'][$_POST['edit']];
}
?>
<h2 class="h2 bg-dark text-light">Course Management System</h2>

<!-- Displaying message for knowledge -->
<div class="span">
<?php

//For Add data message
if (isset($_SESSION['message2'])) {
    echo "<span id='message2' class='text-light text-center'>" . $_SESSION['message2'] . "</span>";
}
//for Deleting Data
if (isset($_SESSION['message'])) {
    echo "<span id='message' class='text-light text-center'>" . $_SESSION['message'] . "</span>";
}

// Message for updating data
if (isset($_SESSION['message1'])) {
    echo "<span id='message1' class='text-light text-center'>" . $_SESSION['message1'] . "</span>";
}
?>
</div>
<!-- End of Message -->

<!-- Form for adding or updating course -->
<div class="form mb-5">
    <div class="center bg-dark" style="width:35%">
        <form action="" method="post" class="col-lg-6">
            <h3 class="text-light display-5 h3">Add Course</h3>
            
            <label for="" class="text-light">Course Name</label>
            <input type="text" name="Coursename" class="form-control mt-1" 
                value="<?php echo isset($UpdatedCourse['CourseName']) ? $UpdatedCourse['CourseName'] : ''; ?>" 
                placeholder="Course name" required>

            <label for="" class="text-light mt-3">Enrolled Students</label>
            <input type="number" name="enrolledStudents" class="form-control mt-1" 
                value="<?php echo isset($UpdatedCourse['EnrolledStudents']) ? $UpdatedCourse['EnrolledStudents'] : ''; ?>" 
                placeholder="Enrolled Students" required>

            <label for="" class="text-light mt-3">Instructor</label>
            <input type="text" name="Instructor" class="form-control mt-1" 
                value="<?php echo isset($UpdatedCourse['Instructor']) ? $UpdatedCourse['Instructor'] : ''; ?>" 
                placeholder="Instructor Name" required>

            <label for="" class="text-light mt-3">Duration</label>
            <input type="text" name="Duration" class="form-control mt-1" 
                value="<?php echo isset($UpdatedCourse['Duration']) ? $UpdatedCourse['Duration'] : ''; ?>" 
                placeholder="Course Duration" required>

            <div id="button-center" class="text-center mt-3">
                <?php if (isset($_POST['edit'])) { ?>
                    <input type="hidden" name="edit" value="<?php echo $_POST['edit']; ?>"> 
                    <button type="submit" name="UpdateRecord" class="btn btn-danger">Update</button>
                <?php } else { ?>
                    <button name="submit" class="btn btn-danger">Add</button>
                <?php } ?>
            </div>
        </form>
    </div>
</div>

<br><br><br>

<!-- Course Table -->
<form action="" method="post">
    <table class='table table-dark table-bordered'>
        <tr>
            <th>Course Id</th>
            <th>Course Name</th>
            <th>Enrolled Students</th>
            <th>Instructor</th>
            <th>Duration</th>
            <th>Actions</th>
        </tr>

        <?php
        if (!empty($_SESSION['CourseData'])) {
            foreach ($_SESSION['CourseData'] as $index => $newCourse) {
                echo "<tr>";
                echo "<td>" . (intval($index) + 1) . "</td>";
                echo isset($newCourse["CourseName"]) ? "<td>" . $newCourse["CourseName"] . "</td>" : '<td>N/A</td>';
                echo isset($newCourse["EnrolledStudents"]) ? "<td>" . $newCourse["EnrolledStudents"] . "</td>" : '<td>N/A</td>';
                echo isset($newCourse["Instructor"]) ? "<td>" . $newCourse["Instructor"] . "</td>" : '<td>N/A</td>';
                echo isset($newCourse["Duration"]) ? "<td>" . $newCourse["Duration"] . "</td>" : '<td>N/A</td>';

                echo "<td>
                        <button name='DeleteRecord' value='" . $index . "' class='btn btn-danger'><i class='fa fa-trash'></i></button>
                        <button name='edit' value=" . $index . " class='btn btn-success'><i class='fa fa-edit'></i></button>
                        <button name='view' class='btn btn-light' ><i class='fa fa-eye' onclick='viewCourse(".$index.")'></i></button>

                      </td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
<div class="overplay_background" id="overlay">
    <div  id="CardDetails" class="CardDetails"> 
        
    <i class='fa fa-times' style="text-align:right; cursor:pointer" onclick='closeCard()'></i>
        <p>Name<p id="CourseName"> </p></p>
        <p id="CourseDuration"></p>
        <p id="EnroledStudents"></p>
        <p id="Instructor"></p>
    </div>
    </div>
</form>

<footer class="bg-dark text-light mt-5 text-center">Copyright &copy; CMS</footer>

</body>

<?php
unset($_SESSION['message']);
unset($_SESSION['message1']);
unset($_SESSION['message2']);

?>
    <script src="js.js"></script>
    <script>
        function viewCourse(id) {
    event.preventDefault();

    // Fetch the PHP session data as valid JSON
    var CourseData = JSON.parse('<?php echo json_encode($_SESSION["CourseData"]); ?>');
  console.log(CourseData);
    // For debugging

    if (CourseData[id]) {

        // Display the course details in the overlay
        document.getElementById('overlay').style.display = "flex";
        document.getElementById('CardDetails').style.display = "flex";

        document.getElementById('CourseName').innerHTML = CourseData[id].CourseName;
        // console.log(CourseData[id].CourseName);
        document.getElementById('CourseDuration').innerHTML = CourseData[id].Duration;
        document.getElementById('EnroledStudents').innerHTML = CourseData[id].EnrolledStudents;
        document.getElementById('Instructor').innerHTML = CourseData[id].Instructor;
    }
}
     
function closeCard() {
    document.getElementById('overlay').style.display = "none";

    document.getElementById('CardDetails').style.display = "none";

}</script>

</html>
