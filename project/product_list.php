<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
	
    <?
    $mode = "필름 추가하기";
    $action = "product_insert.php";

    $mode1 = "제조사 등록하기";
    $action = "producer_insert.php";
    
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from film natural join producer natural join cat"; // film table
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where film_name like '%$search_keyword%' or producer_name like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    
    <div align="center">
	<h4><b>필름</b></h4><br></div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>필름 이름 </th>
            <th>필름 포맷</th>
            <th>필름 감도(ISO)</th>
            <th>필름 컷</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='product_view.php?film_no={$row['film_no']}'>{$row['film_name']}</a></td>";
            echo "<td>{$row['format']}</td>";
            echo "<td>{$row['iso']}</td>";
            echo "<td>{$row['cut']}</td>";
            /*
            <th>필름 종류</th>
            <th>필름 제조사</th>
            echo "<td>{$row['cat']}</td>";
            echo "<td>{$row['producer_name']}</td>";*/            
            echo "<td width='17%'>
                <a href='product_form.php?film_no={$row['film_no']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['film_no']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        
        ?>
        

        </tbody>
    </table>
    
     <p align="center"><a href='product_form.php'><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button>
     <a href='producer_form.php'><button class="button primary large" onclick="javascript:return validate();"><?=$mode1?></button></p>

    <script>
        function deleteConfirm(film_no) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "product_delete.php?film_no=" + film_no;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
