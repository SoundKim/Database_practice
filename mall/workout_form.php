<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "workout_insert.php";

if (array_key_exists("workout_id", $_GET)) {
    $workout_id = $_GET["workout_id"];
    $query =  "select * from workout where workout_id = $workout_id";
    $res = mysqli_query($conn, $query);
    $workout = mysqli_fetch_array($res);
    if(!$workout) {
        msg("운동이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "workout_modify.php";


}
?>
    <div class="container">
        <form name="workout_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="workout_id" value="<?=$workout['workout_id']?>"/>
            <h3>운동 정보 <?=$mode?></h3>

            <p>
                <label for="workout_name">운동 이름</label>
                <input type="text" placeholder="운동이름 입력" id="workout_name" name="workout_name" value="<?=$workout['workout_name']?>"/>
            </p>
            <p>
                <label for="workout_type">운동타입</label>
                <select name="workout_type" id="workout_type">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                      echo "<option value='상체'>상체</option>";
                      echo "<option value='하체'>하체</option>";
                      echo "<option value='코어'>코어</option>";
                    ?>
                </select>
            </p>
            <button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button>

            <script>
                function validate() {
                    if(document.getElementById("workout_type").value == "-1") {
                        alert ("운동 타입을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("workout_name").value == "") {
                        alert ("운동이름을을 입력해 주십시오"); return false;
                    }

                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>