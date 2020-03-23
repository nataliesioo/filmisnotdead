<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "product_insert.php";

if (array_key_exists("film_no", $_GET)) {
    $film_no = $_GET["film_no"];
    $query =  "select * from film natural join producer natural join cat where film_no = $film_no;";
    $res = mysqli_query($conn, $query);
    $film = mysqli_fetch_array($res);
    if(!$film) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "product_modify.php";
}

$producer = array();
$query = "select * from producer";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $producer[$row['producer_name']] = $row['producer_name'];
}

$cat = array();
$query = "select * from cat";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $cat[$row['cat_name']] = $row['cat_name'];
    
}
?>
    <div class="container">
        <form name="product_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="film_no" value="<?=$film['film_no']?>"/>
            <h3>필름 정보 <?=$mode?></h3> 
            <p>
                <label for="film_name">필름명</label>
                <input type="text" placeholder="필름명 입력" id="film_name" name="film_name" value="<?=$film['film_name']?>"/>
            </p>
           
            <p>
                <label for="format">포맷</label>
                <input type="text" placeholder="필름 포맷 입력" id="format" name="format" value="<?=$film['format']?>"/>
            </p>

            <p>
                <label for="iso">감도(ISO)</label>
                <input type="text" placeholder="필름 감도 입력" id="iso" name="iso" value="<?=$film['iso']?>"/>
            </p>
            
            <p>
                <label for="cut">컷수</label>
                <input type="text" placeholder="필름 컷수 입력" id="cut" name="cut" value="<?=$film['cut']?>"/>
            </p>

            <p>
                <label for="cat_name">종류</label>
                <select name="cat_name" id="cat_name">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($cat as $id => $name) {
                            if($id == $cat['cat_name']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>

            <p>
                <label for="producer_name">제조사</label>
                <select name="producer_name" id="producer_name">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($producer as $id => $name) {
                            if($id == $producer['producer_name']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p> 
            
            <!-- <p>
                <label for="product_desc">상품설명</label>
                <textarea placeholder="상품설명 입력" id="product_desc" name="product_desc" rows="10"><?=$product['product_desc']?></textarea>
            </p> -->
            
            
            <script>	
                function validate() {
                    if(document.getElementById("film_name").value == "") {
                        alert ("필름명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("format").value == "") {
                        alert ("폼맷을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("iso").value == "") {
                        alert ("iso 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("cut").value == "") {
                        alert ("cut 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("cat_name").value == "-1") {
                        alert ("종류를 선택해 주십시오"); return false;
                    }
                    
                    else if(document.getElementById("producer_name").value == "-1") {
                        alert ("제조사를 선택해 주십시오"); return false;
                    }

                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>