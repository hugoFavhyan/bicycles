<?= view('templates/header', ['title' => 'Forgot Password']) ?>

<div class="container">
    <h2>Forgot Password</h2>
    <p>Enter your email address and we will send you a link to reset your password.</p>
    <form action="/forgot-password" method="post">
        <div class="form-group">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <button type="submit" style="background-color: #ffc107; color: #212529;">Send Reset Link</button>
    </form>
    <div class="links">
        <a href="/login">Back to login</a>
    </div>
</div>

<?= view('templates/footer') ?>
