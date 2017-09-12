<style>
    .field {
        clear: both;
        text-align: right;
        line-height: 25px;
    }
    label {
        float: left;
        padding-right: 10px;
    }
    form {
        float: left;
    }
</style>
<h1>Регистрация</h1>
<p>
    <a href="/">На главную</a>
    <button><a href="/login/logout/">Logout</a></button>
</p>
<p>
    Зарегистрированы? <a href="/login/">Авторизируйтесь</a>
</p>
<span><?= $data['message'] ?></span>
<br />
<form action="/registration/new/" method="post" enctype="multipart/form-data">
    <div class="field">
        <label for="login">Логин</label>
        <input type="text" name="login" id="login">
    </div>
    <div class="field">
        <label for="password1">Пароль</label>
        <input type="password" name="password1" id="password1">
    </div>
    <div class="field">
        <label for="password2">Пароль ещё раз</label>
        <input type="password" name="password2" id="password2">
    </div>
    <div class="field">
        <label for="name">Имя</label>
        <input type="text" name="name" id="name">
    </div>
    <div class="field">
        <label for="age">Возраст</label>
        <input type="text" name="age" id="age">
    </div>
    <div class="field">
        <label for="description">Описание</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div class="field">
        <label for="avatar">Аватар</label>
        <input type="file" name="avatar">
    </div>
    <div class="field">
        <input type="submit">
    </div>
</form>