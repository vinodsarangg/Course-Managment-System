<?php
session_start();




if (!isset($_SESSION['CourseData'])) {
    $_SESSION['CourseData'] = [];
}

if($_SERVER['REQUEST_METHOD'] == 'POST' ){

if(isset($_POST['submit'])){
   $newCourseData=array(
    'CourseName' => $_POST['Coursename'],
    'EnrolledStudents' => $_POST['enrolledStudents'],
    'Instructor' => $_POST['Instructor'],
    'Duration' => $_POST['Duration'],
   );
   $_SESSION['CourseData'][] =$newCourseData;
   
   $_SESSION['message2']="Data Added Successfully";

   header("Location: " . $_SERVER['PHP_SELF']);
   exit;

}

if(isset($_POST['DeleteRecord'])){

    array_splice($_SESSION['CourseData'],$_POST['DeleteRecord'],1);
    $_SESSION['message']="Data Deleted Successfully";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


if(isset($_POST['UpdateRecord'])){
    $index=(int)$_POST['edit'];
    $newCourseData=array(
     'CourseName' => $_POST['Coursename'],
     'EnrolledStudents' => $_POST['enrolledStudents'],
     'Instructor' => $_POST['Instructor'],
     'Duration' => $_POST['Duration'],
    );
    $_SESSION['CourseData'][$_POST['edit']] =$newCourseData;
    $_SESSION['message1']="Data Updated Successfully";

 
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
 
 }

}
?>

<?php
include('Course.php');

?>
