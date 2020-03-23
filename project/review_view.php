<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $mode = "뒤로 가기";

if (array_key_exists("review_no", $_GET)) {
    $review_no = $_GET["review_no"];
    $query = "select * from review natural join film where review_no = $review_no";
    $res = mysqli_query($conn, $query);
    $review = mysqli_fetch_assoc($res);
    if(!$review) {
        msg("후기 존재하지 않습니다.");
    }
}

?>

<div class="container fullwidth">

        <br>
        <h3><b>필름 후기 상세 보기</h3></b>
        <br>
        
      <!--  <p>
            <label for="review_no">No.</label>
            <input readonly type="text" id="review_no" name="review_no" value="<?= $review['review_no'] ?>"/>
        </p> -->

        <p>
            <label for="title">제목</label>
            <input readonly type="text" id="title" name="title" value="<?= $review['title'] ?>"/>
        </p>
        
        <p>
            <label for="film_name">필름</label>
            <input readonly type="text" id="film_name" name="film_name" value="<?= $review['film_name'] ?>"/>
        </p>


        <p>
            <label for="content">후기</label>
            <textarea readonly id="content" name="content" rows="10"><?= $review['content'] ?></textarea>
        </p>

        <p>
            <label for="camera">카메라</label>
            <input readonly type="text" id="camera" name="camera" value="<?= $review['camera'] ?>"/>
        </p>

     <br><p align="center"><a href='review_list.php'><button class="button primary small" onclick="javascript:return validate();"><?=$mode?></button>

    </div>
<? include("footer.php") ?>