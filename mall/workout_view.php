<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("workout_id", $_GET)) {
    $workout_id = $_GET["workout_id"];
    $query = "select * from workout where workout_id = $workout_id";
    $res = mysqli_query($conn, $query);
    $workout = mysqli_fetch_assoc($res);
    if (!$workout) {
        msg("운동이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>운동 정보 상세 보기</h3>

        <p>
            <label for="workout_id">운동 ID</label>
            <input readonly type="text" id="workout_id" name="workout_id" value="<?= $workout['workout_id'] ?>"/>
        </p>

        <p>
            <label for="workout_name">운동 이름</label>
            <input readonly type="text" id="workout_name" name="workout_name" value="<?= $workout['workout_name'] ?>"/>
        </p>

        <p>
            <label for="workout_type">운동 이름</label>
            <input readonly type="text" id="workout_type" name="workout_type" value="<?= $workout['workout_type'] ?>"/>
        </p>


    </div>
<? include("footer.php") ?>