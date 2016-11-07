<?php

//session_start();

$product = isset($_SESSION['product'])?$_SESSION['product']:null;

echo "<h2>";
echo($product['pcode']);
echo " 상품 수정</h2>";

if( ! $product ){
    echo "수정하고자 하는 데이터를 가져올 수 없습니다.<br/>";
    echo "<a href='../controller/MainCTL.php?action=923'>상품보기</a>";
}else{  ?>
    <form name="mem_modify" method="post" action="../controller/MainCTL.php" enctype="multipart/form-data">
        <input type="hidden" name="action" value="924">
        <table>
            <tr>
                <td>순번</td><td><input readonly="true" type="text" name="pnum" value="<?= $product['pnum'] ?>"></td>
            </tr>
            <tr>
                <td>카테고리</td><td><input readonly="true" type="text" name="pcategory"  value="<?= $product['pcategory'] ?>"></td>
            </tr>
            <tr>
                <td>상품코드</td><td><input readonly="true" type="text" name="pcode"  value="<?= $product['pcode'] ?>"></td>
            </tr>
            <tr>
                <td>상품명</td><td><input type="text" name="pname"  value="<?= $product['pname'] ?>"></td>
            </tr>
            <tr>
                <td>재고량</td><td><input type="text" name="pstock"  value="<?= $product['pstock'] ?>"></td>
            </tr>
            <tr>
                <td>상품가격</td><td><input type="text" name="pprice"  value="<?= $product['pprice'] ?>"></td>
            </tr>
            <tr>
                <td>기존이미지</td><td><img src="../../img/product/<?= $product['pfimage'] ?>"></td>
                <input type="hidden" name="pfimage" value="<?= $product['pfimage'] ?>">
                <input type="hidden" name="psimage" value="<?= $product['psimage'] ?>">
            </tr>
            <tr>
                <td colspan="2">
                    <input type="file" name="update_img">
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="reset" value="취소"><input type="submit" value="수정"></td>
            </tr>
        </table>
    </form>
<?php } ?>