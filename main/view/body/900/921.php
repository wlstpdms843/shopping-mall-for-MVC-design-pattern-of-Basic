
<h2>상품정보 입력</h2><br/>
<form name="memberJoin" action="../controller/MainCTL.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="922">
<?php // 이 부분도 데이터베이스 테이블에서 읽어 와서 동적으로 변경 되도록 향후에 변경 한다. ?>
    카테고리 : <select name="pcategory"  placeholder="상품카테고리">
        <option value="S1">신발-Nike(S1)</option>
        <option value="S2">신발-adidas(S2)</option>
        <option value="S3">신발-Reebok(S3)</option>
        <option value="S4">신발-Jordan(S4)</option>
        <option value="U1">유니폼-Nomal(U1)</option>
        <option value="U2">유니폼-Team(U2)</option>
        <option value="B1">공-Star(B1)</option>
        <option value="B2">공-Nike(B2)</option>
        <option value="B3">공-Spalding(B3)</option>
        <option value="B4">공-wilson(B4)</option>
    </select>	
    <br/>
    <input type="hidden" name="pcode"  placeholder="상품코드"><br/>
    <input type="text" name="pname"  placeholder="상품명"><br/>
    <input type="text" name="pstock"  placeholder="재고량"><br/>
    <input type="text" name="pprice"  placeholder="상품가격"><br/>
    <input type="file" name="pfimage"><br/>
    <input type="reset" value="취소">
    <input type="submit" value="저장"><br/>
</form>
