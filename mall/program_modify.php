<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$program_id = $_POST['program_id'];
$sequence = $_POST['sequence'];
$workout_id = $_POST['workout_id'];
$workout_set = $_POST['workout_set'];

mysqli_query($conn, "start transaction;");//transaction 시작
$rek = mysqli_query($conn, "INSERT INTO sets VALUES ('$program_id','$sequence','$workout_id','$workout_set')");

if(!$ret)
{
	mysqli_query($conn, "rollback;");//오류발생 시 rollback;
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit;");//오류 없을 시 commit;
    s_msg ('성공적으로 추가 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=program_list.php'>";
}

?>

