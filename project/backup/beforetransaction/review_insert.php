<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$film_name = $_POST['film_name'];
$content = $_POST['content'];
$camera = $_POST['camera'];

$ret = mysqli_query($conn, "insert into review (title, content, camera, film_name) values('$title', '$content','$camera', '$film_name')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=review_list.php'>";
}

?>

