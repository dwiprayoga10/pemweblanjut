<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>

<div class="mt-4">
<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success text-center text-capitalize">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('failed')): ?>
    <div class="alert alert-danger text-center text-capitalize">
        <?= session()->getFlashdata('failed') ?>
    </div>
<?php endif; ?>
<h1 class="text-center">User Management</h1>

<table class="table table-bordered mt-4">
    <thead>
        <tr class="text-center">
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
            <th scope="col">Confirm</th>
        </tr>
    </thead>
    <tbody>
    <?php $id = 1; ?>
    <?php foreach ($users as $user): ?>
    <tr>
        <td scope="row" class="align-middle text-center"><?= $id++ ?></td>
        <td class="align-middle text-center text-capitalize"><?= $user['username'] ?></td>
        <td class="align-middle text-center text-capitalize"><?= $user['is_aktif'] ?></td>
        <td class="align-middle text-center">
            <div class="d-flex justify-content-center align-items-center gap-2">
                <form action="<?= base_url('user/' . $user['id']) ?>" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-link border-none">
                        <i class="bi bi-person-x fs-2 text-danger"></i>
                    </button>
                </form>
                <a href="<?= base_url('users/update/' . $user['id']) ?>">
                    <i class="bi bi-person-check fs-2 text-info"></i>
                </a>
            </div>
        </td>
    </tr>
    
<?php endforeach; ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
