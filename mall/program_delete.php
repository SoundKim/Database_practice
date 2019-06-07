<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$program_id = $_GET['program_id'];

$ret = mysqli_query($conn, "delete from program where program_id = $program_id");

if(!$ret)
{
	echo 'delete error 다른 프로그램에서 이 운동을 사용중이므로 지울 수 없습니다';
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=program_list.php'>";
}

?>

