<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="30">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <title>Home</title>
</head>

<body>
    <div class="container">
<!--        New customer -->
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <h2>Nieuwe klant</h2>
            </div>
            <div class="col-md-5 col-sm-5"></div>
            <div class="col-md-4 col-sm-4">
                <form>
                    <div class="form-group">
                        <input type="text" placeholder="Naam">
                        <input type="submit" value="Aanmaken">
                    </div>
                </form>
            </div>
        </div>

        <hr>

        <h2>Alle klanten</h2>
        <table class="table table-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Naam</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Customer -->
                <tr>
                    <td>1</td>
                    <td>Een klant</td>
                    <td>
                        <a href="#demo1" data-toggle="collapse">Services</a>
                    </td>
                </tr>
                <!-- PlanCare services -->
                <tr id="demo1" class="collapse">
                    <td colspan="3">
                        PlanCare service 1<br>
                        PlanCare service 2<br>
                        PlanCare service 3
                    </td>
                </tr>

                <!-- Customer -->
                <tr>
                    <td>2</td>
                    <td>Een tweede klant</td>
                    <td>
                        <a href="#demo2" data-toggle="collapse">Services</a>
                    </td>
                </tr>
                <!-- PlanCare services -->
                <tr id="demo2" class="collapse">
                    <td colspan="3">
                        PlanCare service 1<br>
                        PlanCare service 2<br>
                        PlanCare service 3
                    </td>
                </tr>

                <!-- Customer -->
                <tr>
                    <td>3</td>
                    <td>Een derde klant</td>
                    <td>
                        <a href="#demo3" data-toggle="collapse">Services</a>
                    </td>
                </tr>
                <!-- PlanCare services -->
                <tr id="demo3" class="collapse">
                    <td colspan="3">
                        PlanCare service 1<br>
                        PlanCare service 2<br>
                        PlanCare service 3
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>