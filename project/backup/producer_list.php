<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from producer"; // film table
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where producer_name like '%$search_keyword%' or producer_name like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>제조사 이름 </th>
            <th>기능</th>
        </tr>
        </thead>
        
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td><a href='producer_view.php?producer_no={$row['producer_no']}'>{$row['producer_name']}</a></td>";
            /*echo "<td>{$row['film_name']}</td>";*/
            /*
            <th>필름 종류</th>
            <th>필름 제조사</th>
            echo "<td>{$row['cat']}</td>";
            echo "<td>{$row['producer_name']}</td>";*/            
            echo "<td width='17%'>
                <a href='product_form.php?film_no={$row['film_no']}'><button class='button primary small'>수정</button></a>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>

</div>
<? include("footer.php") ?>
