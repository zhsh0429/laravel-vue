<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock In</title>
    <script type="text/css">


    </script>
    <script type="text/javascript" src="{{asset( 'resources/jquery/jquery-1.11.3.min.js' )}}"></script>
</head>
<body>
    <h1>Stock Out Page</h1>
    {{--form1--}}
    <div>
        <form id="form1" action="#" method="post">
            <table>
                <tr>
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
                    <td class="sNum"><input type="text" name="stock_num" readonly></td>
                    <td class="sName">
                        <input type="text" name="stock_name" id="liveinput">
                        <div id="livesearch"></div>
                    </td>
                    <td class="sDescription"><input type="text" name="stock_description" readonly></td>
                    <td class="sUnit"><input type="text" name="stock_unit" readonly></td>
                    <td><input type="text" name="stock_quantity" id="quantity"></td>
                    <td><input type="text" name="stock_unitprice" id="unitPrice"></td>
                    <td><input type="text" name="stock_totalprice" id="totalPrice" readonly></td>
                    <td class="sOthers"><input type="text" name="stock_others" readonly></td>
                    {{csrf_field()}}
                </tr>
            </table>
            <input type="button" id="addToList" value="ADD TO LIST">
        </form>
    </div>

    <hr>

    <h1>Stock Out List</h1>
    {{--form2--}}
    <div>
        <form id="form2" action="#" method="post">
            <table border="1" id="table2">
                <tr>
                    <th>stockNum</th>
                    <th>stockName</th>
                    <th>stockDescription</th>
                    <th>stockUnit</th>
                    <th>stockQuantity</th>
                    <th>stockSoldPrice</th>
                    <th>stockTotalPrice</th>
                    <th>stockOthers</th>
                </tr>
            </table>
            <input type="button" value="SAVE" id="saveList">
        </form>
    </div>


    <script type="text/javascript">
        $(function(){
            //bind keyup event(searchByName with delay) to #liveinput
            var inputDelay = null;


            $('#liveinput').on('keyup',function(e){
                clearTimeout(inputDelay);
                inputDelay = setTimeout(function(){
                    var keyword = $('#liveinput').val();
                    searchByName(keyword);
                }, 500);
            });

            //bind blur event(totalPrice) to #unitPrice, #quantity
            $('#unitPrice, #quantity').on('blur', function(){
                totalPrice()
            });

            //bind click event(addToList) to #addToList
            $('#addToList').on('click', function () {
                addToList()
            });

            //bind click event(saveList) to #saveList
            $('#saveList').on('click', function () {
                saveList()
            });

        })

        var liveSearchResult = null;
        var stockOutList = [];


        function searchByName(str){
            if (str.length==0)
            {
                $("#livesearch").html('').css('border', '0px');
                return;
            }
//            var likename = ($('#searchInput').val());
            $.post( "{{url('stock/searchByName')}}",{'_token':'{{csrf_token()}}','likename':str},function(data){
                if( data.code == 1 ){
                    console.log( 'have result' );
                    console.log(data);
                    //to global var
                    liveSearchResult = data.stock_nums;
                    var dropList = convertDropList(data);

                    $('#livesearch').html(dropList).css('border','1px solid #A5ACB2');
                }else{
                    console.log( 'do not have result' );
                    $('#livesearch').html('').css('border', '0px');
                }
            });
        }

        //make droplist by json data
        function convertDropList(json){
            var length = json.stock_nums.length;
            var result = '';
            for(var i = 0; i < length; i++){
//                var sID = json.stock_nums[i].id;
                var sNum = json.stock_nums[i].stock_num;
                var sName = json.stock_nums[i].stock_name;
                var sDescription = json.stock_nums[i].stock_description;
                var sUnit = json.stock_nums[i].stock_unit;
                result += "<p id='dropList" + i + "' onclick='autoFill(" + i + ")'>" + sNum + '-' + sName + '-' + sDescription + '-' + sUnit + "</p>"
            }
            console.log('convertResult = ' + result);
            return result;
        }

        //fill Num, Description, Unit, Others
        function autoFill(i){
            console.log(i);
            console.log(liveSearchResult[i]);
            //fill name field
            $('#dropList'+i).parent().siblings("input").val(liveSearchResult[i].stock_name);
            //autofill other fields
            $('#dropList'+i).parent().parent().siblings(".sNum").children('input').val(liveSearchResult[i].stock_num);
            $('#dropList'+i).parent().parent().siblings(".sDescription").children('input').val(liveSearchResult[i].stock_description);
            $('#dropList'+i).parent().parent().siblings(".sUnit").children('input').val(liveSearchResult[i].stock_unit);
            $('#dropList'+i).parent().parent().siblings(".sOthers").children('input').val(liveSearchResult[i].stock_others);
//            $('#dropList'+i).parent().parent().siblings()[1].children().val = 'aaa'
            //empty droplist
            $('#livesearch').html('').css('border', '0px');
        }

        //calculate totalPrice = unitPrice * quantity
        function totalPrice(){
            var unitPrice = $('#unitPrice').val();
            var quantity = $('#quantity').val();
            if (unitPrice > 0 && quantity > 0){
                $('#totalPrice').val(unitPrice * quantity);
            }
        }

        //form=>JSON
        $.fn.serializeObject = function()
        {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };

        //add item to Stock Out List
        function addToList(){
//            var formInJSON = JSON.stringify($('#form1').serializeObject());
//            alert(formInJSON);
            var form = $('#form1').serializeObject();
            $.post( "{{url('stockout/oneOut')}}",{'_token':'{{csrf_token()}}', 'stockNum': form.stock_num, 'stockQuantity': form.stock_quantity, 'stockUnitPrice': form.stock_unitprice},function(data){
                if( data.result == 1 ){
                    console.log( 'success' );
                    jsonToTable(data)
                }else{
                    alert( 'fail' )
                }
            });
        }

        function jsonToTable(data){
            $(data.array).each(function(index, element){
                stockOutList.push(element);
                $('#table2').append('<tr><td>'+ element.stock_num +'</td><td>'+ element.stock_name +'</td><td>'+ element.stock_description +'</td><td>'
                    + element.stock_unit +'</td><td>'+ element.stock_spend +'</td><td>'+ element.stock_soldprice +'</td><td>'+ element.stock_spend * element.stock_soldprice +'</td><td>'+ element.stock_others +'</td></tr>')
            })
        }

        function saveList() {
            $.post("{{url('stockout')}}", {
                '_token': '{{csrf_token()}}',
                'list': stockOutList
            }, function (data) {
                console.log('return from server: ' + data);
                if( data.result == 1 ){
                    alert('success');
                }else{
                    alert('fail');
                }
            });
        }

        //todo: click "add to list" Button => empty the form
        //todo: click "SAVE" Button => empty the table
    </script>
</body>
</html>