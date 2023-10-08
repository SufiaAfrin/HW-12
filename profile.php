<?php
include "./backend_inc/header.php"
?>

<div class="container-fluid">
    <h2>Profile page</h2>

<div class="row">
    <div class="col-lg-8">
        <form action="../controller/profileUpdate.php" method="POST" enctype="multipart/form-data">
        <div class="row">
        <div class="col-lg-4">
        <label for="profile_img" style="width: 100%;"><img style="width: 200px; height: 200px; object-fit:cover;" class="profile_image"
        src="<?= isset($_SESSION['auth']['profile']) ? "../uploads/users/" . $_SESSION['auth']['profile'] : "https://api.dicebear.com/7.x/initials/svg?seed=" . $_SESSION['auth']['fname'] ?>" alt=""></label>
        <input name="profile_img" type="file" id="profile_img" class="profile_pic_selector d-none">
        </div>
        <div class="col-lg-8">
            <input name= "fname" value="<?= $_SESSION['auth']['fname']?>" class="form-control my-2" type="text" placeholder="First name">
            <input name= "lname" value="<?= $_SESSION['auth']['lname']?>" class="form-control my-2" type="text" placeholder="Last name">
            <input name= "email" value="<?= $_SESSION['auth']['email']?>" class="form-control my-2" type="text" placeholder="Email">
            
            <button class="btn btn-primary">Update</button>
        </div>
    </div>
    </form>
    </div>
    <div class="col-lg-3">
        <div class="card shadow p-3">
    <form action="">
            <input class="form-control my-3" type="password" placeholder="Old password">
            <input class="form-control my-3" type="password" placeholder="New password">
            <input class="form-control my-3" type="password" placeholder="Confirm password">
            <button class="btn btn-primary">Update</button>
            </div>
    </form>
    </div>

</div>


</div>



<script>
    let profileInput = document.querySelector('.profile_pic_selector')
    let profileImage = document.querySelector('.profile_img')

    function updateImage(event){
        let url = URL.createObjectURL(event.target.files[0]);
        profileImage.src = url
        console.log(url);
    }
    profileInput.addEventListener('change', updateImage)
</script>
