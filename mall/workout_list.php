<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from workout";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where workout_name like '%$search_keyword%' or workout_type like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>NO</th>
            <th>운동이름</th>
            <th>운동타입</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='workout_view.php?workout_id={$row['workout_id']}'>{$row['workout_name']}</a></td>";
            echo "<td>{$row['workout_type']}</td>";

            echo "<td width='17%'>
                <a href='workout_form.php?workout_id={$row['workout_id']}'><button class='button primary small'>수정</button></a>

                 <button onclick='javascript:deleteConfirm({$row['workout_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(workout_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "workout_delete.php?workout_id=" + workout_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
