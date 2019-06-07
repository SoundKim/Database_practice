<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$schedule_id = $_POST['schedule_id'];
$day = $_POST['day'];
$program_id = $_POST['program_id'];
$minute = $_POST['minute'];

$ret = mysqli_query($conn, "INSERT INTO week VALUES ('$schedule_id','$day','$program_id','$minute')");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 추가 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=schedule_list.php'>";
}

?>

