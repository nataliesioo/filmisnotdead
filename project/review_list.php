<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $mode = "후기 작성하기";
    $action = "review_insert.php";
    
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from film natural join review"; // film table
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where film_name like '%$search_keyword%' or review_name like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    

    ?>
    
    <div align="center">
	<h4><b>필름 후기</b></h4><br></div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>제목</th>
            <th>필름</th>
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
            echo "<td><a href='review_view.php?review_no={$row['review_no']}'>{$row['title']}</a></td>";
            echo "<td>{$row['film_name']}</td>";
      /**      echo "<td>{$row['added_datetime']}</td>";**/
            echo "<td width='10%'>
                 <button onclick='javascript:deleteConfirm({$row['review_no']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        
        /*  <a href='review_form.php?review_no={$row['review_no']}'><button class='button primary small'>수정</button></a> **/
        ?>
        </tbody>
    </table>
     <p align="center"><a href='review_form.php'><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

    <script>
        function deleteConfirm(review_no) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "review_delete.php?review_no=" + review_no;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
