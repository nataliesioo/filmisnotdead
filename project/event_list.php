<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $mode = "이벤트 등록하기";
    $action = "event_insert.php";

    $mode1 = "현상소 등록하기";
    $action = "studio_insert.php";
    
    
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from event natural join lab"; // film table
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where event_name like '%$search_keyword%' or lab_name like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    

    ?>
    
    <div align="center">
	<h4><b>이벤트</b></h4><br></div>
	
	<table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>이벤트</th>
            <th>이벤트 날짜</th>
          <!--  <th>등록일</th> -->
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='event_view.php?event_no={$row['event_no']}'>{$row['event_name']}</a></td>";
            echo "<td>{$row['date']}</td>";
      /**      echo "<td>{$row['added_datetime']}</td>";**/
            echo "<td width='10%'>
                <a href='event_form.php?event_no={$row['event_no']}'><button class='button primary small'>수정</button></a>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        
        /*  <a href='review_form.php?review_no={$row['review_no']}'><button class='button primary small'>수정</button></a> **/
        ?>
        </tbody>
    </table>
     <p align="center"><a href='event_form.php'><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button>
     <a href='studio_form.php'><button class="button primary large" onclick="javascript:return validate();"><?=$mode1?></button></p>

</div>
<? include("footer.php") ?>
