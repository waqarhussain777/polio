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
                    <h2 class="text-center">Add District</h2>
                    <?php echo form_open('add_district_record'); ?>
                        <input type="hidden" name="districtID" value="<?php echo $district->districtID ?? ''; ?>">
                        <div class="mb-3">
                            <label>
                                <strong>Division</strong>
                            </label>
                            <select name="division" id="division" class="form-select" required>
                                <option value="">Select Division</option>
                                <?php if (!empty($divisions)): ?>
                                    <?php foreach($divisions as $division): ?>
                                        <option value="<?php echo $division->divisionID; ?>"
                                            <?php if(isset($is_edit) && $is_edit && $division->divisionID == $district->fkdivisionID) echo 'selected'; ?>>
                                            <?php echo $division->divisionName; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>
                                <strong>District Name</strong>
                            </label>
                            <input type="text" value="<?php echo $district->districtName ?? ''; ?>" name="districtName" class="form-control" required>
                        </div>
                        <a href="<?php echo base_url('district_listing'); ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</body>
</html>
