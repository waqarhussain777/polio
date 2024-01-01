<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vaccination Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-5">
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
                    <h2 class="text-center">Add Vaccination Record</h2>
                    <?php echo form_open('add_vaccination_record'); ?>
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
                            <select name="unioncouncil" id="unioncouncil" class="form-select" required>
                                <option value="">Select Union Council</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>
                                <strong>Individual Household</strong>
                            </label>
                            <select name="household" id="household" class="form-select" required>
                                <option value="">Select Household</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>
                                <strong>Household Member</strong>
                            </label>
                            <select name="householdmember" id="householdmember" class="form-select" required>
                                <option value="">Select Household Member</option>
                            </select>
                        </div>
                        <a href="<?php echo base_url(''); ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        var baseUrl = "<?php echo base_url(); ?>";
    </script>>
    <script src="<?php echo base_url('assets/js/common.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/add_vaccination_record.js'); ?>"></script>

</body>
</html>
