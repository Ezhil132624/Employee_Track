<!DOCTYPE html>
<html>

<head>
    <title>Employee Details</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f4f7;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 25px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-box {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        select,
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .alert {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-left: 5px solid #28a745;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th {
            background: #007bff;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        .row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            min-width: 300px;
        }

        .table-heading {
            background: #007bff;
            color: white;
            padding: 10px;
            margin-top: 30px;
            border-radius: 5px 5px 0 0;
        }

        /* Extra styling for filter salary inputs */
        .salary-range {
            display: flex;
            gap: 10px;
        }

        .salary-range input {
            flex: 1;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Employee Details</h2>

        <?php if ($this->session->flashdata('msg')): ?>
            <div class="alert"><?= $this->session->flashdata('msg') ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col">
                <div class="form-box">
                    <h5>Add Employee</h5>
                    <form method="post" action="<?= base_url('employee/add') ?>">
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="text" name="phone" placeholder="Phone" required>
                        <select name="department" required>
                            <option value="">Select Department</option>
                            <option value="HR">HR</option>
                            <option value="IT">IT</option>
                            <option value="Sales">Sales</option>
                        </select>
                        <input type="number" name="salary" placeholder="Salary (₹)" min="0" required>
                        <button type="submit">Add</button>
                    </form>
                </div>
            </div>

            <div class="col">
                <div class="form-box">
                    <h5>Filter Employees</h5>
                    <form method="get" action="<?= base_url('employee/index') ?>">
                        <select name="department">
                            <option value="">All Departments</option>
                            <option value="HR">HR</option>
                            <option value="IT">IT</option>
                            <option value="Sales">Sales</option>
                        </select>

                        <div class="salary-range">
                            <input type="number" name="salary_min" placeholder="Min Salary" min="0">
                            <input type="number" name="salary_max" placeholder="Max Salary" min="0">
                        </div>

                        <button type="submit" style="background: #28a745;">Filter</button>
                    </form>
                </div>
            </div>
        </div>

        <?php if (!empty($employees)): ?>
            <div class="table-heading">Filtered Employees (From Redis Cache)</div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Salary (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $e): ?>
                        <tr>
                            <td><?= $e['id'] ?></td>
                            <td><?= $e['name'] ?></td>
                            <td><?= $e['email'] ?></td>
                            <td><?= $e['phone'] ?></td>
                            <td><?= $e['department'] ?></td>
                            <td><?= number_format($e['salary']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>

</html>