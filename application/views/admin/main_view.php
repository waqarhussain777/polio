<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    
    <!-- jQuery Library -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php $this->load->view('common/navbar'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mt-5">
                <table id="adminUnitsTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Province</th>
                            <th>Division</th>
                            <th>District</th>
                            <th>Tehsil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row): ?>
                            <tr>
                                <td><?php echo $row->province; ?></td>
                                <td><?php echo $row->division; ?></td>
                                <td><?php echo $row->district; ?></td>
                                <td><?php echo $row->tehsil; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#adminUnitsTable').DataTable();
        });
    </script>

</body>
</html>
