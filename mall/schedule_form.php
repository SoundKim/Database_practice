<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "schedule_insert.php";

if (array_key_exists("schedule_id", $_GET)) {
    $schedule_id = $_GET["schedule_id"];
    $query =  "select * from schedule where schedule_id = $schedule_id";
    $res = mysqli_query($conn, $query);
    $schedule = mysqli_fetch_array($res);
    if(!$schedule) {
        msg("프로그램이 존재하지 않습니다.");
    }
    $mode = "추가";
    $action = "schedule_modify.php";

    
}

$programs = array();
$query = "select * from program";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $programs[$row['program_id']] = $row['program_name'];
}
?>

    <div class="container">
        <form name="schedule_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="schedule_id" value="<?=$schedule['schedule_id']?>"/>
            <h3>스케줄 정보 <?=$mode?></h3>

            <p>
                <label for="schedule_name">스케줄 이름</label>
                <input type="text" placeholder="스케줄 이름 입력" id="schedule_name" name="schedule_name" value="<?=$schedule['schedule_name']?>" <? if($mode == '추가') echo 'readonly';?> />
            </p>
            
            <p>
                <label for="schedule_name">만든이</label>
                <input type="text" placeholder="만든이 입력" id="maker" name="maker" value="<?=$schedule['maker']?>" <? if($mode == '추가') echo 'readonly';?>/>
            </p>
            
			<p>
            	<label for="sequence">프로그램별 요일/ 프로그램 이름/ 시간(분)</label> 
                <select name="day" id="day">
                    <option value="-1">요일</option>
                    <?
                      echo "<option value='월'>월</option>";
                      echo "<option value='화'>화</option>";
                      echo "<option value='수'>수</option>";
                      echo "<option value='목'>목</option>";
                      echo "<option value='금'>금</option>";
                      echo "<option value='토'>토</option>";
                      echo "<option value='일'>일</option>";
                    ?>
                </select>
                
                 <select name="program_id" id="program_id">
                    <option value="-1">프로그램</option>
                    <?
                        foreach($programs as $id => $name) {
                            if($id == $schedule['program_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
                <input type="number" placeholder="시간(분) 입력" id="minute" name="minute" value="<?=$schedule['minute']?>" min="1"/>
            	</label>
            </p>
            
            
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("schedule_name").value == "") {
                        alert ("스케줄 이름을을 입력해 주십시오"); return false;
                    }

                    return true;
                }
                
            </script>

        </form>
        
    </div>
    
<? include("footer.php") ?>