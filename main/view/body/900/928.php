<?php

//session_start();

$product = isset($_SESSION['product']) ? $_SESSION['product'] : null;
$retaction = isset($_REQUEST['retaction']) ? $_REQUEST['retaction'] : null;

$productImagePath = "../../img/product/"; // 상품이미지 저장 디렉토리
$ProductThumbnailPath = "../../img/product_s/"; // 상품 썸네일 이미지 저장 디렉토리
$staticImagePath = "../../img/static_img/"; // 정적 이미지 저장 디렉터리

$noImgFileName = "NOIMG.JPG"; // 이미지가 존재하지 않을 때 표시할 이미지 파일명
$fImgFileName = strval($productImagePath) . strval($product['pfimage']);

if (!file_exists($fImgFileName) || !$product['pfimage']) // 이미지 파일이 존재 하지 않거나 정보가 없다면 NOIMG.JPG파일로 대치
    $fImgFileName = strval($staticImagePath) . $noImgFileName;

echo "<h2>";
echo($product['pcode']);
echo " 상품 상세정보</h2>";

if (!$product) {
    echo "상품 상세보기 데이터를 가져올 수 없습니다.<br/>";
    echo "<a href='../controller/MainCTL.php?action=923'>상품보기</a>";
} else { ?>
    <table border="1">
        <tr>
            <td colspan='2'><img src=<?= $productImagePath ?><?= $fImgFileName ?> width=600 border="0"/></td>
            <td rowspan='11'>
                <form action="../controller/MainCTL.php?action=970" method="post">
                    <? if (substr($product['pcategory'], 0, 1) == 'S') {
                        ?>
                        사이즈 : <select name="size" placeholder="사이즈">
                            <option value="S250">250</option>
                            <option value="S260">260</option>
                            <option value="S270">270</option>
                            <option value="S280">280</option>
                            <option value="S290">290</option>
                        </select>
                        <br>
                        <br>
                        색상 : <select name="color" placeholder="색상">
                            <option value="B/R">검빨</option>
                            <option value="W/B">흰검</option>
                            <option value="W/R">흰빨</option>
                        </select>
                        <br>
                        <br>
                        갯수 : <input type="text" name="cnt" required>
                        <input type="hidden"
                    <? } else if (substr($product['pcategory'], 0, 1) == 'U') { ?>
                        사이즈 : <select name="size" placeholder="사이즈">
                            <option value="Usmall">small</option>
                            <option value="Umiddle">middle</option>
                            <option value="Ularge">large</option>
                            <option value="Uxlarge">xlarge</option>
                        </select>
                        <br>
                        <br>
                        색상 : <select name="color" placeholder="색상">
                            <option value="Home">Home</option>
                            <option value="Away">Away</option>
                        </select>
                        <br>
                        <br>
                        갯수 : <input type="text" name="cnt" required>
                    <? } else if (substr($product['pcategory'], 0, 1) == 'B') { ?>
                        갯수 : <input type="text" name="cnt">
                    <? } ?>
                    <br>
                    <br>
                    <input type="submit" value="구매하기" required>
                    <input type="hidden" name="pnum" value=<? echo $product['pnum']?>>
                    <input type="hidden" name="pname" value=<? echo $product['pname']?>>
                    <input type="hidden" name="pprice" value=<? echo $product['pprice']?>>
                </form>
            </td>
            <td rowspan='11'>
                <font color='red'>
                    미션:구매관련액션처리<br/><br/>
                    <li>옵션선택<br/>
                    <li>수량선택<br/>
                    <li>장바구니<br/>
                    <li>바로구매<br/>
                    <li>모바일구매<br/>
                    <li>관심상품등록 etc.,<br/>
                </font>
            </td>
        </tr>
        <tr>
        <tr>
            <td width='100'>일련번호</td>
            <td><?= $product['pnum'] ?></td>
        </tr>
        <tr>
            <td width='100'>카테고리</td>
            <td><?= $product['pcategory'] ?></td>
        </tr>
        <tr>
            <td width='100'>상품코드</td>
            <td><?= $product['pcode'] ?></td>
        </tr>
        <tr>
            <td width='100'>상품명</td>
            <td><?= $product['pname'] ?></td>
        </tr>
        <tr>
            <td width='100'>재고량</td>
            <td><?= $product['pstock'] ?></td>
        </tr>
        <tr>
            <td width='100'>상품가격</td>
            <td><?= $product['pprice'] ?></td>
        </tr>
        <tr>
            <td width='100'>이미지</td>
            <td><?= $product['pfimage'] ?></td>
        </tr>
        <tr>
            <td width='100'>썸네일</td>
            <td><?= $product['psimage'] ?></td>
        </tr>
        </tr>
        <tr>
            <td colspan='2'>
                <a href=../controller/MainCTL.php?action=<?= $retaction ?>>이전목록가기</a>
            </td>

        </tr>


    </table>


<?php } ?>