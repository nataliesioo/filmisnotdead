<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$film_name = $_POST['film_name'];
$format = $_POST['format'];
$iso = $_POST['iso'];
$cut = $_POST['cut'];
$cat_name = $_POST['cat_name'];
$producer_name = $_POST['producer_name'];

$ret = mysqli_query($conn, "insert into film (film_name, format, iso, cut, cat_name,producer_name) values('$film_name', '$format', '$iso', '$cut','$cat_name','$producer_name' )");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_list.php'>";
}

?>

