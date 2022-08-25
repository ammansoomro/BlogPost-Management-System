<?php
include 'partials/header.php';

$query = "SELECT * FROM categories ORDER BY title ASC";
$result = mysqli_query($conn, $query);

$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;
?>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <?php if (isset($_SESSION['add-post'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?php $title ?>" placeholder="Title">
            <select name="category" id="">
                <?php while ($category = mysqli_fetch_assoc($result)) : ?>
                    <option value="<?php echo $category['id'] ?>"><?php echo $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="4" name="body" placeholder="Body"><?php echo $body ?></textarea>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" checked>
            </div>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <div class="form__control inline">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                    <label for="is_featured">Featured</label>
                </div>
            <?php endif ?>
            <button type="submit" name="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>

<!-- =================== END OF FORM =================== -->



<?php
include '../partials/footer.php';
?>