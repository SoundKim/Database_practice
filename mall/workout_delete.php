<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$workout_id = $_GET['workout_id'];

mysqli_query($conn, "start transaction;");//transaction 시작

$ret = mysqli_query($conn, "delete from workout where workout_id = $workout_id"); 
if(!$ret)
{
	mysqli_query($conn, "rollback;");//오류발생 시 rollback;
	echo 'delete error 다른 프로그램에서 이 운동을 사용중이므로 지울 수 없습니다.';
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit;");//오류 없을 시 commit;
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=workout_list.php'>";
}

?>

