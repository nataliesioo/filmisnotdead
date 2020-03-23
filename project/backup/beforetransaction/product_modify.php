<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$film_no = $_POST['film_no'];
$film_name = $_POST['film_name'];
$format = $_POST['format'];
$iso = $_POST['iso'];
$cut = $_POST['cut'];
$producer_name = $_POST['producer_name'];
$cat_name = $_POST['cat_name'];

$ret = mysqli_query($conn, "update film set film_name = '$film_name', format = '$format',iso = '$iso', producer_name = '$producer_name', cat_name = '$cat_name' where film_no = $film_no;");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_list.php'>";
}

?>

