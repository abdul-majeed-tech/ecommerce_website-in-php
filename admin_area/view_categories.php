<h3 class="text-center text-sucess">All Categories</h3>
<table class="table table-bordered">
    <thead class="table-info text-center">
        <th>Sl no</th>
        <th>Category Title</th>
        <th>Edit</th>
        <th>Delete</th>

    </thead>
    <tbody class="table-secondary text-dark text-center">
        <?php
        $select_cat = "select * from `categories`";
        $result_cat = mysqli_query($con, $select_cat);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result_cat)) {
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            $number++;
            ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $category_title; ?> </td>
                <td><a href='index.php?edit_category=<?php echo $category_id ?>' class='text-dark'><i
                            class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_category=<?php echo $category_id ?>' class='text-dark'><i
                            class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>