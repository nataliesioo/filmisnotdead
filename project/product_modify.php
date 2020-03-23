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

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "update film set film_name = \"$film_name\", format = \"$format\", iso = \"$iso\", cut = \"$cut\", cat_name = \"$cat_name\", producer_name = \"$producer_name\" where film_no = $film_no;");

if(!$ret){	
		mysqli_query($conn, "rollback"); // 필름 수정 query 수행 실패. 수행 전으로 rollback
		alert_message('Query Error : '.mysqli_error($conn));
	}
	

else{
	$film_no = mysqli_insert_id($conn);
	mysqli_query($conn, "commit"); // 필름 수정 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_list.php'film_no=$film_no>";
}

?>

