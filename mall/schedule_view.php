<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("schedule_id", $_GET)) {
    $schedule_id = $_GET["schedule_id"];
    $query = "select * from schedule where schedule_id = $schedule_id";
    $res = mysqli_query($conn, $query);
    $schedule = mysqli_fetch_assoc($res);
    if (!$schedule) {
        msg("프로그램이 존재하지 않습니다.");
    }
}

?>


    <div class="container fullwidth">

        <h3>프로그램 정보 상세 보기</h3>

        <p>
            <label for="schedule_id">스케줄 ID</label>
            <input readonly type="text" id="schedule_id" name="schedule_id" value="<?= $schedule['schedule_id'] ?>"/>
        </p>

        <p>
            <label for="schedule_name">스케줄 이름</label>
            <input readonly type="text" id="schedule_name" name="schedule_name" value="<?= $schedule['schedule_name'] ?>"/>
        </p>
        <p>
        <label for="maker">만든이</label>
        <input readonly type="text" id="maker" name="maker" value="<?= $schedule['maker'] ?>"/>
        </p>
		 <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>요일</th>
            <th>프로그램 이름</th>
            <th>시간(분)</th>
        </tr>
        </thead>
        <tbody>
        <?
        
$query = "select schedule_id,schedule_name, day, program_id,program_name, minute, FIELD(day,'월','화','수','목','금','토','일') as f 
from schedule natural join week natural join program
WHERE schedule_id=$schedule_id and day IN ('월','화','수','목','금','토','일')
ORDER BY FIELD(day,'월','화','수','목','금','토','일') ";
$res1 = mysqli_query($conn, $query);

			
        while ($row = mysqli_fetch_array($res1)) {
        	
            echo "<tr>";
            echo "<td>{$row['day']}</td>";
            echo "<td><a href='program_view.php?program_id={$row['program_id']}'>{$row['program_name']}</a></td>";
            echo "<td>{$row['minute']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>


    </div>
<? include("footer.php") ?>