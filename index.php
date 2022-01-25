<?php

require_once 'config.php';
@session_start();

?>
<html>
<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</header>
<body>
<div class="container">
<?php

if (isset($_SESSION["userinfo"])) {
    // var_dump($_SESSION["userinfo"]);
    $data = $_SESSION['userinfo']['data'];
    ?>
    <table class="table table-sm table-bordered mt-3">
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>photo</td>
                <td><img src="<?= $data['avatar'] ?>" style="height:180px"></td>
            </tr>
            <tr>
                <td>username</td>
                <td><?= $data['username'] ?></td>
            </tr>
            <tr>
                <td>email</td>
                <td><?= $data['email'] ?></td>
            </tr>
            <tr>
                <td>name</td>
                <td><?= $data['name'] ?></td>
            </tr>
            <tr>
                <td>name</td>
                <td><?= $data['name'] ?></td>
            </tr>
            <tr>
                <td>type</td>
                <td><?= $data['type'] ?></td>
            </tr>
        <tbody>
    </table>

    <form action="logout.php">
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>

    <pre><?php echo json_encode($data, 256);?></pre>
    <?php

} else {

    $uri = "{$oauth['authorization_endpoint']}?client_id={$oauth['client_id']}&redirect_uri={$oauth['redirect_uri']}&response_type=code&scope=*";

    ?>

    <p class="text-center p-3">
        <a href="<?= $uri ?>" class="btn btn-primary">Login with Passport</a>
    </p>
    <?php
}

?>
</div>
</body>
</html>