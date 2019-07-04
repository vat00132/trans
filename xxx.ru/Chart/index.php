<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>transaction</title>
    <meta name="keywords" content="Ключевые слова, и, фразы, через, запятую">
    <meta name="description" content="Описание контента страницы, 1-2 предложения.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$f_json = '../data.json';
$json = file_get_contents("$f_json");
$obj = json_decode($json,true);
$rows = count($obj);
?>
<div align="center">
    <h2>Платежные транзакций</h2>
</div>
<div class="Button" align="center">
    <table>
        <tr>
            <td>
                <form action="http://localhost/xxx.ru/index.php" method="post" name="form">
                    <input type="submit" name="begin" value="Начало" />
                </form>
            </td>
            <td>
            <form action="http://localhost/xxx.ru/Payment/index.php">
                <input type="submit" name="payment" value="Вывести список проектов по которым совершались платежи" />
            </form>     
            </td>
            <td>
                <form action="http://localhost/xxx.ru/Find/index.php" method="post">
                    <select name="list1">
                        <option value="null">Выберите из списка</option>
                        <option value="transaction_project_name">Project name</option>
                        <option value="payment_method_name">Payment method name</option>
                        <option value="refund_reason">Refund reason</option>
                        <option value="status">Status</option>
                        <option value="user_name">User name</option>
                        <option value="user_email">User email</option>
                        <option value="user_country">User country</option>
                        <option value="currency_of_payment">Currency of payment</option>
                        <option value="payment_amount">Payment amount</option>
                        <option value="the_amount_of_PS">The amount of PS</option>
                        <option value="purchase_virtual_currency_name">Purchase virtual currency name</option>
                        <option value="purchase_virtual_items">Purchase virtual items</option>
                        <option value="purchase_simple_checkout_amount">Purchase simple checkout amount</option>
                        <option value="purchase_simple_checkout_currency">Purchase simple checkout currency</option>
                        <option value="purchase_subscription_name">Purchase subscription name</option>
                    </select><br><br>
                    <input type="text" name="find_text"/>
                    <br><br>
                    <input type="submit" name="find" value="Поиск"/>
                </form>
            </td>
            <td>
                <form action="http://localhost/xxx.ru/Rating/index.php">
                    <input type="submit" name="rating" value="Рейтинг платежных систем" />
                </form>   
            </td>
            <td>
                <form action="http://localhost/xxx.ru/Chart/index.php">
                    <input type="submit" name="chary" value="График платежных систем" />
                </form>
            </td>
        </tr>
    </table>
</div>
<div class="transaction" align="center">
    </div>
    <?php
        for( $i = 0; $i < $rows; $i++)
        {
            $payment_method_name = $obj[$i]['transaction']['payment_method']['name'];
                $method_date=$payment_method_name.'05/15';
                $arrayOfValues[$method_date]=0;
                for($j=8;$j<17;$j++)
                {
                    if($j<10)
                    {
                        $method_date=$payment_method_name.'06/0'.$j;
                    }
                    else
                    {
                        $method_date=$payment_method_name.'06/'.$j;
                    }
                    $arrayOfValues[$method_date]=0;
                }
        }
        for( $i = 0; $i < $rows; $i++)
        {
            $payment_method_name = $obj[$i]['transaction']['payment_method']['name'];
            $transfer_date = $obj[$i]['transaction']['transfer_date'];
            $method_date=$payment_method_name.$transfer_date[8].$transfer_date[9].'/'.$transfer_date[11].$transfer_date[12];
            $arrayOfValues[$method_date]++;
        } 
        $str1="";
        $str2="";
        $str3="";
        $str4="";
        $str5="";
        $str6="";
        $str7="";
        $str8="";
        foreach($arrayOfValues as $key => $value)
        {
            $str=substr($key,0,-5);
            if($str=="PayPal")
            {
                $str1=$str1.$value.',';
            }
            if($str=="Credit/Debit Cards")
            {
                $str2=$str2.$value.',';
            }
            if($str=="Your Balance")
            {
                $str3=$str3.$value.',';
            }
            if($str=="Google Pay")
            {
                $str4=$str4.$value.',';
            }
            if($str=="Webmoney")
            {
                $str5=$str5.$value.',';
            }
            if($str=="RAZER zGOLD")
            {
                $str6=$str6.$value.',';
            }
            if($str=="MobileGo")
            {
                $str7=$str7.$value.',';
            }
            if($str=="QIWI")
            {
                $str8=$str8.$value.',';
            }
        }
        $str1=substr($str1,0,-1);
        $str2=substr($str2,0,-1);
        $str3=substr($str3,0,-1);
        $str4=substr($str4,0,-1);
        $str5=substr($str5,0,-1);
        $str6=substr($str6,0,-1);
        $str7=substr($str7,0,-1);
        $str8=substr($str8,0,-1);
    ?>
    <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" 
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <div id="content" align="center">
        <canvas id="myChart" width="900" height="900"></canvas>
    </div>
    <script type="text/javascript">
    function Diagram()
    {
        var ctx = document.getElementById("myChart");
        var myChart = new Chart (ctx, {
            type: 'line',
            data:{
                labels: ["05/15:00", "06/08:00", "06/09:00", "06/10:00", "06/11:00", "06/12:00", "06/13:00", "06/14:00", "06/15:00", "06/16:00"],
                datasets: [
                    {
                        label:"PayPal",
                        data: [<?=$str1?>],
                        borderColor: 'blue',
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label:"Credit/Debit Cards",
                        data: [<?=$str2?>],
                        borderColor: 'red',
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label:"Your Balance",
                        data: [<?=$str3?>],
                        borderColor: 'orange',
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label:"Google Pay",
                        data: [<?=$str4?>],
                        borderColor: 'purple',
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label:"Webmoney",
                        data: [<?=$str5?>],
                        borderColor: 'black',
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label:"RAZER zGOLD",
                        data: [<?=$str6?>],
                        borderColor: 'green',
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label:"MobileGo",
                        data: [<?=$str7?>],
                        borderColor: 'brown',
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label:"QIWI",
                        data: [<?=$str8?>],
                        borderColor: 'pink',
                        borderWidth: 2,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: false,
                scales: {
                    xAxes: [{
                        display: true
                    }],
                    yAxes: [{
                        display: true
                    }]
                }
            }
        });
    }
        window.addEventListener("load", Diagram);
    </script>
    <noscript>
    <div align="center">
    Извините, для работы приложения нужен включенный Javascript
    </div>
    </noscript>
</body>
</html>