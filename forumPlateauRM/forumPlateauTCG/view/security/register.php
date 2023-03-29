<h1> Registration </h1>

<form action="index.php?ctrl=security&action=register" method="post" enctype="multipart">

    <input type="text" name="userName" placeholder="Pseudo" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>

    <button type="submit" name="submit"> Submit Registration </button>
</form>