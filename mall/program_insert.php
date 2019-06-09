<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$program_name = $_POST['program_name'];
$sequence = $_POST['sequence'];
$workout_id = $_POST['workout_id'];
$workout_set = $_POST['workout_set'];

mysqli_query($conn, "start transaction;");//transaction 시작


$ret = mysqli_query($conn, "insert into program(program_name) values('$program_name')");


if(!$ret)
{
	mysqli_query($conn, "rollback;");//오류발생 시 rollback;
	echo mysqli_error($conn);
    msg('Query Error :'.mysqli_error($conn));

}
else
{
    
    $ret1 = mysqli_query($conn, "select * from program where program_name='$program_name'");
    if(!$ret)
	{
		mysqli_query($conn, "rollback;");//오류발생 시 rollback;
		echo mysqli_error($conn);
    	msg('Query Error :'.mysqli_error($conn));
	}
	else{
    	$row=mysqli_fetch_array($ret1);
    	$program_id = $row['program_id'];
    	$rek = mysqli_query($conn, "INSERT INTO sets VALUES ('$program_id','$sequence','$workout_id','$workout_set')");
    	if(!$rek){
    		mysqli_query($conn, "rollback;");//오류발생 시 rollback;
    		echo mysqli_error($conn);
    		msg('Query Error :rek'.mysqli_error($conn));
    		
    	}
    	else{
			mysqli_query($conn, "commit;");//오류 없을 시 commit;
    		s_msg ('성공적으로 입력 되었습니다');
    		echo "<meta http-equiv='refresh' content='0;url=program_list.php'>";
    	}
	}
}

?>

