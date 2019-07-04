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
            <table border="1">     
            <br>
            <tr>
                <th>Project name</th>
                <th>Payment method name</th>
                <th>Transfer date</th>
                <th>Refund reason</th>
                <th>Status</th>
                <th>Dry run</th>
                <th>Is refund allowed</th>
                <th>User name</th>
                <th>User email</th>
                <th>User country</th>
                <th>Currency of payment</th>
                <th>Payment amount</th>
                <th>The amount of PS</th>
                <th>Purchase virtual currency amount</th>
                <th>Purchase virtual currency name</th>
                <th>Purchase virtual items</th>
                <th>Purchase simple checkout amount</th>
                <th>Purchase simple checkout currency</th>
                <th>Purchase subscription name</th>
            </tr>
            <?php
                for( $i = 0; $i < $rows; $i++)
                {
                    $transaction_project_name = $obj[$i]['transaction']['project']['name'];
                    $payment_method_name = $obj[$i]['transaction']['payment_method']['name'];
                    $transfer_date = $obj[$i]['transaction']['transfer_date'];
                    $refund_reason = $obj[$i]['transaction']['refund_reason'];
                    $status = $obj[$i]['transaction']['status'];
                    $dry_run = $obj[$i]['transaction']['dry_run'];
                    $is_refund_allowed = $obj[$i]['transaction']['is_refund_allowed'];
                    $user_name = $obj[$i]['user']['name'];
                    $user_email = $obj[$i]['user']['email'];
                    $user_country = $obj[$i]['user']['country'];
                    $currency_of_payment = $obj[$i]['payment_details']['payment']['currency'];
                    $payment_amount = $obj[$i]['payment_details']['payment']['amount'];
                    $the_amount_of_PS = $obj[$i]['payment_details']['payment']['amount_from_ps'];
                    $purchase_virtual_currency_amount = $obj[$i]['purchase']['virtual_currency']['amount'];
                    $purchase_virtual_currency_name = $obj[$i]['purchase']['virtual_currency']['name'];
                    $purchase_virtual_items = $obj[$i]['purchase']['virtual_items'];
                    $purchase_simple_checkout_amount = $obj[$i]['purchase']['simple_checkout']['amount'];
                    $purchase_simple_checkout_currency = $obj[$i]['purchase']['simple_checkout']['currency'];
                    $purchase_subscription_name = $obj[$i]['purchase']['subscription']['name'];
                    if($refund_reason!=null)
                    {
                    ?>
                    <tr>
                        <td><?=$transaction_project_name?></td>
                        <td><?=$payment_method_name?></td>
                        <td><?=$transfer_date?></td>
                        <td><?=$refund_reason?></td>
                        <td><?=$status?></td>
                        <td><?=$dry_run?></td>
                        <td><?=$is_refund_allowed?></td>
                        <td><?=$user_name?></td>
                        <td><?=$user_email?></td>
                        <td><?=$user_country?></td>
                        <td><?=$currency_of_payment?></td>
                        <td><?=$payment_amount?></td>
                        <td><?=$the_amount_of_PS?></td>
                        <td><?=$purchase_virtual_currency_amount?></td>
                        <td><?=$purchase_virtual_currency_name?></td>
                        <td><?=$purchase_virtual_items?></td>
                        <td><?=$purchase_simple_checkout_amount?></td>
                        <td><?=$purchase_simple_checkout_currency?></td>
                        <td><?=$purchase_subscription_name?></td>
                    </tr>
                    <?php
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>