<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список постов</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h3>Список постов</h3>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Обложка</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Текст</th>
            <th scope="col">Последнее изменение</th>
            <th scope="col">options</th>
        </tr>
        <tr>
            <td colspan="8">
                <a class="btn btn-success" href="/posts/create">ДОБАВИТЬ ПОСТ</a>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($args['posts']) > 0) {
            foreach ($args['posts'] as $post) {
                ?>
                <tr>
                    <th scope="row">
                        <a href="/posts/show?id=<?php echo $post['id'] ?>">
                            <?php echo $post['id'] ?>
                        </a>
                    </th>
                    <td>
                        <?php
                        if(isset($post['cover'])) { ?>
                            <img src="/<?php echo $post['cover'] ?>" />;
                        <?php }
                         ?>
                    </td>
                    <td><?php echo $post['title'] ?></td>
                    <td><?php echo $post['description'] ?></td>
                    <td><?php echo $post['last_date'] ?></td>
                    <td>
                        <a href="/posts/edit?id=<?php echo $post['id'] ?>">ред.</a>
                        <span class="del" data-id="<?php echo $post['id'] ?>">удал.</span>
                    </td>
                </tr>
                <?php
            } // end foreach
        } // end if
        else {
            ?>
            <tr>
                <td colspan="8" class="alert-danger">
                    Нет добавленных записей [ <a href="/posts/create">Добавить</a> ]
                </td>
            </tr>
            <?php
        } // end else
        ?>
        </tbody>
    </table>
    <script src="/js/posts/delete.js"></script>
</body>
</html>