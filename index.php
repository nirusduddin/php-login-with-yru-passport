<?php
@session_start();
require_once('YRUPassport.php')
?>
<html lang="en">
<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</header>
<body>
<div class="container p-3">
    <?php
    if (isset($_SESSION["PASSPORT_PROFILE"])) {
        $data = $_SESSION['PASSPORT_PROFILE'];
        ?>
        <table class="table table-sm table-bordered">
            <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Passport ID</td>
                <td><?= $data['id'] ?></td>
            </tr>
            <tr>
                <td>รูปภาพ (avatar)</td>
                <td><img src="<?= $data['avatar'] ?>" style="height:180px" alt=""></td>
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
                <td>คำนำหน้า (prefix)</td>
                <td><?= $data['prefix'] ?></td>
            </tr>
            <tr>
                <td>คำนำหน้าทางวิชาการ (prefix_edu)</td>
                <td><?= $data['prefix_edu'] ?></td>
            </tr>
            <tr>
                <td>ชื่อ - นามสกุล (name)</td>
                <td><?= $data['name'] ?></td>
            </tr>
            <tr>
                <td>หน่วยงาน / คณะ</td>
                <td>(<?= $data['department_id'] ?>) <?=$data['department'] ?></td>
            </tr>
            <tr>
                <td>ตำแหน่ง *เฉพาะบุคลากร</td>
                <td>(<?= $data['position_id'] ?>) <?=$data['position'] ?></td>
            </tr>
            <tr>
                <td>ประเภท (type)</td>
                <td><?= $data['type'] ?></td>
            </tr>
            <tr>
                <td>รหัสอ้างอิงตามประเภท (type_ref_id)</td>
                <td><?= $data['type_ref_id'] ?></td>
            </tr>
            <tr>
                <td>หลักสูตร *เฉพาะนักศึกษา</td>
                <td>(<?= $data['program_id'] ?>) <?=$data['program'] ?></td>
            </tr>
            <tbody>
        </table>

        <form action="logout.php">
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        <?php

    } else {
        ?>
        <p class="text-center p-3">
            <a href="<?= YRUPassport::getLink() ?>" class="btn btn-primary">Login with YRU Passport</a>
        </p>
        <?php
    }
    ?>
</div>
</body>
</html>