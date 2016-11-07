<style type="text/css">
    @import url = (/Css/aLinkNoUnderLine.css);
</style>

<?php
include_once "./Header.php";


?>
<html>
<meta charset="utf-8">
<title>Myshop</title>

</html>
<body bgcolor="#6495ed">
<table width="1600" height="800" border='0' align="center">
    <tr>
        <td colspan="2" align="center">
            <a href="../controller/MainCTL.php?action=100"><img src="./Img/top.png" align="center"></a>
            <br></td>
    </tr>

    <tr>
        <td colspan="2" width="800" height="100"><?php include "./TitleAndLogin.php" ?></td>
    </tr>

    <tr>
        <td colspan="2" width="800" height="50"><?php include_once "./MainMenu.php" ?></td>
    </tr>
    <?php if ($userLevel == 999) { // 사용자 등급이 관리자 라면 ?>

        <tr>
            <td colspan="2" width="800" height="50"><?php include_once "./AdminMainMenu.php" ?></td>
        </tr>
    <?php } ?>


    <?php if ($mainMenuShortNum > 0 && $mainMenuShortNum <= 5) { ?>
        <tr>
            <td width='150' height='400'><?php include './LeftMenu.php' ?></td>
            <td width='650' height='400'><?php include './MainBody.php' ?></td>
        </tr>
    <?php } else if ($mainMenuShortNum < 1 || $mainMenuShortNum > 5) { ?>
        <tr>
            <td width='650' height='400' colspan='2'><?php include './MainBody.php' ?></td>
        </tr>
    <?php } ?>


    <tr>
        <td colspan="2" width="800" height="50"><?php include "./Copyright.php" ?></td>
    </tr>
</table>

</body>
