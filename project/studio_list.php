<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $mode = "현상소 등록하기";
    $action = "studio_insert.php";
    
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from lab"; 
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where lab_name like '%$search_keyword%' ";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    

    ?>
    
    <div align="center">
	<h4><b>현상소</b></h4><br></div>
	
	<table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>현상소</th>
            <th>전화번호</th>
          <!--  <th>등록일</th> -->
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['lab_name']}</td>";
            echo "<td>{$row['tel']}</td>";
      /**      echo "<td>{$row['added_datetime']}</td>";**/
            echo "<td width='10%'>
                 <button onclick='javascript:deleteConfirm({$row['lab_no']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        
        /*  <a href='review_form.php?review_no={$row['review_no']}'><button class='button primary small'>수정</button></a> **/
        ?>
        </tbody>
    </table>
     <p align="center"><a href='studio_form.php'><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

    <script>
        function deleteConfirm(lab_no) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "studio_delete.php?lab_no=" + lab_no;
            }else{   //취소
                return;
            }
        }
    </script>
    
</div>
<? include("footer.php") ?>
