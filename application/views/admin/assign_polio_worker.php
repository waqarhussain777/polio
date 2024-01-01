<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Union Council</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <h2 class="">Assign Union Council to Polio Worker</h2>
                <form action="<?php echo site_url('MainController/assign_worker'); ?>" method="post">
                    <div class="mb-3 mt-5">
                        <label for="polioWorker" class="form-label">
                            <strong>Select Polio Worker</strong>
                        </label>
                        <select class="form-select" id="polioWorker" name="polioWorker" required>
                            <option value="">Select Polio Worker</option>
                            <?php foreach ($polio_workers as $worker): ?>
                                <option value="<?php echo $worker->userID; ?>"><?php echo $worker->userName; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                            <label>
                                <strong>Province</strong>
                            </label>
                            <select name="province" id="province" class="form-select" required>
                                <option value="">Select Province</option>
                                <?php foreach($provinces as $province): ?>
                                    <option value="<?php echo $province->provinceID; ?>">
                                        <?php echo $province->provinceName; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>
                                <strong>Division</strong>
                            </label>
                            <select name="division" id="division" class="form-select" required>
                                <option value="">Select Division</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>
                                <strong>District</strong>
                            </label>
                            <select name="district" id="district" class="form-select" required>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>
                                <strong>Tehsil</strong>
                            </label>
                            <select name="tehsil" id="tehsil" class="form-select" required>
                                <option value="">Select Tehsil</option>
                            </select>
                        </div>
                    <div class="mb-3">
                        <label for="unionCouncil" class="form-label">
                            <strong>Union Council</strong>
                        </label>
                        <select class="form-select" id="unioncouncil" name="unioncouncil">
                            <option value="">Select Union Council</option>
                        </select>
                    </div>
                    <a href="<?php echo base_url(''); ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        var baseUrl = "<?php echo base_url(); ?>";
    </script>>
    <script src="<?php echo base_url('assets/js/common.js'); ?>"></script>
</body>
</html>
