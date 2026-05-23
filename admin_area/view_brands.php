<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered mt-5">
    <thead class="table-info text-center">
        <th>Sl no</th>
        <th>Brands Title</th>
        <th>Edit</th>
        <th>Delete</th>

    </thead>
    <tbody class="table-secondary text-dark text-center">
        <?php
        $select_cat = "select * from `brands`";
        $result_cat = mysqli_query($con, $select_cat);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result_cat)) {
            $brands_id = $row['brands_id'];
            $brands_title = $row['brands_title'];
            $number++;
            ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $brands_title; ?> </td>
                <td><a href='index.php?edit_brands=<?php echo $brands_id ?>' class='text-dark'><i
                            class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_brands=<?php echo $brands_id ?>' type='button' class='text-dark'
                        data-bs-toggle='modal' data-bs-target='#staticBackdrop'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-body">
                <h4>Are you sure you want to delete this?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a
                        href="./index.php?view_brands" class="text-light text-decoration-none">No</a></button>
                <button type="button" class="btn btn-primary"><a
                        href='index.php?delete_brands=<?php echo $brands_id ?>'  class="text-light text-decoration-none">Yes</a></button>
            </div>
        </div>
    </div>
</div>