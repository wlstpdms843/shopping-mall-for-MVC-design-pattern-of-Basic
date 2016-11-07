<style>
    label{
        float: left;
        width: 130px;
    }
</style>

<form action='../Controller/MainCTL.php' method='post'>
    <table border='0' align='center'>
        <tr>
            <th>
                <h1>회원가입 양식</h1>
            </th>
        </tr>
        <tr>
            <td><label>이름 : </label>
                <input type='text' name='name' required></td>
        </tr>
        <tr>
            <td><label>아이디 : </label>
                <input type='text' name='id' required></td>
        </tr>
        <tr>
            <td><label>비밀번호 : </label>
                <input type='password' name='password' required></td>
        </tr>
        <tr>
            <td><label>비밀번호 확인 : </label>
                <input type='password' name='Repassword' required></td>
        </tr>
        <tr>
            <td><label>핸드폰 번호 : </label>
                <input type='text' name='tel'></td>
        </tr>
        <tr>
            <td><label>주소 : </label>
                <input type='text' name='address' placeholder='ex) 대구 광역시 북구 복현동 xxx번지 xxx아파트 x동 x호' required></td>
        </tr>
        <tr>
            <td align="center">
                <input type='hidden' name='action' value=14>
                <input type='submit' value='가입하기' align='center'>
                <hr>
            </td>
        </tr>
    </table>
</form>
