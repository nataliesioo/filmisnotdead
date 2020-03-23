<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$review_no = $_GET['review_no'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "delete from review where review_no = \"$review_no\"");

if(!$ret)
{
		mysqli_query($conn, "rollback"); // 후기 삭제 query 수행 실패. 수행 전으로 rollback
		alert_message('Query Error : '.mysqli_error($conn));
}


else{
	$review_no = mysqli_insert_id($conn);
	mysqli_query($conn, "commit"); // 후기 삭제 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=review_list.php'review_no=$review_no>";
}

?>

