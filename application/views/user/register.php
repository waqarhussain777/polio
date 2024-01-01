<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-5"> <!-- Adjust top margin as needed -->
                    <h2 class="text-center">Register</h2>
                    <?php echo form_open('user/register'); ?>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Role (admin/worker)</label>
                            <select name="role" id="role" class="form-select">
                                <option value="admin">Admin</option>
                                <option value="polioworker">Worker</option>
                            </select>
                        </div>
                        <a href="<?php echo base_url('user/login'); ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                    <div class="mt-3">
                        <p>Already have an account? <a href="<?php echo base_url('user/login'); ?>">Login here</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
