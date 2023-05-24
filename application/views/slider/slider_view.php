<div class="row">
    <div class="col-md-11"></div>
    <div class="col-md-1">
        <a href="<?= base_url('slider/add') ?>" class="btn btn-primary btn-user btn-circle" title="Add Slider"><i class="fas fa-plus"></i></a>
    </div>
</div>
<table class="table mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($slider as $a) { ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $a['title']; ?></td>
                <td><?= $a['description']; ?></td>
                <td><?= $a['image']; ?></td>
                <td>
                    <a href="<?= base_url('slider/edit') . '/' . $a['id']; ?>" class="badge badge-success"><i class="fas fa-pen"></i> Edit</a>
                    <a href="<?= base_url('slider/delete') . '/' . $a['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $a['title']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>