<?php
/**
 * Created by PhpStorm.
 * User: hydee
 * Date: 3/10/17
 * Time: 7:14 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'].'/codebag/ecommerce_tutorial/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';

$sql = "SELECT * FROM categories WHERE parent = 0";
$result = $db->query($sql);
$errors = array();
//Process form
if (isset($_POST) && !empty($_POST)){
    $parent = sanitize($_POST['parent']);
    $category = sanitize($_POST['category']);
    $sql_form = "SELECT * FROM categories WHERE category = '$category' AND parent = '$parent'";
    $fresult = $db->query($sql_form);
    $count = mysqli_num_rows($fresult);
//    if category is blank
    if ($category == ''){
        $errors[] = 'The category cannot be left blank.';
    }

//    if it exist in the DB
    if ($count > 0){
        $errors[] = $category. 'already exists. Please choose a new company';
    }
//    Display errors or Update Database
    if (!empty($errors)){
//        display errors
        $display = display_errors($errors);?>
        <script>
            jQuery('document').ready(function () {
                jQuery('#errors').html('<?= $display?>')
            })
        </script>
        <?php }else{
//        update database
        $updatesql = "INSERT INTO categories (category, parent) VALUES('$category','$parent')";
        $db->query($updatesql);
    }


}
?>
<h2 class="text-center">Categories</h2>
<hr>
<div class="row">

<!--    Rows-->
    <div class="col-md-6">
        <form action="categories.php" method="post" class="form">
            <legend>Add A Categpry</legend>
            <div id="errors"></div>
            <div class="form-group">
                <label for="parent">Parent</label>
                <select class="form-control" name="parent" id="parent">
                    <option value="0">Parent</option>
                    <?php while ($parent = mysqli_fetch_assoc($result)) :?>
                        <option value="<?= $parent['id']?>"><?= $parent['category']?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category">
            </div>
            <div class="form-group">
                <input type="submit" value="Add Category" class="btn btn-success">
            </div>
        </form>
    </div>

<!--    Categories-->
    <div class="col-md-6">
        <table class="table table-bordered">
            <thead>
                <th>Category</th>
                <th>Parent</th>
                <th></th>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM categories WHERE parent = 0";
            $result = $db->query($sql);
            while ($parent = mysqli_fetch_assoc($result)):
                $parent_id = (int)$parent['id'];
                $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
                $cresult = $db->query($sql2);
                ?>
                <tr class="bg-primary">
                    <td><?= $parent['category'];?></td>
                    <td>Parents</td>
                    <td>
                        <a href="categories.php?edit=<?=$parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="categories.php?delete=<?=$parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                    </td>
                </tr>
                <?php while ($child = mysqli_fetch_assoc($cresult)): ?>
                <tr class="bg-info">
                    <td><?= $child['category'];?></td>
                    <td><?= $parent['category']; ?></td>
                    <td>
                        <a href="categories.php?edit=<?=$child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="categories.php?delete=<?=$child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
