<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$workout_name = $_POST['workout_name'];
$workout_type = $_POST['workout_type'];

$ret = mysqli_query($conn, "insert into workout(workout_name, workout_type) values('$workout_name', '$workout_type')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=workout_list.php'>";
}

?>

