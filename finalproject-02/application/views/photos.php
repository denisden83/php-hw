<style>
    figure {
        float: left;
        border: solid lime;
    }
</style>
<h1>Кликните на картинку чтобы изменить</h1>
<p>
    <a href="/">На главную</a>
</p>
<?php foreach ($data as $item) : ?>
    <a href="/file/change/<?= $item['id'] ?>">
        <figure>
            <figcaption><?= $item['name'] ?></figcaption>
            <img src="/photos/<?= $item['photo'] ?>" height="200" width="200" alt="аватар">
        </figure>
    </a>
<?php endforeach; ?>