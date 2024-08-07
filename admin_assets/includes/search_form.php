
<form method="GET" action="" class="row">
    <div class="col-md-6 mb-2">
        <input type="text" class="form-control" name="search" value="<?php echo $query ?>" placeholder="<?php echo $search_placeholder ?>">
    </div>
    <div class="col-md-6 mb-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="?" class="btn btn-secondary ml-2">Clear Search</a>
    </div>
</form>