<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$schedule_name = $_POST['schedule_name'];
$maker = $_POST['maker'];
$day = $_POST['day'];
$program_id = $_POST['program_id'];
$minute = $_POST['minute'];

$ret = mysqli_query($conn, "insert into schedule(schedule_name,maker) values('$schedule_name','$maker')");


if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error :'.mysqli_error($conn));

}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    $ret1 = mysqli_query($conn, "select * from schedule where schedule_name='$schedule_name' and maker='$maker'");
    $row=mysqli_fetch_array($ret1);
    $schedule_id = $row['schedule_id'];
    $rek = mysqli_query($conn, "INSERT INTO week VALUES ('$schedule_id','$day','$program_id','$minute')");
    if(!$rek){echo mysqli_error($conn);
    msg('Query Error :rek'.mysqli_error($conn));}
    echo "<meta http-equiv='refresh' content='0;url=schedule_list.php'>";
}

?>

