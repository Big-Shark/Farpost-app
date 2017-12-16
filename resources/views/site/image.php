<form id="loadFile">
    <input type="file" name="img">
    <input type="submit" name="submit" value="Загрузить">
</form>

<div id="log">Прогресс загрузки</div>

<ul id="image">
    <?php foreach ($images as $image) : ?>
        <li style="list-style-type: none">
            <a href="show/<?= $image['id']?>" target="_blank">
                <img src="/UploadedFiles/<?= $image['img'] ?>" width="100" height="100"">
            </a>
        </li>
    <?php endforeach; ?>
</ul>