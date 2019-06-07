<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "program_insert.php";

if (array_key_exists("program_id", $_GET)) {
    $program_id = $_GET["program_id"];
    $query =  "select * from program where program_id = $program_id";
    $res = mysqli_query($conn, $query);
    $program = mysqli_fetch_array($res);
    if(!$program) {
        msg("프로그램이 존재하지 않습니다.");
    }
    $mode = "운동 추가";
    $action = "program_modify.php";
    $query = "select max(sequence) as A from sets where program_id = $program_id";
    $res = mysqli_query($conn,$query);
    $high_seq= mysqli_fetch_array($res);
    $a = $high_seq['A'];

    
}

$workouts = array();
$query = "select * from workout";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $workouts[$row['workout_id']] = $row['workout_name'];
}
?>

    <div class="container">
        <form name="program_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="program_id" value="<?=$program['program_id']?>"/>
            <h3>프로그램 정보 <?=$mode?></h3>

            <p>
                <label for="program_name">프로그램 이름</label>
                <input type="text" placeholder="프로그램 이름 입력" id="program_name" name="program_name" value="<?=$program['program_name']?>" <? if($mode == '운동 추가') echo 'readonly';?> />
            </p>
            
            <?
            if($mode=='운동 추가') $row_index = $a + 1;
            else $row_index=1;
            ?>
			<p>
            	<label for="sequence">운동 순서/운동 이름/세트수</label> 
            	<input type="text" id="sequence" name="<?$row_index?>" value="<?=$program['sequence']=$row_index?>" readonly <?if($mode != '운동 추가') echo 'value="1"';?>/>
                <select name="workout_id" id="workout_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($workouts as $id => $name) {
                            if($id == $program['workout_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
                <input type="number" placeholder="세트 수 입력" id="workout_set" name="workout_set" value="<?=$program['workout_set']?>" min="1"/>
            </p>
            
            <div id="addWorkout">
            	
            </div>
            
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("program_name").value == "") {
                        alert ("프로그램 이름을을 입력해 주십시오"); return false;
                    }

                    return true;
                }
                
            </script>

        </form>
        
    </div>
    
<? include("footer.php") ?>