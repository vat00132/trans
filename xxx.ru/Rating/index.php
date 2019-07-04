<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
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
            <?php
                $max=0;
                $name="";
                $kol=0;
                for( $i = 0; $i < $rows; $i++)
                {
                    $payment_method_name = $obj[$i]['transaction']['payment_method']['name'];
                    $array[$payment_method_name]=0;
                }
                for( $i = 0; $i < $rows; $i++)
                {
                    $payment_method_name = $obj[$i]['transaction']['payment_method']['name'];
                    $array[$payment_method_name]++;
                }
                arsort($array);
            ?>
            <table border="1"> 
            <br>
            <tr>
                <th>№</th>
                <th>Payment method name</th>
                <th>Count</th>
            </tr>
            <?php
                $i=0;
                foreach($array as $key => $value)
                {
                    $i++;
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$key?></td>
                        <td><?=$value?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
    </div>
</body>
</html>