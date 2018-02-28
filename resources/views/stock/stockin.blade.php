<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock In</title>
</head>
<body>
    <h1>Stock In Page</h1>
    <div>
        <form action="{{url( 'stockin' )}}" method="post">
            <table>
                <tr>
                    <th>NO.</th>
                    <th>stockNum</th>
                    <th>stockName</th>
                    <th>stockDescription</th>
                    <th>stockUnit</th>
                    <th>stockQuantity</th>
                    <th>stockUnitPrice</th>
                    <th>stockTotalPrice</th>
                    <th>stockOthers</th>
                </tr>
                <tr>
                    {{csrf_field()}}
                    <td>1</td>
                    <td><input type="text" name="stock_num[]"></td>
                    <td><input type="text" name="stock_name[]"></td>
                    <td><input type="text" name="stock_description[]"></td>
                    <td><input type="text" name="stock_unit[]"></td>
                    <td><input type="text" name="stock_quantity[]"></td>
                    <td><input type="text" name="stock_unitprice[]"></td>
                    <td><input type="text" name="stock_totalprice[]"></td>
                    <td><input type="text" name="stock_others[]"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><input type="text" name="stock_num[]"></td>
                    <td><input type="text" name="stock_name[]"></td>
                    <td><input type="text" name="stock_description[]"></td>
                    <td><input type="text" name="stock_unit[]"></td>
                    <td><input type="text" name="stock_quantity[]"></td>
                    <td><input type="text" name="stock_unitprice[]"></td>
                    <td><input type="text" name="stock_totalprice[]"></td>
                    <td><input type="text" name="stock_others[]"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><input type="text" name="stock_num[]"></td>
                    <td><input type="text" name="stock_name[]"></td>
                    <td><input type="text" name="stock_description[]"></td>
                    <td><input type="text" name="stock_unit[]"></td>
                    <td><input type="text" name="stock_quantity[]"></td>
                    <td><input type="text" name="stock_unitprice[]"></td>
                    <td><input type="text" name="stock_totalprice[]"></td>
                    <td><input type="text" name="stock_others[]"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="button" value="ADD ONE"></td>
                    <td><input type="submit" value="SAVE"></td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        //todo: livesearch function
    </script>

</body>
</html>