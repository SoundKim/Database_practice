<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("program_id", $_GET)) {
    $program_id = $_GET["program_id"];
    $query = "select * from program where program_id = $program_id";
    $res = mysqli_query($conn, $query);
    $program = mysqli_fetch_assoc($res);
    if (!$program) {
        msg("프로그램이 존재하지 않습니다.");
    }
}

?>


    <div class="container fullwidth">

        <h3>프로그램 정보 상세 보기</h3>

        <p>
            <label for="program_id">프로그램 ID</label>
            <input readonly type="text" id="program_id" name="program_id" value="<?= $program['program_id'] ?>"/>
        </p>

        <p>
            <label for="program_name">프로그램 이름</label>
            <input readonly type="text" id="program_name" name="program_name" value="<?= $program['program_name'] ?>"/>
        </p>
        <p>
        <label for="program_id">운동 순서</label>
        </p>
		 <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>순서</th>
            <th>운동 이름</th>
            <th>세트 수</th>
        </tr>
        </thead>
        <tbody>
        <?
        
$query = "select * from program natural join sets natural join workout where program_id = $program_id";
$res = mysqli_query($conn, $query);
$program = mysqli_fetch_assoc($res);


        echo "<tr>";
        echo "<td>{$program['sequence']}</td>";
        echo "<td><a href='workout_view.php?workout_id={$program['workout_id']}'>{$program['workout_name']}</a></td>";
        echo "<td>{$program['workout_set']}</td>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['sequence']}</td>";
            echo "<td><a href='workout_view.php?workout_id={$row['workout_id']}'>{$row['workout_name']}</a></td>";
            echo "<td>{$row['workout_set']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>


    </div>
<? include("footer.php") ?>