<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from schedule";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where schedule_name like '%$search_keyword%' or maker like '%$search_keyword%'";
    
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
            <th>스케줄 이름</th>
            <th>만든이</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='schedule_view.php?schedule_id={$row['schedule_id']}'>{$row['schedule_name']}</a></td>";
            echo "<td>{$row['maker']}</td>";
            echo "<td width='17%'>
                <a href='schedule_form.php?schedule_id={$row['schedule_id']}'><button class='button primary small'>추가</button></a>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>

</div>
<? include("footer.php") ?>
