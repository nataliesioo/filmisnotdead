<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$lab_name = $_POST['lab_name'];
$tel = $_POST['tel'];
$lab_no = $_POST['lab_no'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "insert into lab set lab_name = \"$lab_name\", tel = \"$tel\"");

if(!$ret)
{
		mysqli_query($conn, "rollback"); // 현상소 등록 query 수행 실패. 수행 전으로 rollback
		alert_message('Query Error : '.mysqli_error($conn));
}

else{
	$lab_no = mysqli_insert_id($conn);
	mysqli_query($conn, "commit"); // 현상소 등록 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=studio_list.php'lab_no=$lab_no>";
}


?>

