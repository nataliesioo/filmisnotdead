<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "작성";
$action = "review_insert.php";

if (array_key_exists("review_no", $_GET)) {
    $review_no = $_GET["review_no"];
    $query =  "select * from film natural join review where review_no = $review_no;";
    $res = mysqli_query($conn, $query);
    $review = mysqli_fetch_array($res);
    if(!$review) {
        msg("물품이 존재하지 않습니다.");
    }
 /**   $mode = "수정";
    $action = "product_modify.php";*/
}

$film = array();
$query = "select * from film";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $film[$row['film_name']] = $row['film_name'];
    
}

?>
    <div class="container">
        <form name="review_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="review_no" value="<?=$review['review_no']?>"/>
            <h3>후기 <?=$mode?></h3> 
            <p>
                <label for="title">제목</label>
                <input type="text" placeholder="제목 입력" id="title" name="title" value="<?=$review['title']?>"/>
            </p>
           
            <p>
                <label for="film_name">필름</label>
                <select name="film_name" id="film_name">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($film as $id => $name) {
                            if($id == $film['film_name']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            
            <p>
                <label for="content">후기</label>
                <textarea placeholder="후기 입력" id="content" name="content" rows="10"><?=$review['content']?></textarea>
            </p>
            
            <p>
                <label for="camera">카메라</label>
                <input type="text" placeholder="카메라 입력" id="camera" name="camera" value="<?=$review['camera']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>


            <script>	
                function validate() {
                    if(document.getElementById("title").value == "") {
                        alert ("제목 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("film_name").value == "-1") {
                        alert ("필름을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("content").value == "") {
                        alert ("후기를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("camera").value == "") {
                        alert ("카메라 입력해 주십시오"); return false;
                    }

                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>