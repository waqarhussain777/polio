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
                    <h2 class="text-center">Add Tehsil</h2>
                    <?php echo form_open('add_unioncouncil_record'); ?>
                        <input type="hidden" name="unioncouncilID" value="<?php echo $unioncouncil->unioncouncilID ?? ''; ?>">
                        <div class="mb-3">
                            <label>
                                <strong>Tehsil</strong>
                            </label>
                            <select name="tehsil" id="tehsil" class="form-select" required>
                                <option value="">Select Tehsil</option>
                                <?php if (!empty($tehsils)): ?>
                                    <?php foreach($tehsils as $tehsil): ?>
                                        <option value="<?php echo $tehsil->tehsilID; ?>"
                                            <?php if(isset($is_edit) && $is_edit && $tehsil->tehsilID == $unioncouncil->fktehsilID) echo 'selected'; ?>>
                                            <?php echo $tehsil->tehsilName; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>
                                <strong>Union Council Name</strong>
                            </label>
                            <input type="text" value="<?php echo $unioncouncil->unioncouncilName ?? ''; ?>" name="unioncouncilName" class="form-control" required>
                        </div>
                        <a href="<?php echo base_url('unioncouncil_listing'); ?>" class="btn btn-secondary">Cancel</a>
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
