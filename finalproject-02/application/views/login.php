<h1>Авторизация</h1>
<p>
    <a href="/">На главную</a>
    <button><a href="/login/logout/">Logout</a></button>
</p>
<p>
    Нет аккаунта? <a href="/registration/">Зарегистрируйтесь</a>
</p>
<span style="color: red;"><?= $data['message'] ?></span>
<br /><br />
<form action="/login/authorization/" method="post">
    <label for="login">Логин</label>
    <input type="text" name="login" id="login">
    <br />
    <label for="password">Пароль</label>
    <input type="text" name="password" id="password">
    <br />
    <input type="submit" value="авторизироваться">
</form>
<br />
